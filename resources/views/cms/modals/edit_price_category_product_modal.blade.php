<div id="edit_product_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="edit_product_form"
            id="edit_product_form">

            <div class="row">

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_brand_id">Brand:</label>
                  <select class="form-control" name="brand_id"
                    id="edit_brand_id" style="width: 180px">
                    <option value="" selected disabled>choose brand</option>
                    @foreach($brands as $brand)
                      <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                  </select>
                  <span id="edit_brand_id_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_category_id">Category:</label>
                  <select class="form-control" name="category_id"
                    id="edit_category_id" style="width: 180px">
                    <option value="" selected disabled>choose category</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                  <span id="edit_category_id_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_sub_category_id">SubCategory:</label>
                  <select class="form-control" name="sub_category_id"
                    id="edit_sub_category_id" style="width: 180px">
                    <option value="" selected disabled>choose sub-category</option>
                    @foreach($subCategories as $subCategory)
                      <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                    @endforeach
                  </select>
                  @include('cms.select_loader')
                  <span id="edit_sub_category_id_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_product_age_range_id">AgeRange:</label>
                  <select class="form-control" name="product_age_range_id"
                    id="edit_product_age_range_id" style="width: 180px">
                    <option value="" selected disabled>choose age-range</option>
                    @foreach($ageRanges as $ageRange)
                      <option value="{{$ageRange->id}}">{{$ageRange->range}}</option>
                    @endforeach
                  </select>
                  <span id="edit_product_age_range_id_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_product_name">Name:</label>
                  <input type="text" class="form-control" name="name"
                    id="edit_product_name" placeholder="product name">
                  <span id="edit_product_name_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_product_price">Price:</label>
                  <input type="text" class="form-control" name="price"
                    id="edit_product_price" placeholder="product price">
                  <span id="edit_product_price_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_gender">Gender:</label>
                  <select class="form-control" name="gender"
                    id="edit_gender" style="width: 180px">
                    <option value="" selected disabled>choose gender</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                  </select>
                  <span id="edit_gender_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_product_description">Description:</label>
                  <textarea name="description" id="edit_product_description"
                    class="form-control" placeholder="product description"
                    rows="3" style="width: 180px"></textarea>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="edit_product_image">Replace Picture:</label>
                  <input type="file" name="image_url" id="edit_product_image">
                  <span id="edit_product_image_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

            </div><!--closes the row-->

            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success"
                type="button" onclick="attemptEditProduct()">Save</button>
              @include('cms.inline_loader')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
