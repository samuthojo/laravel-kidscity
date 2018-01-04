@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
  <script src="{{asset('js/cms_products.js')}}"></script>
  <style>
    td.details-control {
      background: url('../images/details_open.png') no-repeat center;
      cursor: pointer;
    }
    tr.shown td.details-control {
      background: url('../images/details_close.png') no-repeat center;
    }
  </style>
@endsection

@section('content')

@include('cms.modals.add_product_modal')
@include('cms.modals.edit_product_modal')
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
        Products:
      </h3>
      <span class="pull-right text-primary"
        title="add product" style="cursor: pointer;"
        onclick="showModal('add_product_modal')">
        <i class="fa fa-plus-circle fa-2x"></i>
      </span>
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
            <th>PriceCategory</th>
            <th>AgeRange</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td class="details-control" title="view more"></td>
                <td style="display: none;">{{$product->id}}</td>
                <td>{{$loop->iteration}}</td>
                <td id="">{{$product->name}}</td>
                <td id="">{{$product->category_name}}</td>
                <td id="">{{$product->price_category}}</td>
                <td id="">
                  {{$product->age_range}}
                </td>
                <td id="">
                  {{$product->brand_name}}
                </td>
                <td id="">
                  {{ number_format($product->price) }}
                </td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-default" title="view prices"
                      href="{{url('/products/' . $product->id . '/prices')}}">
                      <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <button class="btn btn-warning" title="edit product"
                      onclick="showEditProductModal({{$product}})">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-danger" title="delete product"
                      onclick="showProductDeleteModal({{$product->id}})">
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

     $("#category_id").click(function() {
       $(this).next().fadeOut(0);
     });

     $("#edit_category_id").click(function() {
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
         var link = "/products/" + product_id + "/product_details";
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
