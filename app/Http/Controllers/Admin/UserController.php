<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $lang)
    {
        $users = User::with('purchases.book')->where('is_admin', false)->paginate(request('per_page', 10));
        return view('admin.users.index', compact('users', 'lang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $lang)
    {
        return view('admin.users.create', compact('lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $lang)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'balance' => 'nullable|numeric|min:0',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'balance' => $request->balance ?? 100.00,
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index', $lang)
            ->with('success', __('messages.user_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $lang, User $user)
    {
        $user->load('purchases.book');
        return view('admin.users.show', compact('user', 'lang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $lang, User $user)
    {
        return view('admin.users.edit', compact('user', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $lang, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'balance' => 'required|numeric|min:0',
        ]);

        $data = $request->only(['name', 'email', 'balance']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index', $lang)
            ->with('success', __('messages.user_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $lang, User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.users.index', $lang)
                ->with('error', __('messages.cannot_delete_admin'));
        }

        $user->delete();

        return redirect()->route('admin.users.index', $lang)
            ->with('success', __('messages.user_deleted'));
    }
}