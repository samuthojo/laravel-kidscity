<table id="myTable" class="table table-hover">
  <thead>
    <th></th>
    <th style="display: none;"></th>
    <th>No.</th>
    <th>Name</th>
    <th>Category</th>
    <th>SubCategory</th>
    <th>PriceCategory</th>
    <th>AgeRange</th>
    <th>Brand</th>
    <th>Gender</th>
    <th>Price</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($products as $product)
      <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
        <td class="details-control" title="view more"></td>
        <td style="display: none;">{{$product->id}}</td>
        <td>{{$loop->iteration}}</td>
        <td>{{$product->name}}</td>
        <td>
          {{$product->categories->first()->name}}
        </td>
        <td>
          @if($product->subCategories->first())
            {{$product->subCategories->first()->name}}
          @else
            null
          @endif
        </td>
        <td>
          {{$product->priceCategories->first()->range}}
        </td>
        <td>
          {{$product->ages->first()->range}}
        </td>
        <td>
          {{$product->brands->first()->name}}
        </td>
        <td>
          @php
           $gender = '';
           if ($product->gender == 0) {
             $gender = 'Male';
           }
           else if ($product->gender == 1) {
             $gender =  'Female';
           }
           else if ($product->gender == 2) {
             $gender =  'Unisex';
           }
           else {
             $gender =  'null';
           }
          @endphp
          {{$gender}}
        </td>
        <td>
          {{ number_format($product->price) }}
        </td>
        <td>
          <div class="btn-group">
            <a class="btn btn-warning" title="edit product"
              href="{{route('products.edit', ['product' => $product->id])}}">
              <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <button class="btn btn-danger" title="delete product"
              onclick="showProductDeleteModal({{$product}})">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<script>
    $(document).ready( function() {
    callMe();
    });

    function callMe() {
    table = $("#myTable").DataTable({
    dom: 'Bfrtip',
    buttons: [
       {
         extend: 'print',
         exportOptions: {
           columns: ":not(:last-child)"
         },
         title: "Products",
         messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
       },
        {
          extend: 'excel',
          exportOptions: {
            columns: ":not(:last-child)"
          },
          title: "Products",
          messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
       },
        {
          extend: 'pdf',
          exportOptions: {
            columns: ":not(:last-child)"
          },
          title: "Products",
          messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
       }
    ],
    iDisplayLength: 8,
    bLengthChange: false
    });

    $("#category_id").click(function() {
    $(this).next().fadeOut(0);
    });

    $("#edit_category_id").click(function() {
    $(this).next().fadeOut(0);
    });

    $(":text").keydown(function() {
    $(this).next().fadeOut(0);
    });

    // Add event listener for opening and closing details
    $('#myTable tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    var product_id = row.data()[1];

    if ( row.child.isShown() ) {
       // This row is already open - close it
       row.child.hide();
       tr.removeClass('shown');
    }
    else {
     var link = "/admin/products/" + product_id + "/product";
          $.getJSON(link)
           .done( function (product) {
             row.child.hide();
             tr.removeClass('shown');
             row.child(format(product)).show();
             tr.addClass('shown');
           })
           .fail( function (error) {
             console.log(error);
           });
           row.child(format2()).show();
           tr.addClass('shown');
    }
    });
    }
</script>
