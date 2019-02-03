<!DOCTYPE html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('head')
  	<body>
  		<header>
			<nav class="deep-purple darken-4" role="navigation">
			    <div class="nav-wrapper container">
			    	<a id="logo-container" href="{{ url('/') }}" class="brand-logo">
			    		<h3>Blend.io</h3>
			    	</a>

			    	@guest
			    		@if (Route::has('register'))
			    		
			    		<ul class="right hide">
							<li><a class='modal-trigger' href="#register-modal">Register</a></li>
						</ul>
				          
						

						<ul class="right hide">
							<li><a class='modal-trigger' href="#login-modal">Login</a></li>
						</ul>

						<a class='dropdown-trigger right' href='#' data-target='navlinks'><i class="material-icons">menu</i></a>
						<ul id='navlinks' class='dropdown-content'>
					  		<li><a class='modal-trigger' href="#register-modal">Register</a></li>
			                <li><a class='modal-trigger' href="#login-modal">Log In</a></li>
						</ul>
					  
					  	@endif
					  	@else
					  	<a class="dropdown-trigger right" href="#!" data-target="logout">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a>

					  	

					  	<ul id="logout" class="dropdown-content">
						  	<li>
						  		<a href="{{ route('logout') }}"  onclick="event.preventDefault();
			                    document.getElementById('logout-form').submit();">{{ __('Logout') }}
			               		</a>
			               	</li>
			                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                            @csrf
			                        </form>
						  <li><a href="#!">two</a></li>
						  <li class="divider"></li>
						  <li><a href="#!">three</a></li>
						</ul>
				  	@endguest
			    </div>
			</nav>
		</header>
  		<main>
			<div class="section no-pad-bot" id="index-banner">

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
							@endif


			  				
			  			</div>
			  		</div>
			  	</div>
			    <div class="container">
			      <br><br>
			      <h2 class="header center orange-text custom-heading">Blended Learning Made Easy</h2>
			      <div class="row center">
			        <h5 class="header col s12 light">Over 1000 K-12 lessons available for FREE.</h5>
			      </div>
			      <div class="row center">
			        <a href="#register-modal" id="download-button" class="btn-large waves-effect waves-light orange pulse modal-trigger">Get Started</a>
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
				        <h2 class="center deep-purple-text text-darken-4"><i class="material-icons">flash_on</i></h2>
				        <h5 class="center">Speeds up development</h5>

				        <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
				      </div>
				    </div>

				    <div class="col s12 m4">
				      <div class="icon-block">
				        <h2 class="center deep-purple-text text-darken-4"><i class="material-icons">group</i></h2>
				        <h5 class="center">User Experience Focused</h5>

				        <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
				      </div>
				    </div>

				    <div class="col s12 m4">
				      <div class="icon-block">
				        <h2 class="center deep-purple-text text-darken-4"><i class="material-icons">settings</i></h2>
				        <h5 class="center">Easy to work with</h5>

				        <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
				      </div>
				    </div>
				  </div>

				</div>
				<br><br>
			</div>
		</main>
	    @include('footer')
	    @include('modals')
	    @include('scripts')
	</body>
</html>
  
