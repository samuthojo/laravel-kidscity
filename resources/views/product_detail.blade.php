@extends('layouts.app')

@section('styles')
    <link href="{{asset('css/product_detail.css')}}" rel="stylesheet">
@endsection

@section('page-title')
    {{$product->name}}
@endsection

@section('content')
    <div class="main-wrapper for-lg">
        @include('product_detail.index')
        @include('scripts')
    </div>
@endsection