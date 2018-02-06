<p style="margin-top: 15px; color: #ff9740;">Advised Dimensions: 982 X 480</p>

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
            style="display: none;"></i>
        </div>
      </div>
      <span style="font-weight: bold;">Change picture: </span><br/>
      <input type='file'
        onchange="previewMainBanner('{{$mainBanners->first()->id}}')"
        id="mainFile">
    </div>
 </div>
</div>

<script>
  function previewMainBanner(id){
      $(".fa-spinner").fadeIn(0);
      var preview = document.querySelector('#mainImage');
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
          $(".fa-spinner").fadeOut(0);
          preview.style.opacity = "1";
        },
        error: function(error) {
          console.log(error);
          $(".fa-spinner").fadeOut(0);
          preview.style.opacity = "1";
        }
      });
 }
</script>
