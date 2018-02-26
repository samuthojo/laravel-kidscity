<div class="panel panel-default">

  <div class="panel-body">
    @foreach($pictures as $picture)
      <div class="pictureContainer">
        <div class="pictureDiv">
          <a href=
             "{{ asset('images/real_cloths/' . $picture->image_url ) }}"
             target="_blank">
              <img src="{{ asset('images/real_cloths/' . $picture->image_url ) }}"
                   alt="Product Picture" class="img-rounded"
                   id="img{{$picture->id}}">
          </a>
          <div class="pictureSpinner">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"
              style="display: none;" id="spinner{{$picture->id}}"></i>
          </div>
        </div>
        <span style="font-weight: bold;">Change picture: </span><br/>
        <input type='file' id="picture{{$picture->id}}"
          onchange="previewPicture('{{$picture->id}}')">
      </div>
    @endforeach
  </div>

</div>

<script>
  function previewPicture(picture_id){
      $("#spinner" + picture_id).fadeIn(0);
      var preview = document.querySelector('#img' + picture_id);
      preview.style.opacity = "0.3";
      var file = document.getElementById('picture'+picture_id).files[0];

      if (file) {
        var reader  = new FileReader();
        reader.onload = function () {
          preview.src = reader.result;
        }
        reader.readAsDataURL(file);
      }

      var formData =  new FormData();
      formData.append('image_url', file);
      var link = '/admin/products/picture/' + picture_id;
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
          $("#spinner" + picture_id).fadeOut(0);
          preview.style.opacity = "1";
        },
        error: function(error) {
          console.log(error);
          $("#spinner" + picture_id).fadeOut(0);
          preview.style.opacity = "1";
        }
      });
 }
</script>
