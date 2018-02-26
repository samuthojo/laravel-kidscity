@extends('cms.layouts.cms')

@section('content')

<style>
  .pictureContainer {
    display: inline-block;
    width: 430px;
    margin: 20px 20px 10px auto;
  }
  .pictureDiv {
    position: relative;
    max-width: 430px;
  }
  img {
    width: 100%;
  }
  .pictureSpinner {
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

<div class="row">

  <div class="col-md-12">
    @include('flash::message')
  </div>

</div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#editProduct">Product Details</a></li>
  <li><a data-toggle="tab" href="#changePicture">Change Pictures</a></li>
</ul>

<div class="tab-content" style="margin-top: 20px;">

  <div id="editProduct" class="tab-pane fade active in">
    @include('cms.products.edit_form')
  </div>

  <div id="changePicture" class="tab-pane fade">
    @include('cms.products.change_pictures')
  </div>

</div>

@endsection
