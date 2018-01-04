<div id="add_category_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Add Category</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="add_category_form" id="add_category_form">
              <div class="form-group">
                <label for="category_name">Name:</label>
                <input type="text" class="form-control"
                  placeholder="category name"
                  name="name" id="category_name">
                <span id="category_name_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="addCategory()">Add</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
