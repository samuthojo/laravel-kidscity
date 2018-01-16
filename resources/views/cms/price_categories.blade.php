@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
<script src="{{asset('js/cms_price_categories.js')}}"></script>
@endsection

@section('content')

@include('cms.modals.add_price_category_modal')
@include('cms.modals.edit_price_category_modal')
@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Delete PriceCategory!',
  'action' => 'Confirm',
  'function' => 'deletePriceCategory()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('cms.alerts.success-alert')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold; color: #337ab7;"class="panel-title pull-left">
      Price Categories: </h3>
      <span onclick="showModal('add_price_category_modal')" class="pull-right"
       title="add price-category">
        <i class="fa fa-plus-circle fa-2x text-primary" style="cursor: pointer;"></i>
      </span>
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
        @foreach($priceCategories as $priceCategory)
        <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
          <td>{{$loop->iteration}}</td>
          <td>{{$priceCategory->range}}</td>
          <td>
            <div class="btn-group" title="edit price-category">
              <a class="btn btn-default" title="view products"
               href="{{route('price_categories.products', ['priceCategory' => $priceCategory->id])}}">
                <span class="glyphicon glyphicon-eye-open"></span>
              </a>
              <button class="btn btn-warning"
                onclick="showEditPriceCategoryModal({{$priceCategory}})">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              <button class="btn btn-danger" title="delete price-category"
                onclick="showDeleteConfirmationModal({{$priceCategory}})">
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
              title: "Price Categories",
              messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Price Categories",
               messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Price Categories",
               messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>
@endsection
