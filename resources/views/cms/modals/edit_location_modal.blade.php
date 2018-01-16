<div id="edit_location_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit Location</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="edit_location_form" id="edit_location_form">
              <div class="form-group">
                <label for="edit_location">Location:</label>
                <input type="text" class="form-control"
                  placeholder="location name"
                  name="location" id="edit_location">
                <span id="edit_location_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <label for="edit_delivery_price">Delivery Price:</label>
                <input type="text" class="form-control"
                  placeholder="delivery price"
                  name="delivery_price" id="edit_delivery_price">
                <span id="edit_delivery_price_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="attemptEditLocation()">Save</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
