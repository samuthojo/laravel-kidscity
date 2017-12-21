<div id="edit_category_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit Category</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="edit_category_form"
              id="edit_category_form">
              <div class="form-group">
                <label for="edit_category_name">Name:</label>
                <input type="text" class="form-control"
                  placeholder="category name"
                  name="name" id="edit_category_name">
                <span id="edit_category_name_error"
                  style="display: none;"
                  class="text-danger"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button class="btn btn-success"
                  type="button"
                  onclick="attemptEditCategory()">
                  Save
                </button>
                @include('inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
