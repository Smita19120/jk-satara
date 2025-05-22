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
        Schema::table('trainers', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable()->after('designation');
            $table->unsignedBigInteger('sub_branch_id')->nullable()->after('branch_id');
            
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
            $table->foreign('sub_branch_id')->references('id')->on('sub_branches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['sub_branch_id']);
            $table->dropColumn(['branch_id', 'sub_branch_id']);
        });
    }
};