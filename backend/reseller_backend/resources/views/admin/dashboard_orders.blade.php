<?php

use App\Models\Product;
use App\Models\Order;


// Pending orders
$ords_pend= Order::where("status", "processing")->get();
$ords_pend_count= Order::where("status", "processing")->count();

$title= "Dashboard";


// $chunk_size and $order_chunk_no are passed from controller

// Split orders into chunks
$chunks= $ords_pend->chunk($chunk_size);

// Next chunk
$all_orders_shown= false;
$next_chunk= $order_chunk_no+1;
if ($next_chunk > $chunks->count()){
    $all_orders_shown= true;
}

// $order_chunk_no is passed from controller
$current_chunk= $chunks->get($order_chunk_no);

?>


<div id="more_orders_div">

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

</div>

<!-- LOAD MORE BUTTON -->
<li id="load_more_orders_li" class="list-group-item p-3">
    <div id="load_more_orders_div" class="row justify-content-center align-items-center no-gutters">
        <div class="col col-10 col-sm-5 col-lg-4">
        @unless($all_orders_shown)
            <a id="load_more_orders_bt" class="btn btn-outline-secondary btn-block border rounded-0" type="button">
                load more ({{$chunk_size*($order_chunk_no)}}/{{$ords_pend->count()}})&nbsp;<br><i class="far fa-arrow-alt-circle-down"></i>
            </a>
        @endunless
        </div>
    </div>
</li>



