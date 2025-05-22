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
    Schema::create('sub_branches', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('branch_id'); // foreign key to branches
        $table->timestamps();

        $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_branches');
    }
};
