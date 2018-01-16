@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Customers: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div id="customersTable" class="table-responsive">
      <table id="myTable" class="table table-hover">
          <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Phone-number</th>
          </thead>
          <tbody>
            @foreach($customers as $customer)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone_number }}</td>
              </tr>
           @endforeach
         </tbody>
       </table>
     </div>
  </div>
</div>
    <script>
    $(document).ready(function () {
      table = $("#myTable").DataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'print',
                exportOptions: {
                  columns: ":not(:last-child)"
                },
                title: "Customers",
                messageTop: "The List Of Customers As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Customers",
                 messageTop: "The List Of Customers As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Customers",
                 messageTop: "The List Of Customers As Of {{date('d-m-Y')}}"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });

    });
    </script>
@endsection
