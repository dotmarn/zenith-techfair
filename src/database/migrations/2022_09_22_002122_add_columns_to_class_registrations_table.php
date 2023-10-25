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
        Schema::table('class_registrations', function (Blueprint $table) {
            $table->after('super_session_id', function($table) {
                $table->string('preferred_date', 50)->nullable();
                $table->string('preferred_time', 50)->nullable();
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
        Schema::table('class_registrations', function (Blueprint $table) {
            //
        });
    }
};
