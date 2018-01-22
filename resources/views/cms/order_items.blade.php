@extends('cms.layouts.cms')

@section('more')
  @include('cms.header')
  <script src="{{asset('js/cms_order_items.js')}}"></script>
@endsection

@section('content')

@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'You are about to delete this order!',
  'action' => 'Confirm',
  'function' => 'deleteOrder()',])

@include('cms.modals.processed_confirm_modal',
  ['id' => 'processed_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Mark Order as processed!',
  'action' => 'Confirm',
  'function' => 'markProcessed()',])

@include('cms.alerts.success-alert')
<div class="summary-title">
  <div style="margin-bottom: 10px;">
    <a class="btn btn-primary" href="{{'../'}}"
      title="back">
      <i class="fa fa-arrow-left"
        style="font-size: 18px;"></i>
    </a>
  </div>
  <h3 style="display: inline; color: #337ab7;">Order Summary</h3>
</div>

<div class="order-summary">
    <span class="itemTitle">Order Number: </span>{{$order->id}} <br>
    <span class="itemTitle">Number Of Items: </span>{{$order->num_items}} <br>
    <span class="itemTitle">Customer Name: </span>{{$order->customer_name}} <br>
    <span class="itemTitle">Phone Number: </span>{{$order->customer_contact}} <br>
    <span class="itemTitle">Delivery Location: </span>{{$order->delivery_location}} <br>
    <span class="itemTitle">Delivery Price: </span>
    {{ number_format($order->delivery_price) }} <br>
    <span class="itemTitle">Order Amount: </span>
    {{ number_format($order->order_amount) }} <br>
    <span class="itemTitle">Total Amount: </span>
    {{ number_format($order->amount) }} <br>
    <span class="itemTitle">Order Status: </span>
    @php
      if($order->processed) {
        $class = "text-success";
        $text = "Processed";
      }
      else {
        $class = "text-warning";
        $text = "Pending";
      }
    @endphp
    <span id="status" class="{{$class}}">
      {{$text}}</span>
    @if(!$order->processed)
      <button type="button" name="button"
        class="btn btn-warning pull-right" title="mark as processed"
        onclick="showProcessedConfirmModal({{$order}})">
        Processed <i class="glyphicon glyphicon-check"></i>
      </button>
    @endif
    @if($order->processed)
      <button class="btn btn-danger pull-right" title="delete this order"
        onclick="showOrderDeleteModal({{$order}})">
        <span class="glyphicon glyphicon-trash"></span>
      </button>
    @endif
</div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold; color: #337ab7;" class="panel-title pull-left">
        Order Items:
      </h3>
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
