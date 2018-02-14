<style media="screen">
  .form-control {
    width: 100% !important;
  }
  .fa-2x {
    font-size: 2.5em;
  }
  .bootstrap-tagsinput {
    width: 100%;
  }
</style>
<link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}">
{{-- tinymce (rich textarea) --}}
<script src="{{asset('js/tinymce/js/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script>
tinymce.init({
  selector: 'textarea',
  height: 250,
  theme: 'modern',
  menubar: 'edit insert view format table tools', //skip file
  plugins: [
    'advlist autolink lists link charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen placeholder',
    'insertdatetime table contextmenu paste code help wordcount'
  ],
toolbar: 'formatselect | bold italic forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});
</script>

<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
        {!!
            Form::label('code', 'Product Code:', [

                'class' => 'control-label',

            ])
        !!}

        {!!
            Form::text('code', null, [

                'class' => 'form-control',

                'aria-describedby'=> 'codeHelpBlock',

                'placeholder' => 'Product Code',

            ])
        !!}

        @if($errors->any() && $errors->has('code'))

            {!!

                $errors->first(
                    'code',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('barcode') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('barcode', 'Product Bar-Code:', [

              'class' => 'control-label',

          ])
      !!}

       {!!
            Form::text('barcode', null, [

                'class' => 'form-control',

                'aria-describedby'=> 'barCodeHelpBlock',

                'placeholder' => 'Product Bar-Code',

            ])
        !!}

        @if($errors->any() && $errors->has('barcode'))

            {!!

                $errors->first(
                    'barcode',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('name', 'Product Name:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::text('name', null, [

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'nameHelpBlock',

                'placeholder' => 'Product Name',

            ])
        !!}

        @if($errors->any() && $errors->has('name'))

            {!!

                $errors->first(
                    'name',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('description', 'Product Description:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::textarea(
                'description',

                null,

                [

                    'rows' => 2,

                    'class' => 'form-control tinymce',

                    'aria-describedby'=> 'descriptionHelpBlock',

                    'placeholder' => 'Product Description',

                ]
            )
        !!}

        @if($errors->any() && $errors->has('description'))

          {!!

              $errors->first(
                  'description',

                  '<p class="help-block">:description</p>'
              )

          !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('price', 'Product Price:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::text('price', null, [

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'priceHelpBlock',

                'placeholder' => 'Product Price',

            ])
        !!}

        @if($errors->any() && $errors->has('price'))

            {!!

                $errors->first(
                    'price',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('sale_price') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('sale_price', 'Product Sale-Price:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::text('sale_price', null, [

                'class' => 'form-control',

                'aria-describedby'=> 'salePriceHelpBlock',

                'placeholder' => 'Product Sale-Price',

            ])
        !!}

        @if($errors->any() && $errors->has('sale_price'))

            {!!

                $errors->first(
                    'sale_price',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}">

  <div class="col-md-offset-2 col-md-8">
    {!!
        Form::label('stock', 'Product Stock:', [

            'class' => 'control-label',

        ])
    !!}

    {!!
        Form::text('stock', null, [

            'class' => 'form-control',

            'aria-describedby'=> 'stockHelpBlock',

            'placeholder' => 'Product Stock',

        ])
    !!}

    @if($errors->any() && $errors->has('stock'))

        {!!

            $errors->first(
                'stock',

                '<p class="help-block">:message</p>'
            )

        !!}

    @endif

  </div>

</div>

<div class="form-group {{ $errors->has('category_id*') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('category_id', 'Product Categories:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::select('category_id[]', $categories, $selectedCategories, [

                'id' => 'categorySelector',

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'categoryHelpBlock',

                'onchange' => 'categoryTags()',

                'placeholder' => 'Choose Category',

                'multiple' => true,

            ])
        !!}

        @if($errors->any() && $errors->has('category_id*'))

            {!!

                $errors->first(
                    'category_id*',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('sub_category_id*') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8" style="display:inline-block;">
      {!!
          Form::label('sub_category_id', 'Product SubCategories:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::select('sub_category_id[]', $subCategories, $selectedSubCategories, [

                'id' => 'subCategorySelector',

                'class' => 'form-control',

                'aria-describedby'=> 'subCategoryHelpBlock',

                'placeholder' => 'Choose Sub-Category',

                'multiple' => true,

            ])
        !!}

        @if($errors->any() && $errors->has('sub_category_id*'))

            {!!

                $errors->first(
                    'sub_category_id*',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

    <div class="col-md-2"
      style="display:inline-block;">
      @include('cms.select_loader')
    </div>
</div>

<div class="form-group {{ $errors->has('brand_id*') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">

      {!!
          Form::label('brand_id', 'Product Brand:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::select('brand_id[]', $brands, $selectedBrands, [

                'id' => 'brandSelector',

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'brandHelpBlock',

                'multiple' => true,

                'placeholder' => 'Choose Brand',

            ])
        !!}

        @if($errors->any() && $errors->has('brand_id*'))

            {!!

                $errors->first(
                    'brand_id*',

                    '<p class="help-block">:message</p>'
                )

            !!}

       @endif

    </div>

</div>

<div class="form-group {{ $errors->has('price_category_id*') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">

      {!!
          Form::label('price_category_id', 'Product Price-Categories:', [

              'class' => 'control-label',

          ])
      !!}

         {!!
            Form::select('price_category_id[]', $priceCategories,

                $selectedPriceCategories, [

                'id' => 'priceCategorySelector',

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'priceCategoryHelpBlock',

                'placeholder' => 'Choose Price-Category',

                'multiple' => true,

            ])
        !!}

        @if($errors->any() && $errors->has('price_category_id*'))

            {!!

                $errors->first(
                    'price_category_id*',

                    '<p class="help-block">:message</p>'
                )

            !!}

       @endif

    </div>

</div>

<div class="form-group {{ $errors->has('product_age_range_id*') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('product_age_range_id', 'Product Age-Ranges:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::select('product_age_range_id[]', $ageRanges,

                $selectedAgeRanges, [

                'id' => 'ageRangeSelector',

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'ageRangeHelpBlock',

                'placeholder' => 'Choose Age-Range',

                'multiple' => true,

            ])
        !!}

        @if($errors->any() && $errors->has('product_age_range_id*'))

            {!!

                $errors->first(
                    'product_age_range_id*',

                    '<p class="help-block">:message</p>'
                )

            !!}

       @endif

    </div>

</div>

<div class="form-group {{ $errors->has('product_size_id*') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('product_size_id', 'Product Sizes:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::select('product_size_id[]', $productSizes,

                $selectedProductSizes, [

                'id' => 'sizeSelector',

                'class' => 'form-control',

                'aria-describedby'=> 'sizeHelpBlock',

                'placeholder' => 'Choose Product-Size',

                'multiple' => true,

            ])
        !!}

        @if($errors->any() && $errors->has('product_size_id*'))

            {!!

                $errors->first(
                    'product_size_id*',

                    '<p class="help-block">:message</p>'
                )

            !!}

       @endif

    </div>

</div>

<div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('gender', 'Product Gender:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::select('gender',
                [
                  '0' => 'Male',
                  '1' => 'Female',
                  '2' => 'Unisex',
                ], null, [

                'id' => 'genderSelector',

                'class' => 'form-control',

                'aria-describedby'=> 'genderHelpBlock',

                'placeholder' => 'Choose Gender',

            ])
        !!}

        @if($errors->any() && $errors->has('gender'))

            {!!

                $errors->first(
                    'gender',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('video_url') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('video_url', 'Product Video:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::text('video_url', null, [

                'class' => 'form-control',

                'aria-describedby'=> 'videoHelpBlock',

                'placeholder' => 'Product Video Link',

            ])
        !!}

        @if($errors->any() && $errors->has('video_url'))

            {!!

                $errors->first(
                    'video_url',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('dimensions') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('dimensions', 'Product Dimensions:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::text('dimensions', null, [

                'class' => 'form-control',

                'aria-describedby'=> 'dimensionsHelpBlock',

                'placeholder' => 'Product Dimensions',

            ])
        !!}

        @if($errors->any() && $errors->has('dimensions'))

            {!!

                $errors->first(
                    'dimensions',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('weight') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('weight', 'Product Weight:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::text('weight', null, [

                'class' => 'form-control',

                'aria-describedby'=> 'weightHelpBlock',

                'placeholder' => 'Product Weight',

            ])
        !!}

        @if($errors->any() && $errors->has('weight'))

            {!!

                $errors->first(
                    'weight',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('image_url*') ? 'has-error' : ''}}">

    <div class="col-md-offset-2 col-md-8">
      {!!
          Form::label('picture', 'Product Pictures:', [

              'class' => 'control-label',

          ])
      !!}

        {!!
            Form::file('image_url[]', [

                'aria-describedby'=> 'imageHelpBlock',

                'multiple' => true,

            ])
        !!}

        @if($errors->any() && $errors->has('image_url*'))

            {!!

                $errors->first(
                    'image_url*',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @else

            <p id="imageHelpBlock" class="help-block">

              @if($editForm)
                Replace Existing Pictures
              @else
                Attach Product Pictures
              @endif

            </p>

        @endif

    </div>

</div>
