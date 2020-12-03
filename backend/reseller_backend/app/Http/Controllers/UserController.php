<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Actions\Fortify\CreateNewUser;

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
            "name"=> "required",
            "email"=> "required|unique:users|email:rfc,dns",
            "password"=>"required"
        ]);

        if($validator->fails()){
            return redirect()->route("admin.profile")
                                ->withErrors($validator, "create")
                                ->withInput();
        }

        // Success Validation
        // Create new user
        $new_user= new User();
        $new_user->name= $request->name;
        $new_user->email= $request->email;
        $new_user->password= Hash::make($request->password);
        // Save new user
        $new_user->save();

        // Return with success message
        return redirect()->route("admin.profile", ["message"=>"User Created"]);
        

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
    public function profile(Request $request)
    {
        // Pass on query string
        $message= $request->query("message");

        return view('admin.profile', ["message"=>$message]);
    }

    /**
     * Change Password
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request){

        // Validation
        $validator= Validator::make($request->all(), [
            "password"=>"password",
            "new_password"=> "min:8",
            "confirm_password"=>"required_if:new_password, same:new_password"
        ]);

        if($validator->fails()){
            return redirect()->route("admin.profile")
                                ->withErrors($validator, "password_bag")
                                ->withInput();
        }

        // Change password
        $user= Auth::user();
        $user->password= Hash::make($request->new_password);
        $user->save();

        // Success
        return redirect()->route("admin.profile", ["message"=>"Password Changed"]);

    }

    /**
     * Delete
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete(){

        // Delete account
        User::destroy(Auth::id());

        return redirect()->route("dashboard");

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
