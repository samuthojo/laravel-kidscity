var location_id = "";

$(document).ready(function () {
  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });
});

function addLocation() {
  $.ajax({
         type: "post",
         url: "/admin/locations",
         data: $("#add_location_form").serialize(), // serializes the form's elements.
         success: function() {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           window.location.href = '/admin/locations';
         },
         error: function(error) {
           console.log(error);
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           data = JSON.parse(error.responseText);
           showAddLocationErrors(data.errors);
         }
       });
       $(".btn-success").prop("disabled", true);
       $(".my_loader").fadeIn(0);
}

function showAddLocationErrors(errors) {
  if(errors.location != null) {
    $("#location_error").text(errors.location);
    $("#location_error").fadeIn(0);
  }
  if(errors.delivery_price != null) {
    $("#delivery_price_error").text(errors.delivery_price);
    $("#delivery_price_error").fadeIn(0);
  }
}

function showEditLocationModal(location) {
  showModal("edit_location_modal");
  $("#edit_location").val(location.location);
  $("#edit_delivery_price").val(location.delivery_price);
  location_id = location.id;
}

function attemptEditLocation() {
  $.ajax({
    type: "post",
    url: "/admin/locations/" + location_id,
    data: $("#edit_location_form").serialize(),
    success: function(table) {
      closeModal("edit_location_modal");
      $("#locationsTable").html(table);
      $("#success-alert").text("Location updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1000);
      });
    },
    error: function(error) {
      console.log(error);
      data = JSON.parse(error.responseText);
      showEditLocationErrors(data.errors);
    }
  });
}

function showEditLocationErrors(errors) {
  if(errors.location != null) {
    $("#edit_location_error").text(errors.location);
    $("#edit_location_error").fadeIn(0);
  }
  if(errors.delivery_price != null) {
    $("#edit_delivery_price_error").text(errors.delivery_price);
    $("#edit_delivery_price_error").fadeIn(0);
  }
}

function showDeleteConfirmationModal(location) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete " + location.location + " location");
  location_id = location.id;
}

function deleteLocation() {
  $.ajax({
    type: 'delete',
    url: '/admin/locations/' + location_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#locationsTable").html(table);
      $("#success-alert").text("Location deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}
