<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- FONTAWESOME -->

  <!-- MATERIALIZE CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link  href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!-- JQUERY -->
  <script src="/js/jquery-3.3.1.min.js"></script>

  <!-- POPPER ? -->

  <!-- MATERIALIZE JS -->
  <script src="/js/materialize.js"></script>

  <!-- EXTERNAL CSS -->
  <link  href="/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
 
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Yodel</a>

		<ul class="right hide-on-med-and-down">
			<li><a href="{{ route('register') }}">Register</a></li>
		</ul>

		<ul class="right hide-on-med-and-down">
			<!-- <li><a class='modal-trigger' href="#login-modal">Log In</a></li> -->
			<li><a class='sidenav-trigger' href="#login-modal">Log In</a></li>
			<a href="#" data-target="nav-mobile" class="sidenav-trigger">Log</a>
		</ul>

		<ul id="nav-mobile" class="sidenav">
			<li><a href="#">Navbar Link</a></li>
		</ul>
		<a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Starter Template</h1>
      <div class="row center">
        <h5 class="header col s12 light">An online learning tool for Filipino teachers and students.</h5>
      </div>
      <div class="row center">
        <a href="{{ route('register') }}" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up development</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>
  </div>

  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made By A <a class="orange-text text-lighten-3" href="https://perezjoyce.github.io/portfolio/">Mom</a>
      </div>
    </div>
  </footer>

  <!-- LOGIN MODAL --> 
  <div id="login-modal" class="modal">

	<div class='right row'>
		<a href="#!" class="modal-close waves-effect waves-green btn-flat col s12">&#9587</a>
	</div>

		    
	<form method="POST" action="{{ route('login') }}">
		@csrf
	
    	<div class="row">
	        <div class="col s12">
     			<h4>Login</h4>
     		</div>
     	</div>

     	<div class="row">
	        <div class="input-field col s12">
				<input id="email" type="email" class="validate form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" />
				<label for="email">{{ __('E-Mail Address') }}</label>

		        @if ($errors->has('email'))
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $errors->first('email') }}</strong>
	                </span>
	            @endif
	        </div>
      	</div>

      	<div class="row">
      		<div class="input-field col s12">
				<input id="password" type="password" class="validate form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" />
				<label for="password">{{ __('Password') }}</label>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
	        </div>
      	</div>

      	<div class="row">
      		<div class="input-field col s12">
      			<label for="remember">
			        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
			        <span>{{ __('Remember Me') }}</span>
		      	</label>
		    </div>
		</div>
      	

      	<div class="row">
      		<div class="input-field col s12 right">
				<button type='submit' class="waves-effect waves-light btn">
					<i class="material-icons right">cloud</i> {{ __('Login') }}</button>

		      	@if (Route::has('password.request'))
	                <a class='waves-effect waves-light btn' href="{{ route('password.request') }}">
	                    {{ __('Forgot Your Password?') }}
	                </a>
	            @endif
      		</div>
      	</div>

	</form> 
  </div>

  <div id="container">

  <div id="menu">

    <ul id="slide-out" class="side-nav fixed show-on-large-only">
      <li><a href="#!">First Sidebar Link</a></li>
      <li><a href="#!">Second Sidebar Link</a></li>
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Dropdown<i class="material-icons">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#!">First</a></li>
                <li><a href="#!">Second</a></li>
                <li><a href="#!">Third</a></li>
                <li><a href="#!">Fourth</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>

  <div id="content">
    <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>
    
    <h3>Simple Materialize Responsive Side Menu</h3>
    
    <p>Resize browser to see what it looks like in (a) brwoser (b) mobile devices</p>

  </div>
    
</div>


  <!--  EXTERNAL JS -->
  <script src="/js/script.js"></script>
  <!-- <script src="js/init.js"></script> -->

  </body>
</html>
