var brand_id = "";

$(document).ready(function () {
  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });
});

function addBrand() {
  var form = document.getElementById('add_brand_form');
  var formData = new FormData(form);
  $.ajax({
         type: "post",
         url: "/brands",
         contentType: false,
         processData: false,
         data: formData,
         success: function() {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           window.location.href = "/brands";
         },
         error: function(error) {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           data = JSON.parse(error.responseText);
           showAddBrandErrors(data.errors);
         }
       });
       $(".btn-success").prop("disabled", true);
       $(".my_loader").fadeIn(0);
}

function showAddBrandErrors(errors) {
  if(errors.name != null) {
    $("#brand_name_error").text(errors.name);
    $("#brand_name_error").fadeIn(0);
  }
  if(errors.image_url != null) {
    $("#brand_image_error").text(errors.image_url);
    $("#brand_image_error").fadeIn(0);
  }
}

function showEditBrandModal(brand) {
  showModal("edit_brand_modal");
  $("#edit_brand_name").val(brand.name);
  $("#edit_brand_description").val(brand.description);
  brand_id = brand.id;
}

function attemptEditBrand() {
  var form = document.getElementById("edit_brand_form");
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: "/brands/" + brand_id,
    contentType: false,
    processData: false,
    data: formData,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("edit_product_modal");
      $("#brandsTable").html(table);
      $("#success-alert").text("Brand updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1000);
      });
    },
    error: function(error) {
      data = JSON.parse(error.responseText);
      showEditBrandErrors(data.errors);
    }
  });
}

function showEditBrandErrors(errors) {
  if(errors.name != null) {
    $("#edit_brand_name_error").text(errors.name);
    $("#edit_brand_name_error").fadeIn(0);
  }
  if(errors.image_url != null) {
    $("#edit_brand_image_error").text(errors.image_url);
    $("#edit_brand_image_error").fadeIn(0);
  }
}

function showDeleteConfirmationModal(id) {
  showModal("delete_confirmation_modal");
  brand_id = id;
}

function deleteBrand() {
  $.ajax({
    type: 'delete',
    url: '/brands/' + brand_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#brandsTable").html(table);
      $("#success-alert").text("Category deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}
