<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Kritik;
use App\Models\Peran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $films = Film::select('id', 'title', 'poster', 'year', 'genre_id')
            ->when($request->filled('s'), function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->s.'%');
            })
            ->with('genre')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        $genres = Genre::all();

        return view('admin.films.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string'],
            'year'     => ['required', 'integer', 'min:1900', 'max:2100'],
            'genre_id' => ['required', 'exists:genres,id'],
            'poster'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data['poster'] = $this->handlePoster($request, $data['poster'] ?? null);

        Film::create($data);

        return redirect()->route('admin.films.index')->with('success', "Film '{$data['title']}' berhasil ditambahkan.");
    }

    public function show(Film $film)
    {
        $film->load(['genre', 'perans', 'kritiks']);

        return view('admin.films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        $genres = Genre::all();

        return view('admin.films.edit', compact('film', 'genres'));
    }

    public function update(Request $request, Film $film)
    {
        $data = $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string'],
            'year'     => ['required', 'integer', 'min:1900', 'max:2100'],
            'genre_id' => ['required', 'exists:genres,id'],
            'poster'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $newPoster = $this->handlePoster($request, $data['poster'] ?? null);
        if ($newPoster) {
            $data['poster'] = $newPoster;
        } else {
            unset($data['poster']);
        }

        $film->update($data);

        return redirect()->route('admin.films.index')->with('success', "Film '{$film->title}' berhasil diperbarui.");
    }

    public function destroy(Film $film)
    {
        $title = $film->title;
        $film->kritiks()->delete();
        $film->perans()->delete();
        $film->delete();

        return redirect()->route('admin.films.index')->with('success', "Film '{$title}' berhasil dihapus.");
    }

    /**
     * Store an uploaded poster and return the public path, or fallback data.
     */
    private function handlePoster(Request $request, ?string $validatedPoster): string
    {
        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {
            $path = $request->file('poster')->store('posters', 'public');

            return 'storage/'.$path;
        }

        if (! empty($validatedPoster) && str_starts_with($validatedPoster, 'storage/')) {
            return $validatedPoster;
        }

        // Placeholder so the listing still has an image.
        return 'storage/images/m1.jpg';
    }
}
