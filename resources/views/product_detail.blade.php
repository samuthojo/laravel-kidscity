@extends('layouts.shopping')

@section('styles')
    <link href="{{asset('css/product_detail.css')}}" rel="stylesheet">
@endsection

@section('nav_items')
    <a href="{{url('/shop')}}">SHOP</a>
@endsection

@section('content')
    <div class="main-wrapper">
        @include('product_detail.index')
        @include('scripts')
    </div>
@endsection