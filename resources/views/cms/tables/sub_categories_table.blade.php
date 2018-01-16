<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>SubCategory</th>
    <th>Category</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($subCategories as $subCategory)
    <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
      <td>{{$loop->iteration}}</td>
      <td>{{$subCategory->name}}</td>
      <td>{{$subCategory->category}}</td>
      <td>
        <div class="btn-group">
          <a class="btn btn-default" title="view products"
           href="{{ route('sub_categories.products', ['subCategory' => $subCategory->id]) }}">
            <span class="glyphicon glyphicon-eye-open"></span>
          </a>
          <button class="btn btn-warning" title="Edit SubCategory"
            onclick="showEditSubCategoryModal({{$subCategory}})">
            <span class="glyphicon glyphicon-pencil"></span>
          </button>
          <button class="btn btn-danger" title="Delete SubCategory"
            onclick="showDeleteConfirmationModal({{$subCategory}})">
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
          title: "SubCategories",
          messageTop: "The List Of Product SubCategories As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'excel',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "SubCategories",
           messageTop: "The List Of Product SubCategories As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'pdf',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "SubCategories",
           messageTop: "The List Of Product SubCategories As Of {{date('d-m-Y')}}"
        }
    ],
    iDisplayLength: 8,
    bLengthChange: false
});
});
</script>
