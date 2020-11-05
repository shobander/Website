<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate entries
        $validator= Validator::make($request->all(), [
            "name"=> "required|max:255",
            "email"=> "required|unique:users|email:rfc,dns",
            "password"=>"required"
        ]);

        if($validator->fails()){
            return redirect()->route("users.profile")
                                ->withErrors($validator)
                                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    /**
     * Dashboard orders
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard_orders($chunk_size, $order_chunk_no)
    {
        if(is_null($order_chunk_no)){
            $order_chunk_no= 1;
        }

        return view('admin.dashboard_orders', [
            "chunk_size"=> $chunk_size,
            "order_chunk_no"=> $order_chunk_no
        ]);
    }

    /**
     * Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Logout current user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        // If there's an authenticated user, log her out
        if(Auth::check()){
            Auth::logout();
        }
    }

}
