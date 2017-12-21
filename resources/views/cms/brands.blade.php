@extends('cms.layouts.cms')

@section('more')
  <link href="{{asset('css/cms_brands.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="col-sm-3 brands-form">
    <h3 class="brand-form-title text-primary">Create New Brand</h3>
    <form name="brands-form" id="brands-form">
      <div class="form-group">
        <input type="text" name="name" placeholder="Brand Name"
          class="form-control" autofocus>
      </div>
      <div class="form-group">
        <textarea name="description" rows="8" cols="13"
          class="form-control" placeholder="Short Description"></textarea>
      </div>
      <div class="form-group">
        <input type="file" name="image_url">
      </div>
      <div class="form-group">
        <button type="button" name="create-brand"
          class="btn btn-primary pull-right">
          Create
        </button>
      </div>
    </form>
  </div>
@endsection
