@extends('cms.layouts.cms')

@section('content')

<script type="text/javascript">

function fetchSubCategories() {
  $("#subCategorySelector").prop("disabled", false);
  $(".select_loader").fadeIn(0);
  var category_id = $("#categorySelector").val();
  if(category_id != "" && category_id != null) {
    var link = '/admin/categories/' + category_id + '/sub_categories';
    $.getJSON(link)
     .done(function (data) {
       $(".select_loader").fadeOut(0);
       setUpSubCategories(data);
     })
     .fail(function (error) {
       $(".select_loader").fadeOut(0);
       $("#subCategorySelector").prop("disabled", true);
       console.log(error);
     });
  }
  else {
    $(".select_loader").fadeOut(0);
    $("#subCategorySelector").prop("disabled", true);
    //Leave the first option, delete the rest
    $("#subCategorySelector").find('option').not(':first').remove();
  }
}

function setUpSubCategories(data) {
    var mySelect = document.getElementById("subCategorySelector");

    //Leave the first option, delete the rest
    $("#subCategorySelector").find('option').not(':first').remove();

    for(i = 0; i < data.length; i++) {
       var opt = document.createElement("option");
       opt.value= data[i].id;
       opt.innerHTML = data[i].name;

       // then append it to the select element
       mySelect.appendChild(opt);
    }
}

</script>

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
