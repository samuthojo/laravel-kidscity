<div id="edit_sub_category_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit SubCategory</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="edit_sub_category_form" id="edit_sub_category_form">
              <div class="form-group">
                <label for="edit_category_id">Category:</label>
                <input type="text" name="category_id" id="edit_category_id"
                  class="form-control" readonly>
                <span id="edit_category_id_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <label for="edit_sub_category_name">Name:</label>
                <input type="text" class="form-control"
                  placeholder="sub-category name"
                  name="name" id="edit_sub_category_name">
                <span id="edit_sub_category_name_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="attemptEditSubCategory()">Save</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
