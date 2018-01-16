<div id="add_sub_category_modal" class="modal fade"
     role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Add SubCategory</h4>
      </div>
        <div class="modal-body">
          <div class="container">
            <form name="add_sub_category_form" id="add_sub_category_form">
              <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control"
                  name="category_id" id="category_id" style="width: 180px">
                  <option value="" selected disabled>choose category</option>
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
                <span id="category_id_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <label for="sub_category_name">Name:</label>
                <input type="text" class="form-control"
                  placeholder="sub-category name"
                  name="name" id="sub_category_name">
                <span id="sub_category_name_error" class="text-danger"
                 style="display: none;"></span>
              </div>
              <div class="form-group">
                <button class="btn btn-default"
                  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success"
                  onclick="addSubCategory()">Add</button>
                @include('cms.inline_loader')
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
