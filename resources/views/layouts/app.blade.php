<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/style-starter.css') }}">

        <!-- google fonts -->
        <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('public/js/app.js') }}" defer></script>
              <!-- /move top -->

        <script src="{{ asset('public/assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery-1.10.2.min.js') }}"></script>

    </head>
    <body class="sidebar-menu-collapsed">
        {{ $slot }}
        @stack('scripts')
    </body>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
          scrollFunction()
        };

        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("movetop").style.display = "block";
          } else {
            document.getElementById("movetop").style.display = "none";
          }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
      </script>

      <!-- chart js -->
      {{-- <script src="{{ asset('public/assets/js/Chart.min.js') }}"></script> --}}
      {{-- <script src="{{ asset('public/assets/js/utils.js') }}"></script> --}}
      <!-- //chart js -->

      <!-- Different scripts of charts.  Ex.Barchart, Linechart -->
      {{-- <script src="{{ asset('public/assets/js/bar.js') }}"></script> --}}
      {{-- <script src="{{ asset('public/assets/js/linechart.js') }}"></script> --}}
      <!-- //Different scripts of charts.  Ex.Barchart, Linechart -->

      {{-- data table --}}
      <script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>


      <script src="{{ asset('public/assets/js/jquery.nicescroll.js') }}"></script>
      <script src="{{ asset('public/assets/js/scripts.js') }}"></script>

      <!-- close script -->
      <script>
        var closebtns = document.getElementsByClassName("close-grid");
        var i;

        for (i = 0; i < closebtns.length; i++) {
          closebtns[i].addEventListener("click", function () {
            this.parentElement.style.display = 'none';
          });
        }
      </script>
      <!-- //close script -->

      <!-- disable body scroll when navbar is in active -->
      <script>
        $(function () {
          $('.sidebar-menu-collapsed').click(function () {
            $('body').toggleClass('noscroll');
          })
        });
      </script>
      <!-- disable body scroll when navbar is in active -->

       <!-- loading-gif Js -->
       <script src="{{ asset('public/assets/js/modernizr.js') }}"></script>
       <script>
           $(window).load(function () {
               // Animate loader off screen
               $(".se-pre-con").fadeOut("slow");;
           });
       </script>
       <!--// loading-gif Js -->

      <!-- Bootstrap Core JavaScript -->
      <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/upload_image.js') }}"></script>
</html>
