var product_size_id = "";

$(document).ready(function () {
  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });
});

function addProductSize() {
  $.ajax({
         type: "post",
         url: "/admin/sizes",
         data: $("#add_product_size_form").serialize(), // serializes the form's elements.
         success: function(table) {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           closeModal("add_product_size_modal");
           $("#productSizesTable").html(table);
           $("#success-alert").text("Product-Size created successfully");
           $("#success-alert").fadeIn(0, function() {
             $("#success-alert").fadeOut(1500);
           });
         },
         error: function(error) {
           console.log(error);
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           data = JSON.parse(error.responseText);
           showAddProductSizeErrors(data.errors);
         }
       });
       $(".btn-success").prop("disabled", true);
       $(".my_loader").fadeIn(0);
}

function showAddProductSizeErrors(errors) {
  if(errors.size != null) {
    $("#product_size_error").text(errors.size);
    $("#product_size_error").fadeIn(0);
  }
}

function showEditProductSizeModal(productSize) {
  showModal("edit_product_size_modal");
  $("#edit_product_size").val(productSize.size);
  product_size_id = productSize.id;
}

function attemptEditProductSize() {
  $.ajax({
    type: "patch",
    url: "/admin/sizes/" + product_size_id,
    data: $("#edit_product_size_form").serialize(),
    success: function(table) {
      $(".btn-success").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      closeModal("edit_product_size_modal");
      $("#productSizesTable").html(table);
      $("#success-alert").text("Product-Size updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      $(".btn-success").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      console.log(error);
      data = JSON.parse(error.responseText);
      showEditProductSizeErrors(data.errors);
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}

function showEditProductSizeErrors(errors) {
  if(errors.size != null) {
    $("#edit_product_size_error").text(errors.size);
    $("#edit_product_size_error").fadeIn(0);
  }
}

function showDeleteConfirmationModal(productSize) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete " + productSize.size + " product-size");
  product_size_id = productSize.id;
}

function deleteProductSize() {
  $.ajax({
    type: 'delete',
    url: '/admin/sizes/' + product_size_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#productSizesTable").html(table);
      $("#success-alert").text("Product-Size deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      console.log(error);
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}
