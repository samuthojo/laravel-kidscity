var order_id = "";

function showOrderDeleteModal(order) {
  showModal("delete_confirmation_modal");
  $("#confirmation_text").text("Delete Order #" + order.id);
  order_id = order.id;
}

function deleteOrder() {
  $.ajax({
    type: 'delete',
    url: '/admin/orders/' + order_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#ordersTable").html(table);
      $("#success-alert").text("Order deleted successfully");
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
