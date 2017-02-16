<html>
<head>
  <meta charset="utf-8">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, owner-scalable=no">

  <link rel="apple-touch-icon" sizes="57x57" href="/images/icons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/images/icons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/images/icons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/images/icons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/images/icons/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/images/icons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/images/icons/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/images/icons/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/images/icons/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="/images/icons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/images/icons/android-chrome-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="/images/icons/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="/images/icons/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/images/icons/manifest.json">
  <link rel="mask-icon" href="/images/icons/safari-pinned-tab.svg" color="#49d4ae">
  <link rel="shortcut icon" href="/images/icons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-TileImage" content="/images/icons/mstile-144x144.png">
  <meta name="msapplication-config" content="/images/icons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <title>{{ config('app.name', 'Pre-Save') }}</title>
  
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
      ]); ?>
  </script>

</head>
<body class="">

  <div id="app">
    
    <header class="header group">

      <a href="#" id="menu-toggle" class="no-ajaxy"><span></span></a>

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

      <router-view></router-view>
        
      {{-- @yield('content') --}}
      
      @if (Auth::check())
        <script>
          
        </script>
      @endif

    
    <footer>
    
    </footer>
  </div>

  <script src="/js/app.js"></script>
</body>
</html>