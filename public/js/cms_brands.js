var table = null;

var brand_id = "";

function format(brand) {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>Picture:</th>'+
            '<td>'+
              "<img class='img-rounded' alt='product picture' " +
                  "src=" + "/images/brands/" + brand.image_url + " height='30%' width='auto'>" +
            '</td>'+
        '</tr>'+
        '<tr>'+
            '<th>Description:</th>'+
            '<td>'+ brand.description +'</td>'+
        '</tr>'+
    '</table>';
}

function format2() {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
      '<tr>'+
          '<td>'+ '<span> Fetching...' +
            '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"></i>' +
          '</span>' +'</td>'+
      '</tr>'+
  '</table>';
}


function addBrand() {
  var form = document.getElementById("add_brand_form");
  var formData = new FormData(form);
  console.log(formData);
  $.ajax({
         type: "post",
         url: "/admin/brands",
         contentType: false,
         processData: false,
         data: formData,
         success: function() {
           $(".btn-success").prop("disabled", false);
           $(".my_loader").fadeOut(0);
           window.location.href = "/admin/brands";
         },
         error: function(error) {
           console.log(error);
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
    url: "/admin/brands/" + brand_id,
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
      console.log(error);
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

function showDeleteConfirmationModal(brand) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete " + brand.name);
  brand_id = brand.id;
}

function deleteBrand() {
  $.ajax({
    type: 'delete',
    url: '/admin/brands/' + brand_id,
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
