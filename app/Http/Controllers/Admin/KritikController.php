<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kritik;
use Illuminate\Http\Request;

class KritikController extends Controller
{
    public function index(Request $request)
    {
        $kritiks = Kritik::select('id', 'comment', 'rating', 'film_id', 'user_id', 'created_at')
            ->with(['film', 'user'])
            ->when($request->filled('s'), function ($q) use ($request) {
                $q->where('comment', 'like', '%'.$request->s.'%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.kritiks.index', compact('kritiks'));
    }

    public function destroy(Kritik $kritik)
    {
        $kritik->delete();

        return redirect()->route('admin.kritiks.index')->with('success', 'Review deleted successfully.');
    }
}
