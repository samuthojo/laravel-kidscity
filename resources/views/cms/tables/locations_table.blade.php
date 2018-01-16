<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>Name</th>
    <th>DeliveryPrice</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($locations as $location)
    <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
      <td>{{$loop->iteration}}</td>
      <td>{{$location->location}}</td>
      <td>{{number_format($location->delivery_price)}}</td>
      <td>
        <div class="btn-group">
          <button class="btn btn-warning"
            onclick="showEditLocationModal({{$location}})"
              title="edit location">
            <span class="glyphicon glyphicon-pencil"></span>
          </button>
          <button class="btn btn-danger" title="delete location"
            onclick="showDeleteConfirmationModal({{$location}})">
            <span class="glyphicon glyphicon-trash"></span>
          </button>
        </div>
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
          title: "Delivery Locations",
          messageTop: "The List Of Delivery Locations As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'excel',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Delivery Locations",
           messageTop: "The List Of Delivery Locations As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'pdf',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Delivery Locations",
           messageTop: "The List Of Delivery Locations As Of {{date('d-m-Y')}}"
        }
    ],
    iDisplayLength: 8,
    bLengthChange: false
});
});
</script>
