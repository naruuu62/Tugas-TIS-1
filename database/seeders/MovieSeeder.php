<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Inception',
                'genre' => 'Sci-Fi',
                'mood'  => 'excited',
                'rating' => 9,
                'notes'  => 'Film mind-blowing tentang mimpi di dalam mimpi.',
            ],
            [
                'title' => 'The Pursuit of Happyness',
                'genre' => 'Drama',
                'mood'  => 'sad',
                'rating' => 8,
                'notes'  => 'Sangat menginspirasi dan mengharukan.',
            ],
            [
                'title' => 'Despicable Me',
                'genre' => 'Animation',
                'mood'  => 'happy',
                'rating' => 8,
                'notes'  => 'Karakter Minions sangat lucu dan menghibur.',
            ],
            [
                'title' => 'Dune: Part Two',
                'genre' => 'Sci-Fi',
                'mood'  => 'excited',
                'rating' => 9,
                'notes'  => 'Visual yang luar biasa dan cerita epik.',
            ],
            [
                'title' => 'Documentary on Paint Drying',
                'genre' => 'Documentary',
                'mood'  => 'bored',
                'rating' => 2,
                'notes'  => 'Sesuai ekspektasi, sangat membosankan.',
            ]
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
