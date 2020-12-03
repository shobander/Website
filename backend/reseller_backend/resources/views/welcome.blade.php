<?php

use Custom\Basics;

$text= Basics::print();

?>

@extends('layouts.master')

@section('title', 'Test Page')

@section('content')

    <img src="{{ asset('images/sliders/image_1_lg.jpeg') }}">
    {{$text}}

@endsection