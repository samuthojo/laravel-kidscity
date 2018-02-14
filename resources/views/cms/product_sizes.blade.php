@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
<script src="{{asset('js/cms_product_sizes.js')}}"></script>
@endsection

@section('content')
@include('cms.modals.add_product_size_modal')
@include('cms.modals.edit_product_size_modal')
@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Delete this product-size!',
  'action' => 'Confirm',
  'function' => 'deleteProductSize()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('cms.alerts.success-alert')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold; color: #337ab7;"class="panel-title pull-left">
      Product Sizes: </h3>
     <span onclick="showModal('add_product_size_modal')" class="pull-right"
      title="add product-size">
       <i class="fa fa-plus-circle fa-2x text-primary" style="cursor: pointer;"></i>
     </span>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div id="productSizesTable" class="table-responsive">
    <table id="myTable" class="table table-hover">
      <thead>
        <th>No.</th>
        <th>Size</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach($productSizes as $productSize)
        <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
          <td>{{$loop->iteration}}</td>
          <td>{{$productSize->size}}</td>
          <td>
            <div class="btn-group">
              <button class="btn btn-warning" title="edit product-size"
                onclick="showEditProductSizeModal({{$productSize}})">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              <button class="btn btn-danger" title="delete product-size"
                onclick="showDeleteConfirmationModal({{$productSize}})">
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
              title: "Product Sizes",
              messageTop: "The List Of Product Sizes As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Product Sizes",
               messageTop: "The List Of Product Sizes As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Product Sizes",
               messageTop: "The List Of Product Sizes As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>
@endsection
