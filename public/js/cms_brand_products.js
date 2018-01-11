var table = null;

var product_id = "";

var brand_id = "";

function format(product) {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>Picture:</th>'+
            '<td>'+
              "<img class='img-rounded' alt='product picture' " +
                  "src=" + "/images/products/" + product.image_url + " height='30%' width='auto'>" +
            '</td>'+
        '</tr>'+
        '<tr>'+
            '<th>Description:</th>'+
            '<td>'+ product.description +'</td>'+
        '</tr>'+
    '</table>';
}

function format2() {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
      '<tr>'+
          '<td>'+ '<span> Fetching...' +
            '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-success"></i>' +
          '</span>' +'</td>'+
      '</tr>'+
  '</table>';
}

function showAddModal(id) {
  $('#add_product_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });

  brand_id = id;
}

function addProduct() {
  var form = document.getElementById("add_product_form");
  var formData = new FormData(form);
  $.ajax({
         type: "post",
         url: "/admin/brands/" + brand_id + "/store_product",
         data: formData,
         contentType: false,
         processData: false,
         success: function(table) {
           $(".my_loader").fadeOut(0);
           $(".btn-success").prop("disabled", false);
           closeModal("add_product_modal");
           $("#productsTable").html(table);
           $("#success-alert").text("Product added successfully");
           $("#success-alert").fadeIn(0, function() {
             $("#success-alert").fadeOut(1500);
           });
         },
         error: function(error) {
           $(".my_loader").fadeOut(0);
           $(".btn-success").prop("disabled", false);
           data = JSON.parse(error.responseText);
           showAddProductErrors(data.errors);
         }
       });
       $(".my_loader").fadeIn(0);
       $(".btn-success").prop("disabled", true);
}

function showAddProductErrors(errors) {
  if(errors.brand_id != null) {
    $("#brand_id_error").text(errors.brand_id);
    $("#brand_id_error").fadeIn(0);
  }
  if(errors.category_id != null) {
    $("#category_id_error").text(errors.category_id);
    $("#category_id_error").fadeIn(0);
  }
  if(errors.sub_category_id != null) {
    $("#sub_category_id_error").text(errors.sub_category_id);
    $("#sub_category_id_error").fadeIn(0);
  }
  if(errors.price_category_id != null) {
    $("#price_category_id_error").text(errors.price_category_id);
    $("#price_category_id_error").fadeIn(0);
  }
  if(errors.product_age_range_id != null) {
    $("#product_age_range_id_error").text(errors.product_age_range_id);
    $("#product_age_range_id_error").fadeIn(0);
  }
  if(errors.name != null) {
    $("#product_name_error").text(errors.name);
    $("#product_name_error").fadeIn(0);
  }
  if(errors.price != null) {
    $("#product_price_error").text(errors.price);
    $("#product_price_error").fadeIn(0);
  }
  if(errors.gender != null) {
    $("#gender_error").text(errors.gender);
    $("#gender_error").fadeIn(0);
  }
  if(errors.image_url != null) {
    $("#product_image_error").text(errors.image_url);
    $("#product_image_error").fadeIn(0);
  }
}

function showEditProductErrors(errors) {
  if(errors.brand_id != null) {
    $("#edit_brand_id_error").text(errors.brand_id);
    $("#edit_brand_id_error").fadeIn(0);
  }
  if(errors.category_id != null) {
    $("#edit_category_id_error").text(errors.category_id);
    $("#edit_category_id_error").fadeIn(0);
  }
  if(errors.sub_category_id != null) {
    $("#edit_sub_category_id_error").text(errors.sub_category_id);
    $("#edit_sub_category_id_error").fadeIn(0);
  }
  if(errors.price_category_id != null) {
    $("#edit_price_category_id_error").text(errors.price_category_id);
    $("#edit_price_category_id_error").fadeIn(0);
  }
  if(errors.product_age_range_id != null) {
    $("#edit_product_age_range_id_error").text(errors.product_age_range_id);
    $("#edit_product_age_range_id_error").fadeIn(0);
  }
  if(errors.name != null) {
    $("#edit_product_name_error").text(errors.name);
    $("#edit_product_name_error").fadeIn(0);
  }
  if(errors.price != null) {
    $("#edit_product_price_error").text(errors.price);
    $("#edit_product_price_error").fadeIn(0);
  }
  if(errors.gender != null) {
    $("#edit_gender_error").text(errors.gender);
    $("#edit_gender_error").fadeIn(0);
  }
  if(errors.image_url != null) {
    $("#edit_product_image_error").text(errors.image_url);
    $("#edit_product_image_error").fadeIn(0);
  }
}

function showEditProductModal(product, brand) {
  showModal("edit_product_modal");

  $("#edit_brand_id").val(product.brand_id);

  $("#edit_category_id").val(product.category_id);

  $("#edit_sub_category_id").val(product.sub_category_id);

  $("#edit_price_category_id").val(product.price_category_id);

  $("#edit_product_age_range_id").val(product.product_age_range_id);

  $("#edit_product_name").val(product.name);

  $("#edit_product_price").val(product.price);

  $("#edit_gender").val(product.gender);

  $("#edit_product_description").val(product.description);

  product_id = product.id;

  brand_id = brand.id;
}

function attemptEditProduct() {
  var form = document.getElementById('edit_product_form');
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: "/admin/brands/" + brand_id + "/update_product/" + product_id,
    data: formData,
    contentType: false,
    processData: false,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("edit_product_modal");
      $("#productsTable").html(table);
      $("#success-alert").text("Product updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      data = JSON.parse(error.responseText);
      showEditProductErrors(data.errors);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}

function showProductDeleteModal(prod) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete " + prod.name);
  product_id = prod.id;
}

function deleteProduct() {
  $.ajax({
    type: 'delete',
    url: '/admin/brands/' + product_id + "/delete_product",
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#productsTable").html(table);
      $("#success-alert").text("Product deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}
