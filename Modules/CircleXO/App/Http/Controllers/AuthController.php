<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Modules\TomatoCrm\App\Events\AccountRegistered;
use Modules\TomatoCrm\App\Events\SendOTP;
use Modules\TomatoCrm\App\Models\Account;
use ProtoneMedia\Splade\Facades\Toast;

class AuthController extends Controller
{

    public function register()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        return view('circle-xo::auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:accounts',
            'email' => 'required|string|email|max:255|unique:accounts',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $request->merge([
            "username" => "@" . strtolower($request->username),
            "otp_code" => rand(100000, 999999),
            "password" => bcrypt($request->password),
        ]);

        $account = Account::create($request->all());

        SendOTP::dispatch(Account::class, $account->id);
        AccountRegistered::dispatch(Account::class, $account->id);


        if (Session::has('email')){
            Session::forget('email');
        }

        Session::put('email', $request->email);

        Toast::success('Account created successfully!')->autoDismiss(2);
        return redirect()->route('account.otp');
    }

    public function login()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        return view('circle-xo::auth.login');
    }

    public function check(Request $request)
    {
        $request->merge([
            "username" => "@" . strtolower($request->username),
        ]);

        $request->validate([
            'username' => 'required|string|max:255|exists:accounts,username',
            'password' => 'required|string|min:8',
        ]);

        $user = auth('accounts')->attempt($request->only('username', 'password'));
        if($user){
            Toast::success('Logged in successfully!')->autoDismiss(2);
            return redirect()->route('profile.index');
        }

        Toast::danger('Invalid credentials!')->autoDismiss(2);
        return redirect()->back();

    }

    public function reset()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        return view('circle-xo::auth.reset');
    }

    public function otp()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        if (Session::has('email')){
            return view('circle-xo::auth.otp');
        }
        else
        {
            return redirect()->route('account.register');
        }
    }

    public function checkOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string|max:6|exists:accounts,otp_code',
        ]);

        $account = Account::where('email', Session::get('email'))->first();

        if ($account->otp_code == $request->otp_code){
            $account->otp_activated_at = Carbon::now();
            $account->otp_code = null;
            $account->is_active = true;
            $account->save();

            Session::forget('email');

            Toast::success('Account activated successfully!')->autoDismiss(2);
            return redirect()->route('account.login');
        }
        else
        {
            Toast::danger('Invalid OTP code!')->autoDismiss(2);
            return redirect()->back();
        }

    }
}
