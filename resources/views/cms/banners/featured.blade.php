<p style="margin-top: 15px; color: #ff9740;">Advised Dimensions: 400 X 250</p>

<div class="panel panel-default">

  <div class="panel-body">
    <div style="display: inline-block;" class="featured">
        <a href=
           "{{ asset('images/pram.jpg') }}"
           target="_blank" class="img-rounded">
            <img src="{{ asset('images/pram.jpg') }}"
                 alt="Best Seller">
        </a><br/>
        <h3>BEST SELLER</h3>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' name='slideshow' onchange="">
    </div>
    <div style="display: inline-block;" class="featured">
        <a href=
           "{{ asset('images/pram2.jpg') }}"
           target="_blank" class="img-rounded">
            <img src="{{ asset('images/pram2.jpg') }}"
                 alt="Toys">
        </a><br/>
        <h3>ACCESSORIES</h3>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' name='slideshow' onchange="">
    </div>
    <div style="display: inline-block;" class="featured">
        <a href=
           "{{ asset('images/toy2.jpg') }}"
           target="_blank" class="img-rounded">
            <img src="{{ asset('images/toy2.jpg') }}"
                 alt="Kids Fun">
        </a><br/>
        <h3>KIDS FUN</h3>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' name='slideshow' onchange="">
    </div>
  </div>

</div>
<script>
  function previewFile(id){
      var preview = document.querySelector('.img' + id); //selects the query named img
      var file    = document.querySelector('#file' + id).files[0]; //sames as here
      var reader  = new FileReader();

      var formData =  new FormData();
      formData.append('slideshow', file);
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
