<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->name();
            $table->username();
            $table->string('teacher_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
       Schema::table('teacher_profiles', function (Blueprint $table) {
        $table->dropColumn('phone');
      });
    }
}
