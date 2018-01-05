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
    <div class="table-responsive">
      <table id="myTable" class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Phone-number</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $customer)
                    <tr>
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
