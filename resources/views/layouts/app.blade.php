<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!--ajax token-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
  <!--jquery-->
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
  <!-- Bootstrap CSS File -->
  <link href="{{asset('template/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Libraries CSS Files -->
  <link href="{{asset('template/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/lib/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('template/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="{{asset('template/css/style.css')}}" rel="stylesheet">
  <!--daum address api-->
  <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
  <!--chartjs api-->
  <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
  <!-- project js-->
  <script src="{{asset('project_js/tool.js')}}"></script>
</head>
<body>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="//js.pusher.com/3.1/pusher.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script type="text/javascript">
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('ul.dropdown-menu');

    if (notificationsCount <= 0) {
      notificationsWrapper.hide();
    }

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('9e41dc6b79f33308a87d', {
      cluster: 'mt1',
      encrypted: true,
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('status-liked');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\StatusLiked', function(data) {
      var existingNotifications = notifications.html();
      var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
      var newNotificationHtml = `
        <li class="notification active">
            <div class="media">
              <div class="media-left">
                <div class="media-object">
                  <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                </div>
              </div>
              <div class="media-body">
                <strong class="notification-title">`+data.message+`</strong>
                <!--p class="notification-desc">Extra description can go here</p-->
                <div class="notification-meta">
                  <small class="timestamp">about a minute ago</small>
                </div>
              </div>
            </div>
        </li>
      `;
      notifications.html(newNotificationHtml + existingNotifications);

      notificationsCount += 1;
      notificationsCountElem.attr('data-count', notificationsCount);
      notificationsWrapper.find('.notif-count').text(notificationsCount);
      notificationsWrapper.show();
    });
  </script>

  <header id="header" style="background:black;">
    <div class="container">
      <div id="logo" class="pull-left">
        <h1>
          <a href="/" class="scrollto">SITE.In</a>
        </h1>
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="#" data-toggle="modal" data-target="#myModal">검색</a></li>
          @if(!Auth::check())
          <li><a href="#" onclick="log_modal('{{route('login')}}')" data-toggle="modal" data-target="#exampleModal">로그인</a></li>
          <li><a href="#" onclick="log_modal('{{route('register')}}')" data-toggle="modal" data-target="#exampleModal">회원가입</a></li>
          @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              {{Auth::user()->name}}님 의정보
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <br>
              <a class="dropdown-item" href="{{route('myStatus')}}" class="nav-link">전체현황</a>
              <br>
              <a class="dropdown-item" href="/my_index/{{Auth::id()}}" class="nav-link">내글보기</a>
              <br>
              <a class="dropdown-item" href="{{route('myLogStatus')}}">내정보</a>
            </div>
          </li>
          <li><a href="{{ route('content.create')}}">글쓰기</a></li>
          @endif
          <li><a href="{{route('home')}}">메인페이지</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!--log Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="log-modal" class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--search modal-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <span>제목+내용검색</span>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="subscribe">
             <div class="container wow fadeInUp">
               <form action="/search/" method="get">
                 <div class="form-row justify-content-center">
                   @yield('my_page')
                   <div class="col-auto">
                     <input type="text" class="form-control" name="search" class="form-control" placeholder="Search">
                   </div>
                   <div class="col-auto">
                     <button type="submit">search</button>
                   </div>
                 </div>
               </form>
             </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="nav">
    @yield('nav')
  </div>
  <div class="sctiocn">
    @yield('section')
  </div>
  <div id="footer">
    @yield('footer')
  </div>
  <!-- JavaScript Libraries -->
  <script src="{{asset('template/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('template/lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('template/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('template/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('template/lib/superfish/hoverIntent.js')}}"></script>
  <script src="{{asset('template/lib/superfish/superfish.min.js')}}"></script>
  <script src="{{asset('template/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('template/lib/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('template/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{asset('template/contactform/contactform.js')}}"></script>
  <!-- Template Main Javascript File -->
  <script src="{{asset('template/js/main.js')}}"></script>
</body>
</html>
