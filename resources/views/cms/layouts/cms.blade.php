<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>

    <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>

    @yield('more')

    <!-- Latest compiled JavaScript -->
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>

    <script type="text/javascript" src="{{asset('js/cms.js')}}">
    </script>

    <!--Pulling Awesome Font -->
    <link
      href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
      rel="stylesheet">

    <link href="{{asset('images/fav.png')}}" rel="shortcut icon" type="image">

    <link rel="stylesheet" href="{{asset('css/cms_styles.css')}}">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/cms_styles2.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

  </head>
  <body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{asset('images/logo.png')}}" class="kidscity_logo"
                  alt="KidCity Logo">
            </div>

            <ul class="list-unstyled components">
                <p>KidCity CMS</p>
                <li class="{{areActiveRoutes(['main', 'brands.index'])}}">
                    <a href="{{ route('brands.index') }}">Brands</a>
                </li>
                <li class="{{isActiveRoute('categories.index')}}">
                    <a href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="{{isActiveRoute('sub_categories')}}">
                    <a href="{{ route('sub_categories') }}">
                      SubCategories</a>
                </li>
                <li class="{{isActiveRoute('price_categories.index')}}">
                    <a href="{{ route('price_categories.index') }}">
                      PriceCategories
                    </a>
                </li>
                <li class="{{isActiveRoute('products.index')}}">
                    <a href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="{{isActiveRoute('orders.index')}}">
                    <a href="{{ route('orders.index') }}">Orders</a>
                </li>
                <li class="{{isActiveRoute('locations.index')}}">
                    <a href="{{ route('locations.index') }}">Locations</a>
                </li>
                <li class="{{isActiveRoute('change_password')}}">
                  <a href="#accountSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-user">&nbsp;Account</i>
                  </a>
                  <ul class="collapse list-unstyled" id="accountSubmenu">
                      <li><a href="#">Logout</a></li>
                      <li><a href="{{ route('change_password') }}">Change Password</a></li>
                  </ul>
                </li>
            </ul>
        </nav>

  <div class="container-fluid" id="content">
    @yield('content')
  </div>

</div> <!--wrapper-->

  <!-- jQuery Custom Scroller CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

  <script type="text/javascript">
      $(document).ready(function () {
          $("#sidebar").mCustomScrollbar({
              theme: "minimal"
          });

          $('#sidebarCollapse').on('click', function () {
              $('#sidebar, #content').toggleClass('active');
              $('.collapse.in').toggleClass('in');
              $('a[aria-expanded=true]').attr('aria-expanded', 'false');
          });
      });
  </script>
  </body>
</html>
