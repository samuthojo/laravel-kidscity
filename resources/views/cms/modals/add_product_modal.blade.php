<div id="add_product_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="add_product_form"
            id="add_product_form">
            <div class="form-group">
              <label for="category_id">Category:</label>
              <select class="form-control" name="category_id"
                id="category_id" style="width: 180px">
                <option value="" selected disabled>choose category</option>
                @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
              <span id="category_id_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="product_name">Name:</label>
              <input type="text" class="form-control" name="name"
                id="product_name" placeholder="product name">
              <span id="product_name_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="product_code">Code:</label>
              <input type="text" class="form-control" name="code"
                id="product_code" placeholder="product code">
              <span id="product_code_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="product_cc">CC:</label>
              <input type="text" class="form-control" name="cc"
                id="product_cc" placeholder="product cc">
              <span id="product_cc_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="product_description">Description:</label>
              <textarea name="description" id="product_description"
                class="form-control" placeholder="product description"
                rows="3" style="width: 180px"></textarea>
            </div>
            <div class="form-group">
              <label for="product_image">Picture:</label>
              <input type="file" name="image" id="product_image">
              <span id="product_image_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success"
                type="button" onclick="addProduct()">Add</button>
              @include('cms.inline_loader')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
