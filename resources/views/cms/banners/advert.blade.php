<p style="margin-top: 15px; color: #ff9740;">Advised Dimensions: 982 X 20</p>

<div class="panel panel-default">

  <div class="panel-body">
    <div>
        <a href=
           "{{ asset('images/wide-ad.png') }}"
           target="_blank" class="img-rounded">
            <img src="{{ asset('images/wide-ad.png') }}"
                 alt="advert">
        </a><br/>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' name='slideshow' onchange="previewFile('{{}}')">
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
      link = 'admin/advert/' + id;

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
