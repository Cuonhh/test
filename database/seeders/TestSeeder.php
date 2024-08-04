<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Testing\Fakes\Fake;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startTime = microtime(true);

        $data = [];
        $time = now();
        for ($i = 1; $i < 1000001; $i++) {
            $data[] = [
                'xxxx' => fake()->text(),
                'qqqq' => rand(11111111, 99999999),
                'kkkk' => rand(11111, 99999),
                'eeee' => fake()->time(),
                'rrrr' => fake()->date(),
                'tttt' => fake()->dateTime(),
                'yyyy' => fake()->phoneNumber(),
                'uuuu' => fake()->email(),
                'iiii' => fake()->address(),
                'bbbb' => fake()->numberBetween(),
                'pppp' => fake()->numberBetween(),
                'oooo' => rand(0, 1),
                'created_at' => $time,
                'updated_at' => $time,
            ];

            if ($i % 1000 === 0) {
                echo $i . PHP_EOL;

                DB::table('tests')->insert($data);

                $data = [];
            }
        }

        $endTime = microtime(true);   

        $executionTime = $endTime - $startTime;

        echo $executionTime;
    }
}
