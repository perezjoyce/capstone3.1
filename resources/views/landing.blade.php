<!DOCTYPE html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('head')
  	<body>
  		<header>
			<div class="navbar-fixed">
				<nav class="deep-purple darken-4" role="navigation">
					<div class="nav-wrapper container">
						<a id="logo-container" href="{{ url('/') }}" class="brand-logo">
							<h3>Blend.io</h3>
						</a>

						@guest
							@if(Route::has('register'))

								<ul class="right hide-on-small-only show-on-medium-and-up">
									<li><a class='modal-trigger' href="#login-modal">Log In</a></li>
									<li><a class='modal-trigger btn orange' href="#register-modal">Sign Up</a></li>
								</ul>

								<a class='dropdown-trigger right show-on-small hide-on-med-and-up' href='#' data-target='navlinks'><i class="material-icons">menu</i></a>
								<ul id='navlinks' class='dropdown-content'>
									<li><a class='modal-trigger' href="#register-modal">Register</a></li>
									<li><a class='modal-trigger' href="#login-modal">Log In</a></li>
								</ul>

							@endif
						@else

							<ul class="right hide-on-small-only show-on-medium-and-up">
								@if(Auth::user()->admin == 1)
									<li><a class='modal-trigger' href="{{ url('admin_dashboard') }}">Dashboard</a></li>
								@elseif(Auth::user()->role == 'teacher')
									<li><a class='modal-trigger' href="{{ url('teacher_dashboard') }}">Dashboard</a></li>
								@elseif(Auth::user()->role == 'student')
									<li><a class='modal-trigger' href="{{ url('student_dashboard') }}">Dashboard</a></li>
								@endif
									<li>
										<a class="btn deep-purple lighten-2" href="{{ route('logout') }}"  onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">{{ __('Logout') }}
										</a>
									</li>
							</ul>

							<a class='dropdown-trigger right show-on-small hide-on-med-and-up' href='#' data-target='navlinks'><i class="material-icons">menu</i></a>
							<ul id='navlinks' class='dropdown-content'>
								@if(Auth::user()->admin == 1)
									<li><a class='modal-trigger' href="{{ url('admin_dashboard') }}">Dashboard</a></li>
								@elseif(Auth::user()->role == 'teacher')
									<li><a class='modal-trigger' href="{{ url('teacher_dashboard') }}">Dashboard</a></li>
								@elseif(Auth::user()->role == 'student')
									<li><a class='modal-trigger' href="{{ url('student_dashboard') }}">Dashboard</a></li>
								@endif
									<li>
										<a href="{{ route('logout') }}"  onclick="event.preventDefault();
			                    document.getElementById('logout-form').submit();">{{ __('Logout') }}
										</a>
									</li>
							</ul>


							{{--<a class="dropdown-trigger right" href="#!" data-target="logout">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a>--}}
							{{--<ul id="logout" class="dropdown-content">--}}
								{{--<button>--}}
									{{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
										{{--@csrf--}}
									{{--</form>--}}

								{{--</button>--}}
							{{--</ul>--}}
						@endguest
					</div>
				</nav>
			</div>

		</header>
  		<main>
			<div class="section no-padding" id="index-container">
			  	<div class="container">
			  		<div class="row">
			  			<div class="col s12">

							@if($errors->any())
								<div class="alert alert-danger mb-5 rounded-0">
									<ul class='list-unstyled'>
										@foreach ($errors->all() as $error)
											<script>

                                                var toastHTML = '<span>{{ $error }}</span>';
                                                M.toast({html: toastHTML, classes: 'rounded'});

											</script>
										@endforeach
									</ul>
								</div>
							@elseif(Session::has("successmessage"))
								<div class="alert alert-danger mb-5 rounded-0">
									<ul class='list-unstyled'>

										<script>

                                            var toastHTML = '<span>{{ Session::get('successmessage') }}</span>';
                                            M.toast({html: toastHTML, classes: 'rounded'});

										</script>
									</ul>
								</div>
							@elseif(Session::has("deletemessage"))
								<div class="alert alert-danger mb-5 rounded-0">
									<ul class='list-unstyled'>
										<script>
                                            var toastHTML = '<span>{{ Session::get('deletemessage') }}</span>';
                                            M.toast({html: toastHTML, classes: 'rounded'});
										</script>
									</ul>
								</div>
							@endif


			  			</div>
			  		</div>
			  	</div>
			    <div class="row no-pad-bot">
					<div class="col l1"></div>
					<div class="col s12 m12 l5 left no-pad-bot" id="index-banner"></div>
					<div class="col s12 m12 l5 center">
						<div class="row center margin-top-7em-large">
							<h3 class="header center custom-heading bold no-margin-bottom grey-text text-darken-3 show-on-large hide-on-med-and-down" style="font-family:Nunito,sans-serif">Blended Learning Made Super Easy</h3>
							<h5 class="header col s12 grey-text show-on-large hide-on-med-and-down">Over 1,000 lessons available for FREE</h5>
							<h4 class="header center custom-heading bold no-margin-bottom grey-text text-darken-3 show-on-medium-and-down hide-on-large-only" style="font-family:Nunito,sans-serif">Blended Learning Made Easy</h4>
							<h6 class="header col s12 grey-text show-on-medium-and-down hide-on-large-only">Over 1,000 lessons available for FREE</h6>
						</div>
						<div class="row center">
							<a href="#register-modal" id="download-button" class="btn-large waves-effect waves-light orange modal-trigger">Get Started</a>
						</div>
						<br class="hide-on-small-only show-on-medium-and-up">
						<br>
					</div>
					<div class="col l1"></div>
			    </div>
			</div>

			<div class="container center">
				<div class="section">
				  <!--   Icon Section   -->
				  <div class="row">
				    <div class="col s12 m4">
				      <div class="icon-block">
				        <h2 class="center yellow-text text-darken-1"><i class="material-icons">flash_on</i></h2>
				        <h5 class="center grey-text text-darken-2">Speeds up development</h5>

				        <p class="grey-text text-darken-1 light">
                            We did most of the heavy lifting in lesson plan development so you can focus on what matters more.
                        </p>
				      </div>
				    </div>

                  <div class="col s12 m4">
                      <div class="icon-block">
                          <h2 class="center pink-text text-lighten-1"><i class="material-icons">settings</i></h2>
                          <h5 class="center grey-text text-darken-2">Easy to work with</h5>

                          <p class="grey-text text-darken-1 light">
                              Navigate through hundreds of DepEd-aligned lessons and activities with ease.
                          </p>
                      </div>
                  </div>

				    <div class="col s12 m4">
				      <div class="icon-block">
				        <h2 class="center teal-text text-accent-3"><i class="material-icons">group</i></h2>
				        <h5 class="center grey-text text-darken-2">Supports collaboration</h5>

				        <p class="grey-text text-darken-1 light">
                            Create and share questions with fellow users. This platform was developed by teachers, for teachers.
                        </p>
				      </div>
				    </div>

				  </div>

				</div>
				<br><br>
			</div>
			<div class="section orange lighten-5 black-text">
				<div class="container left-align">
					<br class="hide-on-small-only show-on-medium-and-up">
                    <br class="hide-on-small-only show-on-medium-and-up">
					<div class="row">
                        <div class="col s12 m12 l6 right" id="landing-page-image-2">
                        </div>
						<div class="col s12 m12 l6">
							<h4 class="grey-text text-darken-3">Enrich your lessons with free digital resources.</h4>
							<h6 class="grey-text text-darken-2 light" style="line-height: 1.7;margin-top:2em;">
								Blended learning is an educational approach that involves the intentional integration of technology with instruction to improve learning outcomes.
								It's main goal is to make lessons relevant by transforming instructional design towards meaningful, personalized learning.
							</h6>
							<br>
                            <br class="hide-on-small-only show-on-medium-and-up">
							<a href="#register-modal" id="download-button" class="btn-large waves-effect waves-light orange pulse modal-trigger">REGISTER NOW</a>
						</div>
					</div>
					<br>
					<br>
				</div>
			</div>
		</main>
	    @include('footer')
	    @include('modals')
	</body>
</html>

