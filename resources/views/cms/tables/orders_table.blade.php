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
          <a href="{{ route('orders.items', ['order' => $order->id]) }}"
            title="view items">
            <button type="button" name="button"
              class="btn btn-warning">
              <i class="glyphicon glyphicon-eye-open"></i>
            </button>
          </a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
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
