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
        // Add indexes to books table for search/filter performance
        Schema::table('books', function (Blueprint $table) {
            $table->index('title');
            $table->index('author');
        });

        // Add index to news_items for sorting by publish date
        Schema::table('news_items', function (Blueprint $table) {
            $table->index('published_at');
        });

        // Add composite index for efficient club post pagination
        Schema::table('club_posts', function (Blueprint $table) {
            $table->index(['book_club_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropIndex(['title']);
            $table->dropIndex(['author']);
        });

        Schema::table('news_items', function (Blueprint $table) {
            $table->dropIndex(['published_at']);
        });

        Schema::table('club_posts', function (Blueprint $table) {
            $table->dropIndex(['book_club_id', 'created_at']);
        });
    }
};
