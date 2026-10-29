<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Film;
use App\Models\Peran;
use Illuminate\Http\Request;

class PeranController extends Controller
{
    public function index(Request $request)
    {
        $perans = Peran::select('id', 'actor', 'film_id', 'cast_id')
            ->with(['film', 'cast'])
            ->when($request->filled('s'), function ($q) use ($request) {
                $q->where('actor', 'like', '%'.$request->s.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.perans.index', compact('perans'));
    }

    public function create()
    {
        $films = Film::orderBy('title')->get(['id', 'title']);
        $casts = Cast::orderBy('name')->get(['id', 'name']);

        return view('admin.perans.create', compact('films', 'casts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'actor'   => ['required', 'string', 'max:255'],
            'film_id' => ['required', 'exists:films,id'],
            'cast_id' => ['required', 'exists:casts,id'],
        ]);

        Peran::create($data);

        return redirect()->route('admin.perans.index')->with('success', "Film role '{$data['actor']}' was added successfully.");
    }

    public function edit(Peran $peran)
    {
        $films = Film::orderBy('title')->get(['id', 'title']);
        $casts = Cast::orderBy('name')->get(['id', 'name']);

        return view('admin.perans.edit', compact('peran', 'films', 'casts'));
    }

    public function update(Request $request, Peran $peran)
    {
        $data = $request->validate([
            'actor'   => ['required', 'string', 'max:255'],
            'film_id' => ['required', 'exists:films,id'],
            'cast_id' => ['required', 'exists:casts,id'],
        ]);

        $peran->update($data);

        return redirect()->route('admin.perans.index')->with('success', "Film role '{$peran->actor}' was updated successfully.");
    }

    public function destroy(Peran $peran)
    {
        $peran->delete();

        return redirect()->route('admin.perans.index')->with('success', "Film role '{$peran->actor}' was deleted successfully.");
    }
}
