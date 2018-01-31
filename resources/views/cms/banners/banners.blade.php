@extends('cms.layouts.cms')

@section('more')
<style media="screen">
  img {
    width: 100%;
  }
  div.featured>img {
    width: 30% !important;
    height: 50% !important;
  }
  .text {
    text-align: center;
    z-index: 1;
    font-size: 2em;
    font-family: "PT Bold", sans-serif;
    color: #000;
  }
</style>
@endsection

@section('content')

<h3 class="text-primary">Manage Banners</h3>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#advert">Advert</a></li>
  <li><a data-toggle="tab" href="#main">Main</a></li>
  <li><a data-toggle="tab" href="#featured">Featured</a></li>
  <li><a data-toggle="tab" href="#categories">Categories</a></li>
</ul>

<div class="tab-content" style="margin-top: 20px;">
  <div id="advert" class="tab-pane fade in active">
    @include('cms.banners.advert')
  </div>

  <div id="main" class="tab-pane fade">
    @include('cms.banners.main')
  </div>

  <div id="featured" class="tab-pane fade">
    @include('cms.banners.featured')
  </div>

  <div id="categories" class="tab-pane fade">
    @include('cms.banners.categories')
  </div>
</div>

@endsection
