<?php

use App\Models\Product;
use App\Models\Order;

// Pending orders
$ords_pend= Order::where("status", "processing")->get();
$ords_pend_count= Order::where("status", "processing")->count();

// Completed orders
$ords_completed= Order::where("status", "success")->count();

// Number of products
$prods_no= Product::all()->count();

$title= "Dashboard";


// Message
if( ! isset($info_message) ){
    $info_message="";
}

?>

@extends('admin.master')

@section('title', $title)

@section('content')
<!-- info_Message -->
<div class="m-0 p-0 text-info">{{ $info_message }}</div>


<!-- TOP RIBBON -->
<div class="row">
    <div class="col-md-12 col-lg-6 col-xl-4 mb-4">
        <div class="card shadow border-left-warning py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Pending Orders</span></div>
                        <div class="text-dark font-weight-bold h6 mb-0">
                            <span>{{ $ords_pend_count }}</span>
                        </div>
                    </div>
                    <div class="col-auto align-self-start"><i class="fas fa-truck-moving fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-4 mb-4">
        <div class="card shadow border-left-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Completed Orders</span></div>
                        <div class="text-dark font-weight-bold h6 mb-0">
                            <span>{{ $ords_completed }}</span>
                        </div>
                    </div>
                    <div class="col-auto align-self-start"><i class="fas fa-check-double fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-4 mb-4">
        <div class="card shadow border-left-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Available Products</span></div>
                        <div class="text-dark font-weight-bold h6 mb-0">
                            <span>{{ $prods_no }}</span>
                        </div>
                    </div>
                    <div class="col-auto align-self-start"><i class="fab fa-product-hunt fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: TOP RIBBON -->


<div class="row mb-3">

    <!-- STORE IMAGES AND CAPTIONS -->
    <div class="col-lg-6 mt-2">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Store Images</p>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/admin/store_images')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image_1_lg"><strong>Image 1 LG</strong><br></label>
                                <input type="file" id="image_1_lg" class="form-control-file" name="image_1_lg">
                                @error("image_1_lg", "store_images")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image_1_sm"><strong>Image 1 SM</strong><br></label>
                                <input type="file" id="image_1_sm" class="form-control-file" name="image_1_sm">
                                @error("image_1_sm", "store_images")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image_2_lg"><strong>Image 2 LG</strong><br></label>
                                <input type="file" id="image_2_lg" class="form-control-file" name="image_2_lg">
                                @error("image_2_lg", "store_images")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image_2_sm"><strong>Image 2 SM</strong><br></label>
                                <input type="file" id="image_2_sm" class="form-control-file" name="image_2_sm">
                                @error("image_2_sm", "store_images")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image_3_lg"><strong>Image 3 LG</strong><br></label>
                                <input type="file" id="image_3_lg" class="form-control-file" name="image_3_lg">
                                @error("image_3_lg", "store_images")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image_3_sm"><strong>Image 3 SM</strong><br></label>
                                <input type="file" id="image_3_sm" class="form-control-file" name="image_3_sm">
                                @error("image_3_sm", "store_images")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save&nbsp;Changes</button></div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: STORE IMAGES -->

    <!-- STORE CAPTIONS -->
    <div class="col-lg-6 mt-2">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Store Image Captions</p>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/admin/store_captions')}}" method= "POST">
                            @csrf
                            <div class="form-group">
                                <label for="caption_1"><strong>Caption 1</strong><br></label>
                                <textarea class="form-control @error('caption_1', 'store_captions') is-invalid @enderror" id="caption_1" name="caption_1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="caption_2"><strong>Caption 2</strong><br></label>
                                <textarea class="form-control @error('caption_2', 'store_captions') is-invalid @enderror" id="caption_2" name="caption_2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="caption_3"><strong>Caption 3</strong><br></label>
                                <textarea class="form-control @error('caption_3', 'store_captions') is-invalid @enderror" id="caption_3" name="caption_3"></textarea>
                            </div>
                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Changes</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: STORE CAPTIONS -->

</div>
<!-- END: STORE IMAGES AND CAPTIONS -->

<!-- PENDING ORDERS -->
<div class="row">
    <div class="col-lg-12 col-xl-12" id="pending_orders_coll">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Pending Orders</h6>
            </div>
            <div class="card-body">
                <ul id="orders_ul" class="list-group">
                <!-- NO PENDING ORDERS -->
                @if( $ords_pend_count  < 1)  
                    <li class="list-group-item p-3">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <h6 class="mb-0"><strong>No Pending Orders</strong></h6>
                            </div>
                        </div>
                    </li>

                <!-- PENDING ORDERS -->
                @else

                    <?php
                    // Split orders into chunks
                    $chunk_size= 5;
                    $chunks= $ords_pend->chunk($chunk_size);

                    $order_chunk_no= 0;

                    $current_chunk= $chunks->get($order_chunk_no);
                    ?>

                    @foreach ($current_chunk as $order)

                    <?php
                    $product= Product::find($order->product_id)
                    ?>

                    <li class="list-group-item p-3">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <h6 class="mb-0"><strong>Order {{$order->id}}</strong></h6>
                                <div class="dropdown-divider"></div>
                                <div class="row">
                                    <div class="col d-none d-md-block">
                                        <p class="m-0">Product Name:</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">Product ID:</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">Game/App:</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">Quantity:</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">Price&nbsp;<strong>$</strong>:</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">Twitter:</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">IG:</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">Login ID:</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">Password:</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-truncate m-0">{{$product->name}}</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">{{$product->id}}</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="text-truncate m-0">{{$product->game_app}}</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">{{$order->quantity}}</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="m-0">{{$order->price}}</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="text-truncate m-0">{{$order->twitter}}</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="text-truncate m-0">{{$order->instagram}}</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="text-truncate m-0">{{$order->login}}</p>
                                        <div class="dropdown-divider"></div>
                                        <p class="text-truncate m-0">{{$order->password}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto align-self-start">
                                <div class="dropdown no-arrow">
                                    <button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">
                                        <i class="fas fa-ellipsis-v text-gray-400"></i>
                                    </button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-left dropdown-header">Status:</p><a class="dropdown-item text-success" href="/orders/{{$order->id}}/completed">Completed</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="/orders/{{$order->id}}/failed">Failed</a></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    @endforeach

                @endif

                </ul>     

                <!-- LOAD MORE BUTTON -->
                <ul class="list-group">
                    <li id="load_more_orders_li" class="list-group-item p-3">
                        <div class="row justify-content-center align-items-center no-gutters">
                            <div class="col col-10 col-sm-5 col-lg-4">
                                <a id="load_more_orders_bt" class="btn btn-outline-secondary btn-block border rounded-0" type="button">
                                    load more ({{$order_chunk_no+1}}/{{$chunks->count()}})&nbsp;<br><i class="far fa-arrow-alt-circle-down"></i>
                                </a>
                            </div>
                        </div>
                    </li>        
                </ul>

                <script>
                    // Chunk size
                    chunk_size= {{$chunk_size}};
                    // Next chunk
                    next_chunk= {{$order_chunk_no+1}};
                    curr_chunk= next_chunk;
                    // Chunk number
                    all_chunks= {{$chunks->count()}};
                    // Click event for load more button
                    load_more_callback= ()=>{
                        curr_chunk= next_chunk;
                        next_chunk= next_chunk+1;
                        $.get(  "{{url("/dashboard/")}}/{{$chunk_size}}/" + curr_chunk, function( data ) {
                            // HARD FIX
                            // Orders
                            $("#orders_ul").append($($(data)[0]).html());
                            // Update button text
                            $("#load_more_orders_bt").html("load more (" + next_chunk + "/" + all_chunks + ")&nbsp;<br><i class=\"far fa-arrow-alt-circle-down\"></i>");
                            // Disable button if all orders have been loaded
                            if(next_chunk == all_chunks){
                                $("#load_more_orders_bt").addClass("disabled");
                            }
                        })
                    }

                    $("#load_more_orders_bt").click(load_more_callback);                      
                    
                </script>
            </div>
        </div>
    </div>
</div>
<!-- PENDING ORDERS -->


@endsection