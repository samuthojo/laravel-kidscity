var price_category_id = "";

$(document).ready(function () {
  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });
});

function addPriceCategory() {
  $.ajax({
         type: "post",
         url: "/admin/price_categories",
         data: $("#add_price_category_form").serialize(), // serializes the form's elements.
         success: function(table) {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           closeModal("add_price_category_modal");
           $("#priceCategoriesTable").html(table);
           $("#success-alert").text("PriceCategory created successfully");
           $("#success-alert").fadeIn(0, function() {
             $("#success-alert").fadeOut(1500);
           });
         },
         error: function(error) {
           console.log(error);
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           data = JSON.parse(error.responseText);
           showAddPriceCategoryErrors(data.errors);
         }
       });
       $(".btn-success").prop("disabled", true);
       $(".my_loader").fadeIn(0);
}

function showAddPriceCategoryErrors(errors) {
  if(errors.range != null) {
    $("#price_category_range_error").text(errors.range);
    $("#price_category_range_error").fadeIn(0);
  }
}

function showEditPriceCategoryModal(priceCat) {
  showModal("edit_price_category_modal");
  $("#edit_price_category_range").val(priceCat.range);
  price_category_id = priceCat.id;
}

function attemptEditPriceCategory() {
  $.ajax({
    type: "post",
    url: "/admin/price_categories/" + price_category_id,
    data: $("#edit_price_category_form").serialize(),
    success: function(table) {
      $(".btn-success").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      closeModal("edit_price_category_modal");
      $("#priceCategoriesTable").html(table);
      $("#success-alert").text("PriceCategory updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      $(".btn-success").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      console.log(error);
      data = JSON.parse(error.responseText);
      showEditCategoryErrors(data.errors);
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}

function showEditPriceCategoryErrors(errors) {
  if(errors.range != null) {
    $("#edit_price_category_range_error").text(errors.range);
    $("#edit_price_category_range_error").fadeIn(0);
  }
}

function showDeleteConfirmationModal(priceCat) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete " + priceCat.range + " price-category");
  price_category_id = priceCat.id;
}

function deletePriceCategory() {
  $.ajax({
    type: 'delete',
    url: '/admin/price_categories/' + price_category_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#priceCategoriesTable").html(table);
      $("#success-alert").text("PriceCategory deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}
