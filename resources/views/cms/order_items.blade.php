@extends('cms.layouts.cms')

@section('more')
  @include('cms.header')
@endsection

@section('content')

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('cms.alerts.success-alert')
  <p style="color: #000;">
    <span class="itemTitle">Order No.: </span>{{$order->id}} <br>
    <span class="itemTitle"># Items: </span>{{$order->num_items}} <br>
    <span class="itemTitle">Customer: </span>{{$order->customer_name}} <br>
    <span class="itemTitle">Contact: </span>{{$order->customer_contact}} <br>
    <span class="itemTitle">Amount: </span>{{ number_format($order->amount) }} <br>
    <span class="itemTitle">Delivery Location: </span>{{$order->delivery_location}} <br>
    <span class="itemTitle">Delivery Price: </span>
    {{ number_format($order->delivery_price) }}
  </p>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold; color: #337ab7;" class="panel-title pull-left">
        Order Items:
      </h3>
      <a class="btn btn-primary pull-right" href="{{'../'}}"
        title="back">
        <i class="fa fa-arrow-left"
          style="font-size: 16px;"></i>
      </a>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div id="orderItemsTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
          </thead>
          <tbody>
            @foreach($items as $item)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td>{{$item->name}}</td>
                <td>{{ number_format($item->price) }}</td>
                <td>{{$item->quantity}}</td>
                <td>
                  {{ number_format($item->totalPrice) }}
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
                title: "Order No. {{$order->id}} Items",
                messageTop: "The List Of Items"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Order No. {{$order->id}} Items",
                 messageTop: "The List Of Items"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Order No. {{$order->id}} Items",
                 messageTop: "The List Of Items"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });
    });
  </script>
@endsection
