@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
<script src="{{asset('js/cms_sub_categories.js')}}"></script>
@endsection

@section('content')
@include('cms.modals.add_sub_category_modal')
@include('cms.modals.edit_sub_category_modal')
@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Delete SubCategory and its products!',
  'action' => 'Confirm',
  'function' => 'deleteSubCategory()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('cms.alerts.success-alert')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold; color: #337ab7;"class="panel-title pull-left">
      Product SubCategories: </h3>
     <span onclick="showModal('add_sub_category_modal')" class="pull-right"
      title="add sub-category">
       <i class="fa fa-plus-circle fa-2x text-primary" style="cursor: pointer;"></i>
     </span>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div id="subCategoriesTable" class="table-responsive">
    <table id="myTable" class="table table-hover">
      <thead>
        <th>No.</th>
        <th>SubCategory</th>
        <th>Category</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach($subCategories as $subCategory)
        <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
          <td>{{$loop->iteration}}</td>
          <td>{{$subCategory->name}}</td>
          <td>{{$subCategory->category}}</td>
          <td>
            <div class="btn-group">
              <a class="btn btn-default" title="view products"
               href="{{ route('sub_categories.products', ['subCategory' => $subCategory->id]) }}">
                <span class="glyphicon glyphicon-eye-open"></span>
              </a>
              <button class="btn btn-warning" title="Edit SubCategory"
                onclick="showEditSubCategoryModal({{$subCategory}})">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              <button class="btn btn-danger" title="Delete SubCategory"
                onclick="showDeleteConfirmationModal({{$subCategory}})">
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
              title: "SubCategories",
              messageTop: "The List Of Product SubCategories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "SubCategories",
               messageTop: "The List Of Product SubCategories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "SubCategories",
               messageTop: "The List Of Product SubCategories As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>
@endsection
