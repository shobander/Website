<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CarouselItem;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


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
        return redirect()->route("admin.profile", ["info_message"=>"User Created"]);
        

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
    public function dashboard(Request $request)
    {
        // Pass on query string
        $info_message= $request->query("info_message");

        return view('admin.dashboard', ["info_message"=>$info_message]);
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
     * Upload store images
     * 
     * @param \Illuminate\Http\Requetst
     * @return \Illuminate\Http\Response
     */
    public function store_images(Request $request){

        // Validate array
        $val_arr= [
            "image_1_lg"=>"nullable | image | dimensions:ratio=5/2",
            "image_1_sm"=>"nullable | image | dimensions:ratio=3/4",
            "image_2_lg"=>"nullable | image | dimensions:ratio=5/2",
            "image_2_sm"=>"nullable | image | dimensions:ratio=3/4",
            "image_3_lg"=>"nullable | image | dimensions:ratio=5/2",
            "image_3_sm"=>"nullable | image | dimensions:ratio=3/4",
        ];

        // Validate images
        $validator= Validator::make($request->all(), $val_arr);

        // Failed validation
        if($validator->fails()){
            return redirect()->route("dashboard")
                                ->withErrors($validator, "store_images")
                                ->withInput();
        }


        // Success validation
        // Save images
        // Track saved images
        $no_saved= 0;
        foreach ($val_arr as $key => $value){
            
            if( null !== $request->file($key) ){

                $filefolder= "sliders/";
                $filename= $key . "." . $request->file($key)->extension();

                $request->file($key)->storeAs(
                $filefolder, $filename, "images"
                );
                $no_saved++;

                $exploded= \explode("_", $key);
                $carousel_no= \intval($exploded[1]);
                $img_size= $exploded[2];

                // Update Carousel Table
                if( null == CarouselItem::find($carousel_no) ){
                    // If carousel doesn't already exist
                    $new_car= new CarouselItem();
                    $new_car->id= $carousel_no;
                    $new_car->caption= "";
                    
                    // Large image
                    if($img_size == "lg"){
                        $new_car->img_lg= $filefolder . $filename;
                        $new_car->img_sm= "";
                    }

                    // Small image
                    if($img_size == "sm"){
                        $new_car->img_sm= $filefolder . $filename;
                        $new_car->img_lg= "";
                    }

                    // Save carousel
                    $new_car->save();

                }
                else{
                // If carousel item already exists
                    $car_item= CarouselItem::find($carousel_no);
                    $img_size= "img_".$img_size;
                    $car_item->$img_size= $filefolder . $filename;
                    // Save
                    $car_item->save();
                }
            } 
        }

        // Return to Dashboard
        return redirect()->route("dashboard", ["info_message"=> $no_saved." image(s) saved"]);

    }


    /**
     * Upload store images
     * 
     * @param \Illuminate\Http\Requetst
     * @return \Illuminate\Http\Response
     */
    public function store_captions(Request $request){

        // Validation array
        $val_arr= [
            "caption_1"=>"nullable | string | max:255",
            "caption_2"=>"nullable | string | max:255",
            "caption_3"=>"nullable | string | max:255"
        ];

        // Validate images
        $validator= Validator::make($request->all(), $val_arr);

        // Failed validation
        if($validator->fails()){
            return redirect()->route("dashboard")
                                ->withErrors($validator, "store_captions")
                                ->withInput();
        }

        // Success validation
        // Track number of updates
        $no_saved= 0;
        
        foreach ($val_arr as $key => $value){
            
            if( null !== $request->$key ){

                // Get item number
                $carousel_no= \intval(\explode("_", $key)[1]);

                // Update Carousel Table
                if( null == CarouselItem::find($carousel_no) ){
                    // If carousel doesn't already exist
                    $new_car= new CarouselItem();
                    $new_car->id= $carousel_no;
                    $new_car->caption= $request->$key;
                    $new_car->img_lg= "";
                    $new_car->img_sm= "";

                    // Save
                    $new_car->save();
                }
                else{
                    // If carousel item already exists
                    $car_item= CarouselItem::find($carousel_no);
                    // Update caption
                    $car_item->caption= $request->$key;
                    
                    // Save
                    $car_item->save();
                }

                $no_saved++;

            }
        }

        // Return to Dashboard
        return redirect()->route("dashboard", ["info_message"=> $no_saved." caption(s) updated"]);


    }

    /**
     * Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        // Pass on query string
        $info_message= $request->query("info_message");

        return view('admin.profile', ["info_message"=>$info_message]);
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
        return redirect()->route("admin.profile", ["info_message"=>"Password Changed"]);

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
