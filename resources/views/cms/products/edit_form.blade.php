{!!
    Form::model($product, [
        'files'  => true,

        'class' =>  'form-horizontal',

        'method' => 'PATCH',

        'route'  => ['products.update', $product->id],
    ])
!!}

<div class="panel panel-default">

  <div class="panel-heading">

    <h4 class="title pull-left">Edit Product</h4>

    <div class="btn-group pull-right">

      <a
          class="btn btn-default"
          href="{{ route('products.index') }}"
          title="Cancel">
          Cancel
      </a>

      {!!
          Form::button('Save', [
              'type' => 'submit',

              'class' => 'btn btn-primary',

              'title' => 'Save',
          ])
      !!}

    </div>

    <div class="clearfix"></div>

  </div>

  <div class="panel-body">

    @include ('cms.products.form')

  </div>

  <div class="panel-footer">
    
    <div class="btn-group pull-right">

      <a
          class="btn btn-default"
          href="{{ route('products.index') }}"
          title="Cancel">
          Cancel
      </a>

      {!!
          Form::button('Save', [
              'type' => 'submit',

              'class' => 'btn btn-primary',

              'title' => 'Save',
          ])
      !!}

    </div>

    <div class="clearfix"></div>

  </div>

</div>

{!! Form::close() !!}
