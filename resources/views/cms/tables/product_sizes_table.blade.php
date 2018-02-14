<table id="myTable" class="table table-hover">
  <thead>
    <th>No.</th>
    <th>Size</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($productSizes as $productSize)
    <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
      <td>{{$loop->iteration}}</td>
      <td>{{$productSize->size}}</td>
      <td>
        <div class="btn-group">
          <button class="btn btn-warning" title="edit product-size"
            onclick="showEditProductSizeModal({{$productSize}})">
            <span class="glyphicon glyphicon-pencil"></span>
          </button>
          <button class="btn btn-danger" title="delete product-size"
            onclick="showDeleteConfirmationModal({{$productSize}})">
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
              title: "Product Sizes",
              messageTop: "The List Of Product Sizes As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Product Sizes",
               messageTop: "The List Of Product Sizes As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Product Sizes",
               messageTop: "The List Of Product Sizes As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>
