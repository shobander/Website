<?php

use App\Models\Product;
use App\Models\Order;

// Pending orders
$ords_pending= Order::where("status", "processing")->count();

// Completed orders
$ords_completed= Order::where("status", "success")->count();

// Number of products
$prods_no= Product::all()->count();

$title= "Dashboard";

?>

@extends('admin.master')

@section('title', $title)

@section('content')

<!-- TOP RIBBON -->
<div class="row">
    <div class="col-md-12 col-lg-6 col-xl-4 mb-4">
        <div class="card shadow border-left-warning py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Pending Orders</span></div>
                        <div class="text-dark font-weight-bold h6 mb-0">
                            <span>{{ $ords_pending }}</span>
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

@endsection