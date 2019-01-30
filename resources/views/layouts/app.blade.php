<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('head')
  <style type="text/css">
    @media only screen and (min-width: 961px) {
      main {
          padding-left: 150px;
        }
    }
  </style>
  <body>
    @include('header')
    @yield('main')
    @include('footer')
    @include('modals')
    @include('scripts')
  </body>
</html>
