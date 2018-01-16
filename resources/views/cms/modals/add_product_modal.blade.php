<div id="add_product_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog">
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

              <div class="row">

                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="brand_id">Brand:</label>
                    <select class="form-control" name="brand_id"
                      id="brand_id" style="width: 180px">
                      <option value="" selected disabled>choose brand</option>
                      @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                      @endforeach
                    </select>
                    <span id="brand_id_error"
                      class="text-danger" style="display: none;"></span>
                  </div>
                </div>

                <div class="col-sm-4">
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
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="sub_category_id">SubCategory:</label>
                    <select class="form-control" name="sub_category_id"
                      id="sub_category_id" style="width: 180px">
                      <option value="" selected disabled>choose sub-category</option>
                      {{--@foreach($subCategories as $subCategory)
                        <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                      @endforeach--}}
                    </select>
                    @include('cms.inline_loader')
                    <span id="sub_category_id_error"
                      class="text-danger" style="display: none;"></span>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="price_category_id">PriceCategory:</label>
                    <select class="form-control" name="price_category_id"
                      id="price_category_id" style="width: 180px">
                      <option value="" selected disabled>choose price-category</option>
                      @foreach($priceCategories as $priceCategory)
                        <option value="{{$priceCategory->id}}">{{$priceCategory->range}}</option>
                      @endforeach
                    </select>
                    <span id="price_category_id_error"
                      class="text-danger" style="display: none;"></span>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="product_age_range_id">AgeRange:</label>
                    <select class="form-control" name="product_age_range_id"
                      id="product_age_range_id" style="width: 180px">
                      <option value="" selected disabled>choose age-range</option>
                      @foreach($ageRanges as $ageRange)
                        <option value="{{$ageRange->id}}">{{$ageRange->range}}</option>
                      @endforeach
                    </select>
                    <span id="product_age_range_id_error"
                      class="text-danger" style="display: none;"></span>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="product_name">Name:</label>
                    <input type="text" class="form-control" name="name"
                      id="product_name" placeholder="product name">
                    <span id="product_name_error"
                      class="text-danger" style="display: none;"></span>
                  </div>
                </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="product_price">Price:</label>
                  <input type="text" class="form-control" name="price"
                    id="product_price" placeholder="product price">
                  <span id="product_price_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="gender">Gender:</label>
                  <select class="form-control" name="gender"
                    id="gender" style="width: 180px">
                    <option value="" selected disabled>choose gender</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                  </select>
                  <span id="gender_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="product_description">Description:</label>
                  <textarea name="description" id="product_description"
                    class="form-control" placeholder="product description"
                    rows="3" style="width: 180px"></textarea>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="product_image">Picture:</label>
                  <input type="file" name="image_url" id="product_image">
                  <span id="product_image_error"
                    class="text-danger" style="display: none;"></span>
                </div>
              </div>

            </div> <!--closes the row-->

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
