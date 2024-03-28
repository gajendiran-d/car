<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function user()
    {
        $user = \App\User::where('type', '!=', 'A');
        $user = $user->orderBy('name', 'desc')->get();
        $count =count($user);
        return view('user',compact('user','count'));
    }

    public function updateUser(Request $request)
    {
        $user= \App\User::updateOrCreate(['id'=>$request->get('id')]);
        $user->type=$request->get('type');
        $user->save();
        return redirect('user')->with('success', 'User changed successfully');
    }
}
