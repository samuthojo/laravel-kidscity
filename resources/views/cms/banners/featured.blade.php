<p style="margin-top: 15px; color: #ff9740;">Advised Dimensions: 400 X 250</p>

<div class="panel panel-default">

  <div class="panel-body">
    @foreach($featuredBanners as $banner)
      <div class="bannerContainer">
        <div class="bannerDiv">
          <a href=
             "{{ asset('images/' . $banner->image_url ) }}"
             target="_blank">
              <img src="{{ asset('images/' . $banner->image_url ) }}"
                   alt="{{$banner->name}}" class="img-rounded"
                   id="img{{$banner->id}}">
          </a>
          <div class="bannerSpinner">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"
              style="display: none;" id="featured_spinner{{$banner->id}}"></i>
          </div>
        </div>
        <h3>{{$banner->name}}</h3>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' id="featured{{$banner->id}}"
          onchange="previewFeaturedBanner('{{$banner->id}}')">
        <p class="text-danger" id="featured-error{{$banner->id}}" style="display: none;"></p><br>

        <div class="form-group" class="form-group" style="text-align: center;">
          <p style="font-weight: bold; color: #000; text-align: left;">Link:</p>
          <input type="text" name="link" value="{{old('link')}}"
            placeholder="link" class="form-control" id="featuredLink{{$banner->id}}"
            style="width: 430px !important; display:inline-block;" required>
          <i class="fa fa-spinner fa-spin fa-2x fa-fw text-primary" id="featuredSpinner{{$banner->id}}"
            style="display: none;"></i>
          <p class="text-danger" id="featuredLinkError{{$banner->id}}"></p>
        </div>

       <button type="button" name="button"
         onclick="updateBannerLink('featuredLink{{$banner->id}}', '{{'/admin/featured_link/' . $banner->id}}', 'featuredSpinner{{$banner->id}}', 'featuredLinkError{{$banner->id}}')">
         Submit
       </button>
      </div>

      <script>
        $("#featuredLink{{$banner->id}}").val('{{$banner->link}}');
      </script>
    @endforeach
  </div>

</div>

<script>
  function previewFeaturedBanner(id){
      $("#featured_spinner" + id).fadeIn(0);
      var preview = document.querySelector('#img' + id);
      var original_featured = preview.src;
      preview.style.opacity = "0.3";
      var file = document.getElementById('featured'+id).files[0];

      if (file) {
        var reader  = new FileReader();
        reader.onload = function () {
          preview.src = reader.result;
        }
        reader.readAsDataURL(file);
      }

      var formData =  new FormData();
      formData.append('image_url', file);
      var link = '/admin/featured_banner/' + id;
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
          $("#featured_spinner" + id).fadeOut(0);
          preview.style.opacity = "1";
        },
        error: function(error) {
          data = JSON.parse(error.responseText);
          displayFeaturedErrors(data.errors, id);
          $("#featured_spinner" + id).fadeOut(0);
          preview.src = original_featured; //restore the previous image
          preview.style.opacity = "1";
        }
      });
 }

 function displayFeaturedErrors(errors, id)
{
  if(errors.image_url != null) {
    $("#featured-error" + id).text(errors.image_url);
    $("#featured-error" + id).fadeIn(0, function() {
      $("#featured-error" + id).fadeOut(3000);
      $("#featured-error" + id).text("");
    });
  }
}
</script>
