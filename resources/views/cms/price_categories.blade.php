@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
<script src="{{asset('js/cms_categories.js')}}"></script>
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-sm-9">
{{--@include('cms.modals.add_category_modal')--}}
@include('cms.modals.edit_category_modal')
@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Delete this category and its Prices!',
  'action' => 'Confirm',
  'function' => 'deleteCategory()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('alerts.success-alert')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;"class="panel-title pull-left">
      Price Categories: </h3>
     {{--<span onclick="showModal('add_category_modal')" class="pull-right"
      title="add category">
       <i class="fa fa-plus-circle fa-2x text-success" style="cursor: pointer;"></i>
     </span>--}}
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div id="priceCategoriesTable" class="table-responsive">
    <table id="myTable" class="table table-hover">
      <thead>
        <th>No.</th>
        <th>Price Category</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach($priceCategories as $category)
        <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
          <td>{{$loop->iteration}}</td>
          <td id="{{'category_' . $category->id}}">{{$category->range}}</td>
          <td>
            <div class="btn-group" title="edit category">
              {{--<a class="btn btn-default" title="view Prices"
               href="{{url('/categories/' . $category->id . '/Prices')}}">
                <span class="glyphicon glyphicon-eye-open"></span>
              </a>--}}
              <button class="btn btn-warning"
                onclick="showEditCategoryModal({{$category->id}})">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              <button class="btn btn-danger" title="delete category"
                onclick="showDeleteConfirmationModal({{$category->id}})">
                <span class="glyphicon glyphicon-trash"></span>
              </button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>
</div>
<script>
  $(document).ready(function () {
    $("#myTable").dataTable({
        dom: 'Bfrtip',
        buttons: [
            {
              extend: 'print',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Categories",
              messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Categories",
               messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Categories",
               messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>

@endsection
