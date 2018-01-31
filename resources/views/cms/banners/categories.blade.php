<p style="margin-top: 15px; color: #ff9740;">Advised Dimensions: 250 X 250</p>

<div class="panel panel-default">

  <div class="panel-body">
    <div style="display: inline-block;" class="featured">
        <a href=
           "{{ asset('images/featured-boys.jpg') }}"
           target="_blank" class="img-rounded">
            <img src="{{ asset('images/featured-boys.jpg') }}"
                 alt="Best Seller" style="width: 200px;">
        </a><br/>
        <h3>FOR BOYS</h3>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' name='slideshow' onchange="">
    </div>
    <div style="display: inline-block;" class="featured">
        <a href=
           "{{ asset('images/featured-girls.jpg') }}"
           target="_blank" class="img-rounded">
            <img src="{{ asset('images/featured-girls.jpg') }}"
                 alt="Toys" style="width: 200px;">
        </a><br/>
        <h3>FOR GIRLS</h3>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' name='slideshow' onchange="">
    </div>
    <div style="display: inline-block;" class="featured">
        <a href=
           "{{ asset('images/featured_baby.jpg') }}"
           target="_blank" class="img-rounded">
            <img src="{{ asset('images/featured_baby.jpg') }}"
                 alt="Kids Fun" style="width: 310px; height: 200px;">
        </a><br/>
        <h3>FOR BABIES</h3>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' name='slideshow' onchange="">
    </div>
  </div>

</div>
<script>
  function previewFile(id){
      var preview = document.querySelector('#img' + id); //selects the query named img
      var file    = document.querySelector('#file' + id).files[0]; //sames as here
      var reader  = new FileReader();

      var formData =  new FormData();
      formData.append('image_url', file);
      link = 'cms/slideshows/updateSlide/' + id;

      reader.onloadend = function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
            type: 'post',
            dataType: 'html',
            url:  link,
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result){
              $(".ipf-preloader").fadeOut(1000);
              preview.src = reader.result;
            }
          });
      }

      if (file) {
          reader.readAsDataURL(file); //reads the data as a URL
      } else {
          preview.src = "";
      }
 }
</script>
