<table id="myTable" class="table table-hover">
  <thead>
    <th></th>
    <th style="display: none;"></th>
    <th>No.</th>
    <th>Name</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($brands as $brand)
    <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
      <td class="details-control" title="view more"></td>
      <td style="display: none;">{{$brand->id}}</td>
      <td>{{$loop->iteration}}</td>
      <td>{{$brand->name}}</td>
      <td>
        <div class="btn-group" title="edit brand">
          <a class="btn btn-default" title="view products"
           href="{{route('brands.products', ['brand' => $brand->id])}}">
            <span class="glyphicon glyphicon-eye-open"></span>
          </a>
          <button class="btn btn-warning"
            onclick="showEditBrandModal({{$brand}})">
            <span class="glyphicon glyphicon-pencil"></span>
          </button>
          <button class="btn btn-danger" title="delete brand"
            onclick="showDeleteConfirmationModal({{$brand}})">
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
    table = $("#myTable").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
              extend: 'print',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Brands",
              messageTop: "The List Of Brands As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Brands",
               messageTop: "The List Of Brands As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Brands",
               messageTop: "The List Of Brands As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });

    $(":text").keydown(function() {
      $(this).next().fadeOut(0);
    });
    $(":file").keydown(function() {
      $(this).next().fadeOut(0);
    });

    // Add event listener for opening and closing details
    $('#myTable tbody').on('click', 'td.details-control', function () {
      var tr = $(this).closest('tr');
      var row = table.row( tr );

      var brand_id = row.data()[1];

      if ( row.child.isShown() ) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
      }
      else {
        var link = "/admin/brands/" + brand_id + "/brand";
             $.getJSON(link)
              .done( function (brand) {
                row.child.hide();
                tr.removeClass('shown');
                row.child(format(brand)).show();
                tr.addClass('shown');
              })
              .fail( function (error) {
                console.log(error);
              });
              row.child(format2()).show();
              tr.addClass('shown');
      }
    });

  });
</script>
