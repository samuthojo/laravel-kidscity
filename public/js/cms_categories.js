var category_id = "";

$(document).ready(function () {
  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });
});

function addCategory() {
  $.ajax({
         type: "post",
         url: "/admin/categories",
         data: $("#add_category_form").serialize(), // serializes the form's elements.
         success: function(table) {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           closeModal("add_category_modal");
           $("#categoriesTable").html(table);
           $("#success-alert").text("Category created successfully");
           $("#success-alert").fadeIn(0, function() {
             $("#success-alert").fadeOut(1500);
           });
         },
         error: function(error) {
           console.log(error);
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           data = JSON.parse(error.responseText);
           showAddCategoryErrors(data.errors);
         }
       });
       $(".btn-success").prop("disabled", true);
       $(".my_loader").fadeIn(0);
}

function showAddCategoryErrors(errors) {
  if(errors.name != null) {
    $("#category_name_error").text(errors.name);
    $("#category_name_error").fadeIn(0);
  }
}

function showEditCategoryModal(cat) {
  showModal("edit_category_modal");
  $("#edit_category_name").val(cat.name);
  category_id = cat.id;
}

function attemptEditCategory() {
  $.ajax({
    type: "post",
    url: "/admin/categories/" + category_id,
    data: $("#edit_category_form").serialize(),
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("edit_category_modal");
      $("#categoriesTable").html(table);
      $("#success-alert").text("Category updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      console.log(error);
      data = JSON.parse(error.responseText);
      showEditCategoryErrors(data.errors);
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}

function showEditCategoryErrors(errors) {
  if(errors.name != null) {
    $("#edit_category_name_error").text(errors.name);
    $("#edit_category_name_error").fadeIn(0);
  }
}

function showDeleteConfirmationModal(cat) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete " + cat.name + " and its products");
  category_id = cat.id;
}

function deleteCategory() {
  $.ajax({
    type: 'delete',
    url: '/admin/categories/' + category_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#categoriesTable").html(table);
      $("#success-alert").text("Category deleted successfully");
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
