<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('sub_branches', function (Blueprint $table) {
        $table->string('contact')->nullable();
        $table->string('address')->nullable();
    });
}

public function down()
{
    Schema::table('sub_branches', function (Blueprint $table) {
        $table->dropColumn(['contact', 'address']);
    });
}

};
