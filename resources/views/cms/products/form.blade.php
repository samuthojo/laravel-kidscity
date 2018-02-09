<style media="screen">
  .form-control {
    width: 100% !important;
  }
  .fa-2x {
    font-size: 2.5em;
  }
</style>
<script src="{{asset('js/tinymce/js/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script>tinymce.init({
  selector: 'textarea',
  height: 200,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime table contextmenu paste code help wordcount'
  ],
toolbar: 'formatselect | bold italic forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});</script>
<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">
        {!!
            Form::text('code', null, [

                'class' => 'form-control',

                'aria-describedby'=> 'codeHelpBlock',

                'placeholder' => 'Product Code',

                'autofocus' => $autofocus,
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

    <div class="col-md-offset-3 col-md-6">
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

    <div class="col-md-offset-3 col-md-6">
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

    <div class="col-md-offset-3 col-md-6">
        {!!
            Form::textarea(
                'description',

                null,

                [

                    'rows' => 2,

                    'class' => 'form-control',

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

        @else

            <p id="descriptionHelpBlock" class="help-block">

                Include Product Description

            </p>

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">
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

    <div class="col-md-offset-3 col-md-6">
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

  <div class="col-md-offset-3 col-md-6">
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

<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">
        {!!
            Form::select('category_id', $categories, null, [

                'id' => 'categorySelector',

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'categoryHelpBlock',

                'onchange' => 'fetchSubCategories()',

                'placeholder' => 'Choose Category',

            ])
        !!}

        @if($errors->any() && $errors->has('category_id'))

            {!!

                $errors->first(
                    'category_id',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('sub_category_id') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6" style="display:inline-block;">

        @if(!is_null($selectedSubCategory))

          <input type="hidden" name="sub_category_id"
            value="{{$selectedSubCategory->id}}"/>

        @endif

        {!!
            Form::select('sub_category_id', $subCategories, null, [

                'id' => 'subCategorySelector',

                'class' => 'form-control',

                'aria-describedby'=> 'subCategoryHelpBlock',

                'placeholder' => 'Choose Sub-Category',

                'disabled' => 'true',

            ])
        !!}

        @if($errors->any() && $errors->has('sub_category_id'))

            {!!

                $errors->first(
                    'sub_category_id',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

    <div class="col-md-3"
      style="display:inline-block;">
      @include('cms.select_loader')
    </div>
</div>



<div class="form-group {{ $errors->has('brand_id') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">        {!!
            Form::select('brand_id', $brands, null, [

                'id' => 'brandSelector',

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'brandHelpBlock',

                'placeholder' => 'Choose Brand',

            ])
        !!}

        @if($errors->any() && $errors->has('brand_id'))

            {!!

                $errors->first(
                    'brand_id',

                    '<p class="help-block">:message</p>'
                )

            !!}

       @endif

    </div>

</div>

<div class="form-group {{ $errors->has('price_category_id') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">        {!!
            Form::select('price_category_id', $priceCategories, null, [

                'id' => 'priceCategorySelector',

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'priceCategoryHelpBlock',

                'placeholder' => 'Choose Price-Category',

            ])
        !!}

        @if($errors->any() && $errors->has('price_category_id'))

            {!!

                $errors->first(
                    'price_category_id',

                    '<p class="help-block">:message</p>'
                )

            !!}

       @endif

    </div>

</div>

<div class="form-group {{ $errors->has('product_age_range_id') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">        {!!
            Form::select('product_age_range_id', $ageRanges, null, [

                'id' => 'ageRangeSelector',

                'class' => 'form-control',

                'required' => 'required',

                'aria-describedby'=> 'ageRangeHelpBlock',

                'placeholder' => 'Choose Age-Range',

            ])
        !!}

        @if($errors->any() && $errors->has('product_age_range_id'))

            {!!

                $errors->first(
                    'product_age_range_id',

                    '<p class="help-block">:message</p>'
                )

            !!}

       @endif

    </div>

</div>

<div class="form-group {{ $errors->has('product_size_id') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">
        {!!
            Form::select('product_size_id', [], null, [

                'id' => 'sizeSelector',

                'class' => 'form-control',

                'aria-describedby'=> 'sizeHelpBlock',

                'placeholder' => 'Choose Product-Size',

                'disabled' => true,

            ])
        !!}

        @if($errors->any() && $errors->has('product_size_id'))

            {!!

                $errors->first(
                    'product_size_id',

                    '<p class="help-block">:message</p>'
                )

            !!}

       @endif

    </div>

</div>

<div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">
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

        @if($errors->any() && $errors->has('gender_id'))

            {!!

                $errors->first(
                    'gender_id',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @endif

    </div>

</div>

<div class="form-group {{ $errors->has('video_url') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">        {!!
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

    <div class="col-md-offset-3 col-md-6">
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

    <div class="col-md-offset-3 col-md-6">
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

<div class="form-group {{ $errors->has('image_url') ? 'has-error' : ''}}">

    <div class="col-md-offset-3 col-md-6">        {!!
            Form::file('image_url', [

                'aria-describedby'=> 'imageHelpBlock',

                'multiple' => true,

            ])
        !!}

        @if($errors->any() && $errors->has('image_url'))

            {!!

                $errors->first(
                    'image_url',

                    '<p class="help-block">:message</p>'
                )

            !!}

        @else

            <p id="imageHelpBlock" class="help-block">

                Attach Product Pictures

            </p>

        @endif

    </div>

</div>
