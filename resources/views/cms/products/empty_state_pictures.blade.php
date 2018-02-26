{!!
    Form::open([
        'files'  => true,

        'class' =>  'form-horizontal',

        'method' => 'POST',

        'route'  => ['products.store_pictures', 'product' => $product->id],
    ])
!!}

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

                'required' => 'required',

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


                Attach Product Pictures


            </p>

        @endif

    </div>

</div>

<div class="form-group">

  <div class="col-md-offset-2 col-md-8">

    {!!
        Form::button('Submit', [
            'type' => 'submit',

            'class' => 'btn btn-primary',

            'title' => 'Submit',
        ])
    !!}

  </div>

</div>

{!! Form::close() !!}
