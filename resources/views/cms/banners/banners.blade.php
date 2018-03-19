@extends('cms.layouts.cms')

@section('more')
<style>
  .bannerContainer {
    display: inline-block;
    width: 430px;
    margin: 20px 20px 10px auto;
  }
  .bannerDiv {
    position: relative;
    max-width: 430px;
  }
  img {
    width: 100%;
  }
  .bannerSpinner {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    height: 3em;
    margin: auto;
    width: 100%;
    text-align: center;
  }
</style>
@endsection

@section('content')

@include('cms.alerts.success-alert')

<h3 class="text-primary">Manage Banners</h3>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#advertArea">Advert</a></li>
  <li><a data-toggle="tab" href="#mainArea">Main</a></li>
  <li><a data-toggle="tab" href="#featuredArea">Featured</a></li>
  <li><a data-toggle="tab" href="#categoriesArea">Categories</a></li>
</ul>

<div class="tab-content" style="margin-top: 20px;">
  <div id="advertArea" class="tab-pane fade active in">
    @include('cms.banners.advert')
  </div>

  <div id="mainArea" class="tab-pane fade">
    @include('cms.banners.main')
  </div>

  <div id="featuredArea" class="tab-pane fade">
    @include('cms.banners.featured')
  </div>

  <div id="categoriesArea" class="tab-pane fade">
    @include('cms.banners.categories')
  </div>
</div>

@endsection
