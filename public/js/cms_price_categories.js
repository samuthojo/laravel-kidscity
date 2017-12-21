var category_id = "";

$(document).ready(function () {
  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });
});

function addCategory() {
  $.ajax({
         type: "post",
         url: "/categories",
         data: $("#add_category_form").serialize(), // serializes the form's elements.
         success: function() {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           window.location.href = '/categories';
         },
         error: function(error) {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           data = JSON.parse(error.responseText);
           $("#category_name_error").text(data.errors.name);
           $("#category_name_error").fadeIn(0);
         }
       });
       $(".btn-success").prop("disabled", true);
       $(".my_loader").fadeIn(0);
}

function showEditCategoryModal(cat_id) {
  showModal("edit_category_modal");
  var txt = $("#category_" + cat_id).text();
  $("#edit_category_name").val(txt);
  category_id = cat_id;
}

function attemptEditCategory() {
  $.ajax({
    type: "post",
    url: "/categories/" + category_id,
    data: $("#edit_category_form").serialize(),
    success: function(cat) {
      closeModal("edit_category_modal");
      $("#category_" + category_id).text(cat.name);
      $("#success-alert").text("Category updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1000);
      });
    },
    error: function(error) {
      data = JSON.parse(error.responseText);
      $("#edit_category_name_error").text(data.errors.name);
      $("#edit_category_name_error").fadeIn(0);
    }
  });
}

function showDeleteConfirmationModal(cat_id) {
  showModal("delete_confirmation_modal");
  category_id = cat_id;
}

function deleteCategory() {
  $.ajax({
    type: 'delete',
    url: '/categories/' + category_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#categoriesTable").html(table);
      $("#success-alert").text("Category deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}
