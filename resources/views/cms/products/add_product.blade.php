@extends('cms.layouts.cms')

@section('content')

{!!
    Form::open([
        'files'  => true,

        'class' =>  'form-horizontal',

        'method' => 'POST',

        'route'  => ['products.store'],
    ])
!!}

<div class="panel panel-default">

  <div class="panel-heading">

    <h4 class="title pull-left">New Product</h4>

    <div class="btn-group pull-right">

      <a
          class="btn btn-default"
          href="{{ route('products.index') }}"
          title="Cancel">
          Cancel
      </a>

      {!!
          Form::button('Create', [
              'type' => 'submit',

              'class' => 'btn btn-primary',

              'title' => 'Create',
          ])
      !!}

    </div>

    <div class="clearfix"></div>

  </div>

  <div class="panel-body">

    @include ('cms.products.form')

  </div>

</div>

{!! Form::close() !!}

@endsection
