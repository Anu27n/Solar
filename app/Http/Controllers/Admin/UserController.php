<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn ($q) => $q->where('name', 'like', "%$s%")->orWhere('email', 'like', "%$s%"));
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:150',
            'avatar' => 'nullable|image|max:4096',
            'role' => 'required|in:admin,channel_partner,employee,customer',
            'password' => ['required', Password::min(8)],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        unset($validated['avatar']);

        $user = User::create($validated);

        if ($request->hasFile('avatar')) {
            $user->update([
                'avatar_path' => $request->file('avatar')->store('avatars', 'public'),
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:150',
            'avatar' => 'nullable|image|max:4096',
            'remove_avatar' => 'nullable|boolean',
            'role' => 'required|in:admin,channel_partner,employee,customer',
        ];
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::min(8)];
        }

        $validated = $request->validate($rules);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        unset($validated['avatar'], $validated['remove_avatar']);

        if ($request->hasFile('avatar')) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            $validated['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        } elseif ($request->boolean('remove_avatar') && $user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
            $validated['avatar_path'] = null;
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function toggleActive(User $user)
    {
        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'User status updated.');
    }
}
