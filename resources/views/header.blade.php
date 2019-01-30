	<header>
		<nav class="light-blue lighten-1" role="navigation">
		    <div class="nav-wrapper container">
		    	<a id="logo-container" href="{{ url('/') }}" class="brand-logo">
		    		Yodel
		    	</a>

		    	@guest
		    		@if (Route::has('register'))
		    		
		    		<ul class="right hide-on-small-only">
						<li><a class='modal-trigger' href="#register-modal">Register</a></li>
					</ul>
			       

					<ul class="right hide-on-small-only">
						<li><a class='modal-trigger' href="#login-modal">Login</a></li>
					</ul>
				  
				  	@endif
				  	@else
				  	<ul class="right">
				  		<li class='hide-on-small-only'>Hello, {{ Auth::user()->username }}!</li>
				  		<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				  	</ul>
			  	@endguest
		    </div>
		</nav>
		
	</header>