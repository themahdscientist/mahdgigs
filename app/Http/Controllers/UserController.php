<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['index', 'create']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_fields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Hash Password
        $form_fields['password'] = bcrypt($form_fields['password']);

        $user = User::create($form_fields);

        auth()->login($user);

        return redirect('/')->with('message', 'You\'ve been registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Display a list of user listings.
     */
    public function listings(Request $request)
    {
        return view('users.listings', ['listings' => auth()->user()->listings()->get()]);
    }

    /**
     * Login the user.
     */
    public function authenticate(Request $request)
    {

        if (auth()->attempt($request->validate(['email' => 'required|email', 'password' => 'required']))) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You\'ve been logged in successfully');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    /**
     * Logout the user and reinitialize the session.
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You\'ve logged out successfully');
    }
}