<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('head')
  <style type="text/css">
    @media only screen and (min-width: 961px) {
      main {
          padding-left: 200px;
        }
    }
  </style>
  <body>
    @yield('main')
    @include('modals')
    @include('scripts')
  </body>
</html>
