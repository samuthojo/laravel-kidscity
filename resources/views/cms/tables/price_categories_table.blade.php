<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>Price Category</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($priceCategories as $priceCategory)
    <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
      <td>{{$loop->iteration}}</td>
      <td>{{$priceCategory->range}}</td>
      <td>
        <div class="btn-group" title="edit price-category">
          <a class="btn btn-default" title="view products"
           href="{{route('price_categories.products', ['priceCategory' => $priceCategory->id])}}">
            <span class="glyphicon glyphicon-eye-open"></span>
          </a>
          <button class="btn btn-warning"
            onclick="showEditPriceCategoryModal({{$priceCategory}})">
            <span class="glyphicon glyphicon-pencil"></span>
          </button>
          <button class="btn btn-danger" title="delete price-category"
            onclick="showDeleteConfirmationModal({{$priceCategory}})">
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
          title: "Price Categories",
          messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'excel',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Price Categories",
           messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'pdf',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Price Categories",
           messageTop: "The List Of Price Categories As Of {{date('d-m-Y')}}"
        }
    ],
    iDisplayLength: 8,
    bLengthChange: false
});
});
</script>
