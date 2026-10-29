<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::select('id', 'name')
            ->withCount('films')
            ->orderBy('id')
            ->paginate(10);

        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:genres,name'],
        ]);

        Genre::create($data);

        return redirect()->route('admin.genres.index')->with('success', "Genre '{$data['name']}' berhasil ditambahkan.");
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:genres,name,'.$genre->id],
        ]);

        $genre->update($data);

        return redirect()->route('admin.genres.index')->with('success', "Genre '{$genre->name}' berhasil diperbarui.");
    }

    public function destroy(Genre $genre)
    {
        if ($genre->films()->exists()) {
            return back()->withErrors(['genre' => "Genre '{$genre->name}' masih dipakai {$genre->films()->count()} film dan tidak bisa dihapus."]);
        }

        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', "Genre '{$genre->name}' berhasil dihapus.");
    }
}
