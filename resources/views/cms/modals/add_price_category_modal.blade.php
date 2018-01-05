<div id="add_price_category_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Add PriceCategory</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="add_price_category_form" id="add_price_category_form">
              <div class="form-group">
                <label for="price_category_range">Range:</label>
                <input type="text" class="form-control"
                  placeholder="price range"
                  name="range" id="price_category_range">
                <span id="price_category_range_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="addPriceCategory()">Add</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
