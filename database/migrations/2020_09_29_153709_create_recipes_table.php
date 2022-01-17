<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateRecipesTable extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table): void {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->unsignedInteger('duration');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('thumbnail')->nullable();
            $table->string('image')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
}
