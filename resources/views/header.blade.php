<!-- 	<header>
		<nav class="light-blue lighten-1" role="navigation">
		    <div class="nav-wrapper container">
		    	<a id="logo-container center-align" href="{{ url('/') }}" class="brand-logo">
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
				  		<li class='hide-on-med-and-down'>Hello, {{ Auth::user()->username }}!</li>
				  		<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				  	</ul>
			  	@endguest
		    </div>
		</nav>

		<nav>
			<div class="nav-wrapper">
		      <a href="#" class="brand-logo right" style='padding-right:40px;'>Logo</a>
		   <ul id="nav-mobile" class="right hide-on-med-and-down">
		        <li><a href="sass.html">Sass</a></li>
		        <li><a href="badges.html">Components</a></li>
		        <li><a href="collapsible.html">JavaScript</a></li>
		      </ul> 
		    </div>
		</nav>
		
	</header> -->