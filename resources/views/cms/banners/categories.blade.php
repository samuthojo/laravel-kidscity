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
            style="display: none;"></i>
        </div>
      </div>
      <h3>{{$banner->name}}</h3>
      <span style="font-weight: bold;">Change picture: </span><br/>
      <input type='file' id="category{{$banner->id}}"
        onchange="previewCategoryBanner('{{$banner->id}}')">
    </div>
    @endforeach
  </div>

</div>

<script>
  function previewCategoryBanner(id){
      $(".fa-spinner").fadeIn(0);
      var preview = document.querySelector('#catImg' + id);
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
