<?php

namespace App\Http\Controllers;

use App\Models\{
    Film,
    Genre,
    Kritik,
    Peran,
};
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    private const HORROR_FILM_TITLES = ['Resident Evil', 'Weapons', '28 Years Later'];

    /**
     * Display a listing of the resource.
     */
    public function movies()
    {
        //
        $genreFilm = null;
        $films = Film::select('id','title', 'poster','year')
                ->orderByDesc('year')
                ->OrderBy('created_at', 'asc')
                ->paginate(18);
        return view('components/movies', compact('films', 'genreFilm'));
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'q' => ['required', 'string', 'max:255'],
        ]);
        $query = trim($validated['q']);

        $films = Film::select('id', 'title', 'poster', 'year')
            ->where('title', 'like', '%' . $query . '%')
            ->orderByDesc('year')
            ->orderBy('created_at', 'asc')
            ->paginate(18)
            ->withQueryString();

        return view('components/movies', [
            'films' => $films,
            'genreFilm' => null,
            'searchQuery' => $query,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        //
        if (in_array($film->title, self::HORROR_FILM_TITLES, true)) {
            $filmByGenre = Film::select('id', 'title', 'poster', 'year', 'sinopsis')
                ->whereIn('title', self::HORROR_FILM_TITLES)
                ->where('id', '!=', $film->id)
                ->get();
        } else {
            $filmByGenre = Film::select('id', 'title', 'poster', 'year', 'sinopsis')
                ->where('genre_id', $film->genre_id)
                ->orderBy('created_at', 'asc')
                ->limit(7)
                ->get();
        }
        $filmByRelease  = Film::select('id','title', 'poster','year')
                        ->where('year', '=', Carbon::now()->format('Y'))
                        ->OrderBy('created_at', 'asc')
                        ->limit(9)
                        ->get();
        $comments        = Kritik::with('user')->select('comment', 'user_id')
                        ->where('film_id', '=', $film->id)
                        ->orderBy('created_at', 'asc')
                        ->limit(10)
                        ->get();
        $perans         = Peran::with('cast')->where('film_id', '=', $film->id)->get();
        return view('components.movie-show', compact('film','filmByGenre','filmByRelease','comments', 'perans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        //
    }

    public function movieHome()
    {
        $films = Film::select('id','title', 'poster','year')
                ->orderByRaw('CASE WHEN title IN (?, ?, ?) THEN 0 ELSE 1 END', self::HORROR_FILM_TITLES)
                ->orderByDesc('year')
                ->orderByDesc('created_at')
                ->limit(9)->get();
        $filmFutured = Film::select('id','title', 'poster','year')
                        ->orderByRaw('CASE WHEN title IN (?, ?, ?) THEN 0 ELSE 1 END', self::HORROR_FILM_TITLES)
                        ->orderByDesc('year')
                        ->orderByDesc('created_at')
                        ->limit(6)->get();
        $filmRecentAdded = Film::select('id','title', 'poster','year')
                            ->orderByRaw('CASE WHEN title IN (?, ?, ?) THEN 0 ELSE 1 END', self::HORROR_FILM_TITLES)
                            ->orderByDesc('created_at')
                            ->limit(6)->get();
        $filmSlidey = Film::select('title', 'poster','sinopsis')
                        ->orderByRaw('CASE WHEN title IN (?, ?, ?) THEN 0 ELSE 1 END', self::HORROR_FILM_TITLES)
                        ->orderByDesc('year')
                        ->orderByDesc('created_at')
                        ->limit(6)->get();
        return view('components/home', compact('filmSlidey','films','filmFutured','filmRecentAdded'));
    }

    public function moviesByGenre($genre)
    {
        //
        $genreFilm = Genre::where('id', '=', $genre)->first();
        $films = Film::select('id','title', 'poster','year')
                ->where('genre_id', '=', $genre)
                ->orderByDesc('year')
                ->OrderBy('created_at', 'asc')
                ->paginate(18);
        return view('components/movies', compact('films','genreFilm'));
    }
}
