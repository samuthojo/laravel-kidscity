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
  });

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
