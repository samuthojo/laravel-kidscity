<div id="edit_age_range_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit AgeRange</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="edit_age_range_form" id="edit_age_range_form">
              <div class="form-group">
                <label for="edit_age_range">Range:</label>
                <input type="text" class="form-control"
                  placeholder="age range"
                  name="range" id="edit_age_range">
                <span id="edit_age_range_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="attemptEditAgeRange()">Save</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
