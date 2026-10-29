<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function index(Request $request)
    {
        $casts = Cast::select('id', 'name', 'age', 'bio')
            ->when($request->filled('s'), function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->s.'%');
            })
            ->orderByRaw('CASE WHEN name = ? THEN 0 ELSE 1 END', ['Gavrila Putri Polean'])
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.casts.index', compact('casts'));
    }

    public function create()
    {
        return view('admin.casts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
            'age'  => ['required', 'integer', 'min:1', 'max:120'],
            'bio'  => ['required', 'string', 'max:255'],
        ]);

        Cast::create($data);

        return redirect()->route('admin.casts.index')->with('success', "Cast member '{$data['name']}' was added successfully.");
    }

    public function edit(Cast $cast)
    {
        return view('admin.casts.edit', compact('cast'));
    }

    public function update(Request $request, Cast $cast)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
            'age'  => ['required', 'integer', 'min:1', 'max:120'],
            'bio'  => ['required', 'string', 'max:255'],
        ]);

        $cast->update($data);

        return redirect()->route('admin.casts.index')->with('success', "Cast member '{$cast->name}' was updated successfully.");
    }

    public function destroy(Cast $cast)
    {
        if ($cast->perans()->exists()) {
            return back()->withErrors(['cast' => "Cast member '{$cast->name}' is assigned to {$cast->perans()->count()} film role(s) and cannot be deleted."]);
        }

        $cast->delete();

        return redirect()->route('admin.casts.index')->with('success', "Cast member '{$cast->name}' was deleted successfully.");
    }
}
