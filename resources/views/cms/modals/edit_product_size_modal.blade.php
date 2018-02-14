<div id="edit_product_size_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit ProductSize</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="edit_product_size_form" id="edit_product_size_form">
              <div class="form-group">
                <label for="edit_product_size">Size:</label>
                <input type="text" class="form-control"
                  placeholder="product size"
                  name="size" id="edit_product_size">
                <span id="edit_product_size_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="attemptEditProductSize()">Save</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
