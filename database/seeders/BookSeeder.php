<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Author::truncate();
        Book::truncate();
        DB::table('book_category')->truncate();

        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => fake()->realText(20)
            ]);

            Author::create([
                'name' => fake()->realText(20)
            ]);
        }


        for ($i = 0; $i < 10; $i++) {
            $book = Book::create([
                'author_id' => rand(1, 5),
                'title' => fake()->realText(50)
            ]);
    
            $categoryIDs = [1, 3, 5, 8];
    
            $book->categories()->attach($categoryIDs);
    
            // $book->categories()->detach([3]);

            // $book->categories()->toggle([4, 10, 5]);

            // $book->categories()->sync([4, 10, 5]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
