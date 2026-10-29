<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MovieSearchTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');

        Schema::create('films', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('poster')->nullable();
            $table->integer('year');
            $table->timestamps();
        });

        DB::table('films')->insert([
            ['title' => 'The Batman', 'poster' => '', 'year' => 2022, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Joker', 'poster' => '', 'year' => 2019, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Resident Evil', 'poster' => '', 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
            ['title' => '28 Years Later', 'poster' => '', 'year' => 2025, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Weapons', 'poster' => '', 'year' => 2026, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function test_it_finds_movies_by_a_partial_title(): void
    {
        $response = $this->get(route('movies.search', ['q' => 'Batman']));

        $response->assertOk()
            ->assertSee('♡. Search ur favo movies!', false)
            ->assertSee('The Batman')
            ->assertDontSee('Joker');
    }

    public function test_it_shows_an_empty_state_when_no_movie_matches(): void
    {
        $response = $this->get(route('movies.search', ['q' => 'Unknown movie']));

        $response->assertOk()
            ->assertSee('No movies found for "Unknown movie".', false);
    }

    public function test_it_displays_the_requested_ratings_for_horror_movies(): void
    {
        foreach ([
            'resident evil' => '4.5',
            '28 years later' => '4.0',
            'weapons' => '4.2',
        ] as $query => $rating) {
            $response = $this->get(route('movies.search', ['q' => $query]));

            $response->assertOk()
                ->assertSee('aria-label="Rating '.$rating.' out of 5"', false)
                ->assertSee('>'.$rating.'</span>', false);
        }
    }
}
