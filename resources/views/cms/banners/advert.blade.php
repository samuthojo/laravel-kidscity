<p style="margin-top: 15px; color: #ff9740;">Advised Dimensions: 600 X 80 or Higher with ratio: 1 : 7.5</p>

<div class="panel panel-default">

  <div class="panel-body">
    <div class="bannerContainer">
      <div class="bannerDiv">
        <a href=
           "{{ asset('images/' . $adverts->first()->image_url ) }}"
           target="_blank">
            <img src="{{ asset('images/' . $adverts->first()->image_url ) }}"
                 alt="advert" id="advertImage" class="img-rounded">
        </a>
        <div class="bannerSpinner">
          <i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"
            style="display: none;" id="spinner{{$adverts->first()->id}}"></i>
        </div>
      </div>
      <span style="font-weight: bold;">Change picture: </span><br/>
      <input type='file'
        onchange="previewFile('{{$adverts->first()->id}}')"
        id="advertFile">
      <p class="text-danger" id="advert-error" style="display: none;"></p><br>

  </div> <!--end of bannerContainer-->

  <div class="form-group" class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
    <p style="font-weight: bold; color: #000">Link:</p>
    <input type="text" name="link" value="{{old('link')}}"
      placeholder="link" class="form-control" id="advertLink"
      style="width: 430px !important; display:inline-block;" required>
    <i class="fa fa-spinner fa-spin fa-2x fa-fw text-primary" id="advertSpinner"
      style="display: none;"></i>
    <p class="text-danger" id="advertLinkError"></p>
  </div>

 <button type="button" name="button"
   onclick="updateBannerLink('advertLink', '{{'/admin/advert_link/' . $adverts->first()->id}}', 'advertSpinner', 'advertLinkError')">
   Submit
 </button>

  </div>
</div>

<script>

  $(function() {
    $("#advertLink").val("{{$adverts->first()->link}}");
  });

  function previewFile(id){
      $("#spinner" + id).fadeIn(0);
      var preview = document.querySelector('#advertImage');

      var original_advert = preview.src;

      preview.style.opacity = "0.3";

      var file = document.getElementById('advertFile').files[0];

      if (file) {
        var reader  = new FileReader();
        reader.onload = function () {
          preview.src = reader.result;
        }
        reader.readAsDataURL(file);
      }

      var formData =  new FormData();
      formData.append('image_url', file);
      var link = '/admin/advert/' + id;
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
          $("#spinner" + id).fadeOut(0);
          preview.style.opacity = "1";
        },
        error: function(error) {
          data = JSON.parse(error.responseText);
          displayAdvertErrors(data.errors);
          $("#spinner" + id).fadeOut(0);
          preview.src = original_advert; //restore the previous image
          preview.style.opacity = "1";
        }
      });
 }

 function displayAdvertErrors(errors)
{
  if(errors.image_url != null) {
    $("#advert-error").text(errors.image_url);
    $("#advert-error").fadeIn(0, function() {
      $("#advert-error").fadeOut(3000);
      $("#advert-error").text("");
    });
  }
}
</script>
