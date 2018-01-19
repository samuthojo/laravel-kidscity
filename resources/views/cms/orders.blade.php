@extends('cms.layouts.cms')

@section('more')
  @include('cms.header')
  <script src="{{asset('js/cms_orders.js')}}"></script>
@endsection

@section('content')

@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'You are about to delete this order!',
  'action' => 'Confirm',
  'function' => 'deleteOrder()',])
@include('cms.modals.confirmation_modal',
  ['id' => 'processed_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Mark Order as processed!',
  'action' => 'Confirm',
  'function' => 'markProcessed()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('cms.alerts.success-alert')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold; color: #337ab7;" class="panel-title pull-left">
        Orders:
      </h3>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div id="ordersTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>Date Ordered</th>
            <th>Order No.</th>
            <th>Customer</th>
            <th>Contact</th>
            <th>#items</th>
            <th>Amount</th>
            <th>DeliveryLocation</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($orders as $order)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td>{{$order->created_at}}</td>
                <td>{{$order->id}}</td>
                <td>{{$order->customer_name}}</td>
                <td>{{$order->customer_contact}}</td>
                <td>
                  {{$order->num_items}}
                </td>
                <td>
                  {{ number_format($order->amount) }}
                </td>
                <td>{{ $order->delivery_location }}</td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('orders.items', ['order' => $order->id]) }}"
                      title="view items" class="btn btn-default">
                      <i class="glyphicon glyphicon-eye-open"></i>
                    </a>
                    <button type="button" name="button"
                      class="btn btn-warning" title="processed"
                      onclick="showProcessedConfirmModal({{$order}})">
                      <i class="glyphicon glyphicon-check"></i>
                    </button>
                    <button class="btn btn-danger" title="delete order"
                      onclick="showOrderDeleteModal({{$order}})">
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
                title: "Product Orders",
                messageTop: "The List Of Orders As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Product Orders",
                 messageTop: "The List Of Orders As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Product Orders",
                 messageTop: "The List Of Orders As Of {{date('d-m-Y')}}"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });
    });
  </script>
@endsection
