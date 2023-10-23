<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->string('name');
            $table->string('url');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('status')->default('pending');
        });
    }

    public function down()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('url');
            $table->dropColumn('user_id');
            $table->dropColumn('status');
        });
    }
};
