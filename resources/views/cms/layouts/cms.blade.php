<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin</title>

    <!--Pulling Awesome Font -->
    <link
      href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
      rel="stylesheet">

    <link rel="stylesheet"
    	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="{{asset('images/fav.png')}}" rel="shortcut icon" type="image">

    <link rel="stylesheet" href="{{asset('css/cms_styles.css')}}">

    @yield('more')

    <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>

    <!-- Latest compiled JavaScript -->
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="{{asset('js/cms.js')}}">
    </script>
  </head>
  <body>

  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{url('/admin')}}">
        <img src="{{asset('images/logo.png')}}" alt="KidsCity Logo"
          class="kidscity_logo">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav" id="link_section">
      <li class="{{ areActiveRoutes(['main', 'brands.index']) }}"
        id="brands">
        <a href="{{ route('brands.index') }}">
          Brands
        </a>
      </li>
      <li class="{{ isActiveRoute('categories.index') }}"
         id="categories">
        <a href="{{ route('categories.index') }}">
          Categories
        </a>
      </li>
      <li class="{{ isActiveRoute('price_categories.index') }}"
        id="price_categories">
        <a href="{{ route('price_categories.index') }}">
          PriceCategories
        </a>
      </li>
      <li class="{{ isActiveRoute('products.index') }}"
        id="products">
        <a href="{{ route('products.index') }}">
          Products
        </a>
      </li>
      <li class="{{ isActiveRoute('orders.index') }}"
        id="orders">
        <a href="{{ route('orders.index') }}">
          Orders
        </a>
      </li>
      <li class="{{ isActiveRoute('locations.index') }}"
        id="locations">
        <a href="{{ route('locations.index') }}"
          title="Delivery Locations">
          Locations
        </a>
      </li>

    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle {{ isActiveRoute('change_password') }}"
          data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span> Account
          <span class="caret"></span>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}"
                method="POST" style="display: none;">{{ csrf_field() }}</form>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{ route('change_password') }}">
                Change password
              </a>
           </li>
          </ul>
        </a>
      </li>
    </ul>
  </div>
  </div>
</nav>

  @yield('content')

  <div class="footer">
    <div class="footer-div">KidsCity &copy; {{ Date('Y') }}</div>
    <div class="footer-div footer-right pull-right">
      Built by <a href="http://ipfsoftwares.com">iPF Softwares</a>
    </div>
  </div>

  </body>
</html>
