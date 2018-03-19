<p style="margin-top: 15px; color: #ff9740;">Advised Dimensions: 1300 X 468 or larger with Ratio (1 : 2.77778)</p>

<div class="panel panel-default">

  <div class="panel-body">
    <div class="bannerContainer">
      <div class="bannerDiv">
        <a href=
           "{{ asset('images/' . $mainBanners->first()->image_url ) }}"
           target="_blank">
            <img src="{{ asset('images/' . $mainBanners->first()->image_url ) }}"
                 alt="Main Banner" class="img-rounded" id="mainImage">
        </a>
        <div class="bannerSpinner">
          <i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"
            style="display: none;" id="main_spinner{{$mainBanners->first()->id}}"></i>
        </div>
      </div>
      <span style="font-weight: bold;">Change picture: </span><br/>
      <input type='file'
        onchange="previewMainBanner('{{$mainBanners->first()->id}}')"
        id="mainFile">
      <p class="text-danger" id="main_banner-error" style="display: none;"></p><br>

    </div>

    <div class="form-group" class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
      <p style="font-weight: bold; color: #000">Link:</p>
      <input type="text" name="link" value="{{old('link')}}"
        placeholder="link" class="form-control" id="mainLink"
        style="width: 430px !important; display:inline-block;" required>
      <i class="fa fa-spinner fa-spin fa-2x fa-fw text-primary" id="mainSpinner"
        style="display: none;"></i>
      <p class="text-danger" id="mainLinkError"></p>
    </div>

   <button type="button" name="button"
     onclick="updateBannerLink('mainLink', '{{'/admin/main_link/' . $mainBanners->first()->id}}', 'mainSpinner', 'mainLinkError')">
     Submit
   </button>

 </div>
</div>

<script>

  $(function() {
    $("#mainLink").val("{{$mainBanners->first()->link}}");
  });

  function previewMainBanner(id){
      $("#main_spinner" + id).fadeIn(0);
      var preview = document.querySelector('#mainImage');
      var original_main_banner = preview.src;
      preview.style.opacity = "0.3";
      var file = document.getElementById('mainFile').files[0];

      if (file) {
        var reader  = new FileReader();
        reader.onload = function () {
          preview.src = reader.result;
        }
        reader.readAsDataURL(file);
      }

      var formData =  new FormData();
      formData.append('image_url', file);
      var link = '/admin/main_banner/' + id;
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
          $("#main_spinner" + id).fadeOut(0);
          preview.style.opacity = "1";
        },
        error: function(error) {
          data = JSON.parse(error.responseText);
          displayMainBannerErrors(data.errors);
          $("#main_spinner" + id).fadeOut(0);
          preview.src = original_main_banner; //restore the previous image
          preview.style.opacity = "1";
        }
      });
 }

 function displayMainBannerErrors(errors)
{
  if(errors.image_url != null) {
    $("#main_banner-error").text(errors.image_url);
    $("#main_banner-error").fadeIn(0, function() {
      $("#main_banner-error").fadeOut(3000);
      $("#main_banner-error").text("");
    });
  }
}
</script>
