var table = null;

var product_id = "";

function format(product) {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>Picture:</th>'+
            '<td>'+
              "<img class='img-rounded' alt='product picture' " +
                  "src=" + product.image + " height='30%' width='auto'>" +
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

function addProduct() {
  var form = document.getElementById("add_product_form");
  var formData = new FormData(form);
  $.ajax({
         type: "post",
         url: "/products",
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
  if(errors.category_id != null) {
    $("#category_id_error").text(errors.category_id);
    $("#category_id_error").fadeIn(0);
  }
  if(errors.name != null) {
    $("#product_name_error").text(errors.name);
    $("#product_name_error").fadeIn(0);
  }
  if(errors.code != null) {
    $("#product_code_error").text(errors.code);
    $("#product_code_error").fadeIn(0);
  }
  if(errors.cc != null) {
    $("#product_cc_error").text(errors.cc);
    $("#product_cc_error").fadeIn(0);
  }
  if(errors.image != null) {
    $("#product_image_error").text(errors.image);
    $("#product_image_error").fadeIn(0);
  }
}

function showEditProductErrors(errors) {
  if(errors.category_id != null) {
    $("#edit_category_id_error").text(errors.category_id);
    $("#edit_category_id_error").fadeIn(0);
  }
  if(errors.name != null) {
    $("#edit_product_name_error").text(errors.name);
    $("#edit_product_name_error").fadeIn(0);
  }
  if(errors.code != null) {
    $("#edit_product_code_error").text(errors.code);
    $("#edit_product_code_error").fadeIn(0);
  }
  if(errors.cc != null) {
    $("#edit_product_cc_error").text(errors.cc);
    $("#edit_product_cc_error").fadeIn(0);
  }
  if(errors.image != null) {
    $("#edit_product_image_error").text(errors.image);
    $("#edit_product_image_error").fadeIn(0);
  }
}

function showEditProductModal(product) {
  showModal("edit_product_modal");

  $("#edit_category_id").val(product.category_id);

  $("#edit_product_name").val(product.name);

  $("#edit_product_code").val(product.code);

  $("#edit_product_cc").val(product.cc);

  $("#edit_product_description").val(product.description);

  product_id = product.id;
}

function attemptEditProduct() {
  var form = document.getElementById('edit_product_form');
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: "/products/" + product_id,
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
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      data = JSON.parse(error.responseText);
      showEditProductErrors(data.errors);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}

function applyTheUpdates(product) {
  $("#product_name_" + product.id).text(product.name);
  $("#category_name_" + product.id).text(product.category_name);
  $("#product_code_" + product.id).text(product.code);
  $("#product_cc_" + product.id).text(product.cc);
}

function showProductDeleteModal(prod_id) {
  showModal("delete_confirmation_modal");
  product_id = prod_id;
}

function deleteProduct() {
  $.ajax({
    type: 'delete',
    url: '/products/' + product_id,
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
