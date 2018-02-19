<div id="edit_brand_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit Brand</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="edit_brand_form" id="edit_brand_form">
              <div class="form-group">
                <label for="edit_brand_name">Name:</label>
                <input type="text" class="form-control"
                  placeholder="brand name"
                  name="name" id="edit_brand_name">
                <span id="edit_brand_name_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <label for="edit_brand_description">Description:</label>
                <textarea name="description" class="form-control"
                 rows="8" cols="80" placeholder="Description (optional)"
                 id="edit_brand_description"></textarea>
              </div>
              <div class="form-group">
                <label for="edit_brand_image">Replace Picture:</label>
                <input type="file" name="image_url" id="edit_brand_image">
                <span id="edit_brand_image_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="attemptEditBrand()">Save</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
