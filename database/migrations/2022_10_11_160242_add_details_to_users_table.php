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
        Schema::table('users', function (Blueprint $table) {
            $table -> tinyInteger('role_as')->default('0')->comment('admin=1, user=0');
            $table -> string('dob')->nullable();
            $table -> string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->char('gender')->nullable()->comment('Male=M, Female=F, Others = O')->nullable();
            $table->unsignedBigInteger('slider_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
