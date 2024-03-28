<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(config('tomato-support.features.tickets')) {
            Schema::create('ticket_comments', function (Blueprint $table) {
                $table->id();

                //Ref
                $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');

                //Link User To Ticket With Morph
                $table->morphs('accountable');

                //Add User For Tickets
                $table->longText('response');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
