var age_range_id = "";

$(document).ready(function () {
  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });
});

function addAgeRange() {
  $.ajax({
         type: "post",
         url: "/admin/age_ranges",
         data: $("#add_age_range_form").serialize(), // serializes the form's elements.
         success: function() {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           window.location.href = '/admin/age_ranges';
         },
         error: function(error) {
           console.log(error);
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           data = JSON.parse(error.responseText);
           showAddAgeRangeErrors(data.errors);
         }
       });
       $(".btn-success").prop("disabled", true);
       $(".my_loader").fadeIn(0);
}

function showAddAgeRangeErrors(errors) {
  if(errors.range != null) {
    $("#age_range_error").text(errors.range);
    $("#age_range_error").fadeIn(0);
  }
}

function showEditAgeRangeModal(ageRange) {
  showModal("edit_age_range_modal");
  $("#edit_age_range").val(ageRange.range);
  age_range_id = ageRange.id;
}

function attemptEditAgeRange() {
  $.ajax({
    type: "post",
    url: "/admin/age_ranges/" + age_range_id,
    data: $("#edit_age_range_form").serialize(),
    success: function(table) {
      closeModal("edit_age_range_modal");
      $("#ageRangesTable").html(table);
      $("#success-alert").text("AgeRange updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1000);
      });
    },
    error: function(error) {
      console.log(error);
      data = JSON.parse(error.responseText);
      showEditAgeRangeErrors(data.errors);
    }
  });
}

function showEditAgeRangeErrors(errors) {
  if(errors.range != null) {
    $("#edit_age_range_error").text(errors.range);
    $("#edit_age_range_error").fadeIn(0);
  }
}

function showDeleteConfirmationModal(ageRange) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete " + ageRange.range + " age-range");
  age_range_id = ageRange.id;
}

function deleteAgeRange() {
  $.ajax({
    type: 'delete',
    url: '/admin/age_ranges/' + age_range_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#ageRangesTable").html(table);
      $("#success-alert").text("AgeRange deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}
