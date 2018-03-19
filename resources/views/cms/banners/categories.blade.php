<p style="margin-top: 15px; color: #ff9740;">Advised Dimensions: 250 X 250</p>

<div class="panel panel-default">

  <div class="panel-body">
    @foreach($categoryBanners as $banner)
    <div class="bannerContainer">
      <div class="bannerDiv">
        <a href=
           "{{ asset('images/' . $banner->image_url ) }}"
           target="_blank">
            <img src="{{ asset('images/' . $banner->image_url ) }}"
                 alt="{{$banner->name}}" class="img-rounded"
                 id="catImg{{$banner->id}}">
        </a>
        <div class="bannerSpinner">
          <i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"
            style="display: none;" id="category_spinner{{$banner->id}}"></i>
        </div>
      </div>
      <h3>{{$banner->name}}</h3>
      <span style="font-weight: bold;">Change picture: </span><br/>
      <input type='file' id="category{{$banner->id}}"
        onchange="previewCategoryBanner('{{$banner->id}}')">
      <p class="text-danger" id="category-error{{$banner->id}}" style="display: none;"></p><br>

      <div class="form-group" class="form-group" style="text-align: center;">
        <p style="font-weight: bold; color: #000; text-align: left;">Link:</p>
        <input type="text" name="link" value="{{old('link')}}"
          placeholder="link" class="form-control" id="categoryLink{{$banner->id}}"
          style="width: 430px !important; display:inline-block;" required>
        <i class="fa fa-spinner fa-spin fa-2x fa-fw text-primary" id="categorySpinner{{$banner->id}}"
          style="display: none;"></i>
        <p class="text-danger" id="categoryLinkError{{$banner->id}}"></p>
      </div>

     <button type="button" name="button"
       onclick="updateBannerLink('categoryLink{{$banner->id}}', '{{'/admin/category_link/' . $banner->id}}', 'categorySpinner{{$banner->id}}', 'categoryLinkError{{$banner->id}}')">
       Submit
     </button>
    </div>

    <script>
      $("#categoryLink{{$banner->id}}").val('{{$banner->link}}');
    </script>
    @endforeach
  </div>

</div>

<script>
  function previewCategoryBanner(id){
      $("#category_spinner" + id).fadeIn(0);
      var preview = document.querySelector('#catImg' + id);
      var original_category = preview.src; //Original category image
      preview.style.opacity = "0.3";
      var file = document.getElementById('category'+id).files[0];

      if (file) {
        var reader  = new FileReader();
        reader.onload = function () {
          preview.src = reader.result;
        }
        reader.readAsDataURL(file);
      }

      var formData =  new FormData();
      formData.append('image_url', file);
      var link = '/admin/category_banner/' + id;
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        type: 'post',
        url:  link,
        data: formData,
        contentType: false,
        processData: false,
        success: function (){
          $("#category_spinner" + id).fadeOut(0);
          preview.style.opacity = "1";
        },
        error: function(error) {
          data = JSON.parse(error.responseText);
          displayCategoryErrors(data.errors, id);
          $("#category_spinner" + id).fadeOut(0);
          preview.src = original_category; //restore the previous image
          preview.style.opacity = "1";
        }
      });
 }

 function displayCategoryErrors(errors, id)
{
  if(errors.image_url != null) {
    $("#category-error" + id).text(errors.image_url);
    $("#category-error" + id).fadeIn(0, function() {
      $("#category-error" + id).fadeOut(3000);
      $("#category-error" + id).text("");
    });
  }
}
</script>
