<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFillToClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class', function (Blueprint $table) {
            $table->string('user_id')->after('image');
            $table->string('class_id')->nullable()->after('user_id');
            $table->string('status')->after('class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class', function (Blueprint $table) {
            //
        });
    }
}
