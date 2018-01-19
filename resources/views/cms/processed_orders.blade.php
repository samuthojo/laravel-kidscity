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

@include('cms.alerts.success-alert')
<ul class="nav nav-tabs">
  <li class="{{isActiveRoute('orders.index')}}">
    <a href="{{route('orders.index')}}">Pending Orders</a>
  </li>
  <li class="{{isActiveRoute('orders.processed')}}">
    <a href="{{route('orders.processed')}}">Processed Orders</a>
  </li>
</ul>

<div class="tab-content">
  <div id="ordersTable" class="tab-pane fade in active">

    <table id="myTable" class="table table-hover">
      <thead>
        <th>Date Ordered</th>
        <th>Date Processed</th>
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
            <td>{{$order->updated_at}}</td>
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
                <a href="{{ route('processed.items', ['order' => $order->id]) }}"
                  title="view items" class="btn btn-default">
                  <i class="glyphicon glyphicon-eye-open"></i>
                </a>
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
                title: "Processed Orders",
                messageTop: "The List Of Processed Orders As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Processed Orders",
                 messageTop: "The List Of Processed Orders As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Processed Orders",
                 messageTop: "The List Of Processed Orders As Of {{date('d-m-Y')}}"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });
    });
  </script>
@endsection
