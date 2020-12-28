<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFillToRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room', function (Blueprint $table) {
            $table->string('user_id')->after('price');
            $table->string('room_id')->nullable()->after('user_id');
            $table->string('status')->after('room_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room', function (Blueprint $table) {
            //
        });
    }
}
