<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (! Gate::allows('admin-access')) {
            abort(403);
        }

        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        if (! Gate::allows('admin-access')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'admin' => 'required|string|in:user,admin',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'admin' => $validated['admin'],
            'is_admin' => $validated['admin'] === 'admin',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được tạo thành công!');
    }

    public function show(User $user)
    {
        if (! Gate::allows('admin-access')) {
            abort(403);
        }

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (! Gate::allows('admin-access')) {
            abort(403);
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (! Gate::allows('admin-access')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'admin' => 'required|string|in:user,admin',
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'admin' => $validated['admin'],
            'is_admin' => $validated['admin'] === 'admin',
        ];

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được cập nhật thành công!');
    }

    public function destroy(User $user)
    {
        if (! Gate::allows('admin-access')) {
            abort(403);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được xóa thành công!');
    }
}
