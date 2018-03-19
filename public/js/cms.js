$(function () {
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    statusCode: {
        401: function() {
          window.location.href = "/admin/login";
      },
        419: function() {
          window.location.href = "/admin/login";
      }
    }
  });

  $("body").on('shown.bs.modal', '.modal', function (e) {
    if(document.getElementById("category_id") != null) {
      $("#sub_category_id").prop("disabled", true);
    }
    if(document.getElementById("edit_category_id") != null) {
      $("#edit_sub_category_id").prop("disabled", true);
    }
  });

  $("body").on('hidden.bs.modal', '.modal', function (e) {

    $(".modal-body").find('input, textarea, select').each(function(){
       $(this).val("");
    });

    $(".modal-body").find('span').each(function(){
       $(this).fadeOut(0);
    });

    $(".modal-body").find(".radio").each(function(){
      $(this).prop('checked', false);
    });

    if(document.getElementById("category_id") != null) {
      $("#sub_category_id").prop("disabled", true);
    }

    if(document.getElementById("edit_category_id") != null) {
      $("#edit_sub_category_id").prop("disabled", true);
    }

    if(document.getElementById("edit_sub_category_id") != null) {
      restoreSubCategories();
    }

  });

  var categoryObject = document.getElementById("category_id");

  var editCategoryObject = document.getElementById("edit_category_id");

  if(categoryObject != null) {
    categoryObject.onchange = function() {
      $("#sub_category_id").prop("disabled", false);
      fetchSubCategories()
    };
  }

  if(editCategoryObject != null) {
    editCategoryObject.onchange = function() {
      $("#edit_sub_category_id").prop("disabled", false);
      fetchEditSubCategories()
    };
  }

});

$(document).ready(function () {
  $(".alert-success").fadeOut(1500);
});

function showModal(id) {
  $('#' + id).modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function closeModal(id) {
  $("#" + id).modal('hide');
  $('body').removeClass("modal-open");
  $('body').removeAttr('style');
  $(".modal-backdrop").remove();
}

function showHideAlert(id) {
  $("#" + id).fadeTo(2000, 500).slideUp(500, function(){
    $("#" + id).slideUp(500);
  });
}

function fetchSubCategories() {
  $(".select_loader").fadeIn(0);
  var category_id = $("#category_id").val();
  if(category_id != "") {
    var link = '/admin/categories/' + category_id + '/sub_categories';
    $.getJSON(link)
     .done(function (data) {
       $(".select_loader").fadeOut(0);
       setUpSubCategories(data);
     })
     .fail(function (error) {
       $(".select_loader").fadeOut(0);
       console.log(error);
     });
  }
  else {
    $(".select_loader").fadeOut(0);
    //Leave the first option, delete the rest
    $("#sub_category_id").find('option').not(':first').remove();
  }
}

function setUpSubCategories(data) {
    var mySelect = document.getElementById("sub_category_id");

    //Leave the first option, delete the rest
    $("#sub_category_id").find('option').not(':first').remove();

    for(i = 0; i < data.length; i++) {
       var opt = document.createElement("option");
       opt.value= data[i].id;
       opt.innerHTML = data[i].name;

       // then append it to the select element
       mySelect.appendChild(opt);
    }
}

function fetchEditSubCategories() {
  $(".select_loader").fadeIn(0);
  var category_id = $("#edit_category_id").val();
  if(category_id != "") {
    var link = '/admin/categories/' + category_id + '/sub_categories';
    $.getJSON(link)
     .done(function (data) {
       $(".select_loader").fadeOut(0);
       setUpEditSubCategories(data);
     })
     .fail(function (error) {
       $(".select_loader").fadeOut(0);
       console.log(error);
     });
  }
  else {
    $(".select_loader").fadeOut(0);
    //Leave the first option, delete the rest
    $("#edit_sub_category_id").find('option').not(':first').remove();
    $("#edit_sub_category_id").val("");//select the first option
  }
}

function setUpEditSubCategories(data) {
    var mySelect = document.getElementById("edit_sub_category_id");

    //Leave the first option, delete the rest
    $("#edit_sub_category_id").find('option').not(':first').remove();
    $("#edit_sub_category_id").val("");//select the first option

    for(i = 0; i < data.length; i++) {
       var opt = document.createElement("option");
       opt.value= data[i].id;
       opt.innerHTML = data[i].name;

       // then append it to the select element
       mySelect.appendChild(opt);
    }
}

function restoreSubCategories() {
  $(".select_loader").fadeIn(0);
  var link = '/admin/categories/-1/sub_categories';
  $.getJSON(link)
   .done(function (data) {
     $(".select_loader").fadeOut(0);
     resetSubCategories(data);
   })
   .fail(function (error) {
     $(".select_loader").fadeOut(0);
     console.log(error);
   });
}

function resetSubCategories(data) {
    var mySelect = document.getElementById("edit_sub_category_id");

    //Leave the first option, delete the rest
    $("#edit_sub_category_id").find('option').not(':first').remove();
    $("#edit_sub_category_id").val("");//select the first option

    for(i = 0; i < data.length; i++) {
       var opt = document.createElement("option");
       opt.value= data[i].id;
       opt.innerHTML = data[i].name;

       // then append it to the select element
       mySelect.appendChild(opt);
    }
}

function updateBannerLink(linkTextFieldId, endPoint, spinnerId, errorId)
{
  $("#" + spinnerId).fadeIn(0);
  var formData =  new FormData();
  var link = $("#" + linkTextFieldId).val();
  formData.append('link', link);
  $.ajax({
    type: 'post',
    url:  endPoint,
    data: formData,
    contentType: false,
    processData: false,
    success: function (t) {
      console.log(t);
      $("#" + spinnerId).fadeOut(0);
      $("#success-alert").text("Link Saved Successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      data = JSON.parse(error.responseText);
      displayLinkErrors(data.errors, errorId);
      $("#" + spinnerId).fadeOut(0);
    }
  });
}

function displayLinkErrors(errors, errorId)
{
 if(errors.link != null) {
   $("#" + errorId).text(errors.link);
   $("#" + errorId).fadeIn(0, function() {
     $("#" + errorId).fadeOut(3000);
     $("#" + errorId).text("");
   });
 }
}
