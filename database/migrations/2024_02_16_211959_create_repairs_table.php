<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id()->startingValue(1000000);
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $table->foreignId('fault_id')->constrained('faults')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status',['Open','Work_In_Progress','Completed'])->default('Open');
            $table->integer('assigneduser')->unsigned()->default(0);
            $table->integer('closeby')->unsigned()->default(0);
            $table->string('workdone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
