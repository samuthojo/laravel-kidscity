@extends('cms.layouts.cms')

@section('more')

@endsection

@section('content')
@include('modals.add_category_modal')
@include('modals.edit_category_modal')
@include('modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Delete this category and its products!',
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
      Product Categories: </h3>
     <span onclick="showModal('add_category_modal')" class="pull-right"
      title="add category">
       <i class="fa fa-plus-circle fa-2x text-success" style="cursor: pointer;"></i>
     </span>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div id="categoriesTable" class="table-responsive">
    <table id="myTable" class="table table-hover">
      <thead>
        <th>No.</th>
        <th>Name</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
          <td>{{$loop->iteration}}</td>
          <td id="{{'category_' . $category->id}}">{{$category->name}}</td>
          <td>
            <div class="btn-group" title="edit category">
              <a class="btn btn-default" title="view products"
               href="{{url('/categories/' . $category->id . '/products')}}">
                <span class="glyphicon glyphicon-eye-open"></span>
              </a>
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
              messageTop: "The List Of Product Categories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Categories",
               messageTop: "The List Of Product Categories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Categories",
               messageTop: "The List Of Product Categories As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>

@endsection
