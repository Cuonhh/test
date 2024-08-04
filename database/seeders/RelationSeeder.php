<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = Book::find(1);

        // $categoryIDs = [1, 3, 5, 8];

        // $book->categories()->attach($categoryIDs);

        // $book->categories()->detach([3]);

        $book->categories()->toggle([4, 10, 5]);
    }
}
