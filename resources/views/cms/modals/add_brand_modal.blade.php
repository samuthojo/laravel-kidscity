<div id="add_brand_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Add Brand</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="add_brand_form" id="add_brand_form">
              <div class="form-group">
                <label for="brand_name">Name:</label>
                <input type="text" class="form-control"
                  placeholder="brand name"
                  name="name" id="brand_name">
                <span id="brand_name_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <label for="brand_image">Picture:</label>
                <input type="file" name="image_url" id="brand_image">
                <span id="brand_image_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="addBrand()">Add</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
