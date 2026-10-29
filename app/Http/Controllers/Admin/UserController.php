<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::select('id', 'name', 'email', 'phone', 'role_id', 'created_at')
            ->with('role')
            ->when($request->filled('s'), function ($q) use ($request) {
                $q->where(fn ($w) => $w
                    ->where('name', 'like', '%'.$request->s.'%')
                    ->orWhere('email', 'like', '%'.$request->s.'%'));
            })
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone'   => ['required', 'string', 'max:20'],
            'role_id' => ['required', 'in:1,2'],
        ]);

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', "Data pengguna '{$user->name}' berhasil diperbarui.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['user' => 'Anda tidak bisa menghapus akun Anda sendiri.']);
        }

        $user->kritiks()->delete();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "Pengguna '{$user->name}' berhasil dihapus.");
    }
}
