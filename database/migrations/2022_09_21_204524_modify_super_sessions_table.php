<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('super_sessions', function (Blueprint $table) {
            $table->after('max_participants', function ($table) {
                $table->text('event_date')->nullable();
                $table->text('event_time')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('super_sessions', function (Blueprint $table) {
            //
        });
    }
};
