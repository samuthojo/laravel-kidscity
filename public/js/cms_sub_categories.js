var sub_category_id = "";

$(document).ready(function () {
  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });

  $("#category_id").click(function() {
   $(this).next().fadeOut(0);
  });

  $("#edit_category_id").click(function() {
   $(this).next().fadeOut(0);
  });
});

function addSubCategory() {
  $.ajax({
         type: "post",
         url: "/admin/sub_categories",
         data: $("#add_sub_category_form").serialize(), // serializes the form's elements.
         success: function(table) {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           closeModal("add_sub_category_modal");
           $("#subCategoriesTable").html(table);
           $("#success-alert").text("Sub-Category created successfully");
           $("#success-alert").fadeIn(0, function() {
             $("#success-alert").fadeOut(1500);
           });
         },
         error: function(error) {
           console.log(error);
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           data = JSON.parse(error.responseText);
           showAddSubCategoryErrors(data.errors);
         }
       });
       $(".btn-success").prop("disabled", true);
       $(".my_loader").fadeIn(0);
}

function showAddSubCategoryErrors(errors) {
  if(errors.category_id != null) {
    $("#category_id_error").text(errors.category_id);
    $("#category_id_error").fadeIn(0);
  }
  if(errors.name != null) {
    $("#sub_category_name_error").text(errors.name);
    $("#sub_category_name_error").fadeIn(0);
  }
}

function showEditSubCategoryModal(subCat) {
  showModal("edit_sub_category_modal");
  $("#edit_category_id").val(subCat.category);
  $("#edit_sub_category_name").val(subCat.name);
  sub_category_id = subCat.id;
}

function attemptEditSubCategory() {
  $.ajax({
    type: "post",
    url: "/admin/sub_categories/" + sub_category_id,
    data: $("#edit_sub_category_form").serialize(),
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("edit_sub_category_modal");
      $("#subCategoriesTable").html(table);
      $("#success-alert").text("Sub-Category updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      console.log(error);
      data = JSON.parse(error.responseText);
      showEditSubCategoryErrors(data.errors);
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}

function showEditSubCategoryErrors(errors) {
  if(errors.category_id != null) {
    $("#edit_category_id_error").text(errors.category_id);
    $("#edit_category_id_error").fadeIn(0);
  }
  if(errors.name != null) {
    $("#edit_sub_category_name_error").text(errors.name);
    $("#edit_sub_category_name_error").fadeIn(0);
  }
}

function showDeleteConfirmationModal(subCat) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete " + subCat.name + " and its products");
  sub_category_id = subCat.id;
}

function deleteSubCategory() {
  $.ajax({
    type: 'delete',
    url: '/admin/sub_categories/' + sub_category_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#subCategoriesTable").html(table);
      $("#success-alert").text("Sub-Category deleted successfully");
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
