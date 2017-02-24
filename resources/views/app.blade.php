<html>
<head>
  <meta charset="utf-8">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, owner-scalable=no">

  <title>@yield('title') | {{ config('app.name', 'Pre-Save') }}</title>
  
  <link rel="stylesheet" href="/css/app.css"/>

  <script>
    /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-31340370-14', 'auto');
    ga('send', 'pageview');*/
  </script>

  <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
          'domain' => config('session.domain')
      ]); ?>
  </script>

</head>
<body class="">

  <div id="app">
    
    <header class="header group">

        <a href="#" id="menu-toggle"><span></span></a>

    </header>
    
    {{-- <nav>
      @if (Auth::guest())
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
      @else
          <li>
              <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul role="menu">
                  <li>
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
              </ul>
          </li>
      @endif
    </nav> --}}
    

      <errors></errors>
    
      {{-- <router-view></router-view> --}}
        
      @yield('content')

    
    <footer>
    
    </footer>
  </div>

  <script src="/js/app.js"></script>
</body>
</html>