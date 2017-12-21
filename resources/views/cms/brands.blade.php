@extends('cms.layouts.cms')

@section('more')
  <link rel="stylesheet" href="{{asset('css/cms_brands.css')}}">
@endsection

@section('content')
<div class="brands-header">
    <h3 class="title">Brands</h3>
    <div class="clearfix"></div>
  </div>

  <div class="brands col-sm-9">

    <div class="row">
      @foreach($brands as $brand)
      <div class="col-sm-4">
        <div class="brand">
          <div class="brand-picture ">
            <img src="{{asset('images/brands/' . $brand->image_url)}}"
              class="img-rounded">
          </div>
          <div class="brand-info ">
            <div class="brand-name ">
              {{$brand->name}}
            </div>
            <div class="brand-description ">
              {{$brand->description}}
            </div>
            <div class="controls">
              <div class="btn-group pull-right">
                <button type="button" name="button" class="btn btn-warning"
                  title="edit">
                  <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button type="button" name="button" class="btn btn-danger"
                  title="delete">
                  <span class="glyphicon glyphicon-trash"></span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
   </div>
  </div>

  </div>

@endsection
