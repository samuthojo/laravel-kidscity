@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
  <script src="{{asset('js/cms_price_category_products.js')}}"></script>
  <link rel="stylesheet" href="{{asset('css/product_modal_styles.css')}}">
  <style>
    td.details-control {
      background: url('../../../images/details_open.png') no-repeat center;
      cursor: pointer;
    }
    tr.shown td.details-control {
      background: url('../../../images/details_close.png') no-repeat center;
    }
  </style>
@endsection

@section('content')

@include('cms.modals.add_price_category_product_modal')
@include('cms.modals.edit_price_category_product_modal')
@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'You are about to delete this product!',
  'action' => 'Confirm',
  'function' => 'deleteProduct()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('cms.alerts.success-alert')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold; color: #337ab7;" class="panel-title pull-left">
        {{$priceCategory->range}} Products:
      </h3>
      <div class="btn-group pull-right">
        <a class="btn btn-primary" href="{{url('admin/price_categories')}}"
          title="back">
          <i class="fa fa-arrow-left"
            style="font-size: 16px;"></i>
        </a>
        <button class="btn btn-primary"
          title="add product" style="cursor: pointer;"
          onclick="showAddModal({{$priceCategory->id}})">
          <i class="fa fa-plus-circle" style="font-size: 16px;"></i>
        </button>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div id="productsTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th></th>
            <th style="display: none;"></th>
            <th>No.</th>
            <th>Name</th>
            <th>Category</th>
            <th>SubCategory</th>
            <th>AgeRange</th>
            <th>Brand</th>
            <th>Gender</th>
            <th>Price</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td class="details-control" title="view more"></td>
                <td style="display: none;">{{$product->id}}</td>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->category_name}}</td>
                <td>{{$product->sub_category_name}}</td>
                <td>
                  {{$product->age_range}}
                </td>
                <td>
                  {{$product->brand_name}}
                </td>
                <td>{{($product->gender) ? 'Female' : 'Male'}}</td>
                <td>
                  {{ number_format($product->price) }}
                </td>
                <td>
                  <div class="btn-group">
                    <!-- <a class="btn btn-default" title="view prices"
                      href="{{url('/products/' . $product->id . '/prices')}}">
                      <span class="glyphicon glyphicon-eye-open"></span>
                    </a> -->
                    <button class="btn btn-warning" title="edit product"
                      onclick="showEditProductModal({{$product}}, {{$priceCategory}})">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-danger" title="delete product"
                      onclick="showProductDeleteModal({{$product}}, {{$priceCategory}})">
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
  $(document).ready( function() {
    callMe();
  });

  function callMe() {
    table = $("#myTable").DataTable({
       dom: 'Bfrtip',
       buttons: [
           {
             extend: 'print',
             exportOptions: {
               columns: ":not(:last-child)"
             },
             title: "Products",
             messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'excel',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Products",
              messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'pdf',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Products",
              messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
           }
       ],
       iDisplayLength: 8,
       bLengthChange: false
     });

     $("#brand_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#edit_brand_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#category_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#edit_category_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#sub_category_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#edit_sub_category_id").click(function() {
       $(this).next().fadeOut(0);
     });
     $("#price_category_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#edit_price_category_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#product_age_range_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#edit_product_age_range_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#gender").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#edit_gender").click(function() {
       $(this).next().fadeOut(0);
     });

     $(":text").keydown(function() {
       $(this).next().fadeOut(0);
     });

     // Add event listener for opening and closing details
     $('#myTable tbody').on('click', 'td.details-control', function () {
       var tr = $(this).closest('tr');
       var row = table.row( tr );

       var product_id = row.data()[1];

       if ( row.child.isShown() ) {
           // This row is already open - close it
           row.child.hide();
           tr.removeClass('shown');
       }
       else {
         var link = "/admin/products/" + product_id + "/product";
              $.getJSON(link)
               .done( function (product) {
                 row.child.hide();
                 tr.removeClass('shown');
                 row.child(format(product)).show();
                 tr.addClass('shown');
               })
               .fail( function (error) {
                 console.log(error);
               });
               row.child(format2()).show();
               tr.addClass('shown');
       }
     });
  }
</script>
@endsection
