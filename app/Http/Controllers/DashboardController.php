<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Kritik;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Admin dashboard overview.
     */
    public function index()
    {
        $counts = [
            'films'   => Film::count(),
            'genres'  => Genre::count(),
            'casts'   => Cast::count(),
            'users'   => User::count(),
            'kritiks' => Kritik::count(),
        ];

        $latestFilms   = Film::select('id', 'title', 'poster', 'year')->latest()->limit(5)->get();
        $latestKritiks = Kritik::select('id', 'comment', 'rating', 'film_id', 'user_id')->latest()->limit(5)->get();
        $avgRating     = number_format(Kritik::avg('rating') ?? 0, 1);

        return view('admin.dashboard', compact('counts', 'latestFilms', 'latestKritiks', 'avgRating'));
    }
}
