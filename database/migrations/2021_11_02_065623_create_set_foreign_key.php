<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'department_id') && Schema::hasTable('departments')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            });
        }
        if (Schema::hasColumn('bookings', 'user_id') && Schema::hasTable('users')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
        if (Schema::hasColumn('bookings', 'room_id') && Schema::hasTable('rooms')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_foreign_key');
    }
}
