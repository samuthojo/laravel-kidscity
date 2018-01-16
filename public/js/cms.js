$(function () {
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    statusCode: {
        401: function() {
          window.location.href = "/login";
      },
        419: function() {
          window.location.href = "/login";
      }
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
    restoreSubCategories();
  });

  document.getElementById("category_id").onchange = function() {
    fetchSubCategories()
  };
  document.getElementById("edit_category_id").onchange = function() {
    fetchEditSubCategories()
  };

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
  $(".my_loader").fadeIn(0);
  var category_id = $("#category_id").val();
  if(category_id != "") {
    var link = '/admin/categories/' + category_id + '/sub_categories';
    $.getJSON(link)
     .done(function (data) {
       $(".my_loader").fadeOut(0);
       setUpSubCategories(data);
     })
     .fail(function (error) {
       $(".my_loader").fadeOut(0);
       console.log(error);
     });
  }
  else {
    $(".my_loader").fadeOut(0);
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
  $(".my_loader").fadeIn(0);
  var category_id = $("#edit_category_id").val();
  if(category_id != "") {
    var link = '/admin/categories/' + category_id + '/sub_categories';
    $.getJSON(link)
     .done(function (data) {
       $(".my_loader").fadeOut(0);
       setUpEditSubCategories(data);
     })
     .fail(function (error) {
       $(".my_loader").fadeOut(0);
       console.log(error);
     });
  }
  else {
    $(".my_loader").fadeOut(0);
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
  $(".my_loader").fadeIn(0);
  var link = '/admin/categories/-1/sub_categories';
  $.getJSON(link)
   .done(function (data) {
     $(".my_loader").fadeOut(0);
     resetSubCategories(data);
   })
   .fail(function (error) {
     $(".my_loader").fadeOut(0);
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
