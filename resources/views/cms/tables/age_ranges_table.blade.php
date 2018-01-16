<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>Range (yrs)</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($ageRanges as $ageRange)
    <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
      <td>{{$loop->iteration}}</td>
      <td>{{$ageRange->range}}</td>
      <td>
        <div class="btn-group">
          <a class="btn btn-default" title="view products"
           href="{{ route('age_ranges.products', ['ageRange' => $ageRange->id]) }}">
            <span class="glyphicon glyphicon-eye-open"></span>
          </a>
          <button class="btn btn-warning" title="edit age-range"
            onclick="showEditAgeRangeModal({{$ageRange}})">
            <span class="glyphicon glyphicon-pencil"></span>
          </button>
          <button class="btn btn-danger" title="delete age-range"
            onclick="showDeleteConfirmationModal({{$ageRange}})">
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
          title: "Age Ranges",
          messageTop: "The List Of Age Ranges As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'excel',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Age Ranges",
           messageTop: "The List Of Age Ranges As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'pdf',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Age Ranges",
           messageTop: "The List Of Age Ranges As Of {{date('d-m-Y')}}"
        }
    ],
    iDisplayLength: 8,
    bLengthChange: false
});
});
</script>
