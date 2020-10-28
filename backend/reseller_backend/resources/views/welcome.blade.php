<?php

use Custom\Basics;

$text= Basics::print();

?>

@extends('layouts.master')

@section('title', 'Test Page')

@section('content')

    <img src="{{ asset('images/fortnite1.jpg') }}">
    {{$text}}

@endsection