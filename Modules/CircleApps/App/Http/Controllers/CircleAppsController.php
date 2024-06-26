<?php

namespace Modules\CircleApps\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CircleApps\App\Models\App;
use Nwidart\Modules\Facades\Module;
use ProtoneMedia\Splade\Facades\Toast;

class CircleAppsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apps= App::query();
        if($request->has('search')) {
            $apps->where('name', 'like', '%'.$request->search.'%');
        }
        if($request->has('category')) {
            $apps->whereHas('categories', function ($query) use ($request) {
                $query->where('id', $request->category);
            });
        }
        $apps->where('is_active', true);
        $apps->orderBy('id', 'desc');
        $apps = $apps->paginate(12);

        return view('circle-apps::index', compact('apps'));
    }

    public function submit()
    {
        return view('circle-apps::submit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'module' => 'required|file|mimes:zip|max:50000',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'nullable|max:255|string',
            'key' => 'required|string|unique:apps,key',
            'readme' => 'nullable',
            'homepage' => 'nullable|url|max:255|string',
            'email' => 'nullable|max:255|string|email',
            'docs' => 'nullable|url|max:255|string',
            'github' => 'nullable|url|max:255|string',
            'privacy' => 'nullable|url|max:255|string',
            'faq' => 'nullable|url|max:255|string',
            'is_free' => 'nullable'
        ]);

        $app = new App();
        $app->account_id = auth('accounts')->user()->id;
        $app->name = $request->name;
        $app->description = $request->description;
        $app->key = $request->key;
        $app->readme = $request->readme;
        $app->homepage = $request->homepage;
        $app->email = $request->email;
        $app->docs = $request->docs;
        $app->github = $request->github;
        $app->privacy = $request->privacy;
        $app->faq = $request->faq;
        $app->is_free = true;
        $app->save();

        $app->addMedia($request->file('logo'))->toMediaCollection('logo');
        $app->addMedia($request->file('cover'))->toMediaCollection('cover');
        $app->addMedia($request->file('module'))->toMediaCollection('module');

        try {
            $user = User::first();
            $user->notifyDiscord(
                title: "=========== New CircleXO App Submit =========== \n".' NAME: '.$app->name . " \n DESCRIPTION: " . $app->description . " \n BY: " . $app->account->username . " \n MODULE: " . $app->getMedia('module')->first()?->getUrl() ,
                webhook: config('services.discord.notification-webhook')
            );
        }catch (\Exception $exception){
            // do nothing
        }

        Toast::success(__('App submitted successfully!'))->autoDismiss(2);
        return back();
    }

    /**
     * Show the specified resource.
     */
    public function show(App $app)
    {
        return view('circle-apps::show', compact('app'));
    }

    public function install(App $app)
    {
        if($app->required){
            $checkRequiredApps = auth('accounts')->user()->apps()->whereIn('id', $app->required)->count();
            if($checkRequiredApps !== count($app->required)){
                $appRequired = App::whereIn('id', $app->required)->first();

                auth('accounts')->user()->apps()->attach($appRequired->id);
            }
        }


        if($app->account_id && $app->account_id !== auth('accounts')->id()){
            $app->account->notifyDB(
                message: __(auth('accounts')->user()->username . " " . __('is install your app') .' '. $app->name),
                title: __('New App Install'),
                url: url(url('apps/'.$app->id))
            );
        }
        auth('accounts')->user()->apps()->attach($app->id);

        Toast::success(__('App installed successfully!'))->autoDismiss(2);
        return back();
    }

    public function uninstall(App $app)
    {
        $appRequiredThisApp = App::whereJsonContains('required', (string)$app->id)->get();
        if($appRequiredThisApp->count() > 0){
            $getRequiredApp = null;
            foreach ($appRequiredThisApp as $requiredApp){
                if(has_app($requiredApp->key)){
                    $getRequiredApp = $requiredApp;
                }
            }

            if($getRequiredApp){
                Toast::danger(__('You need to uninstall required apps first!'))->autoDismiss(2);
                return redirect()->to(url('apps/'.$getRequiredApp->id));
            }
        }

        if($app->account_id && $app->account_id !== auth('accounts')->id()){
            $app->account->notifyDB(
                message: __(auth('accounts')->user()->username . " " . __('is Uninstall your app') .' '. $app->name),
                title: __('New App Uninstall'),
                url: url(url('apps/'.$app->id))
            );
        }

        auth('accounts')->user()->apps()->detach($app->id);

        Toast::success(__('App installed successfully!'))->autoDismiss(2);
        return back();
    }
}
