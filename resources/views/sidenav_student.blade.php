<aside class='z-depth-1'>
	<ul id="slide-out" class="sidenav sidenav-fixed center z-depth-1 deep-purple darken-4">
		<br>

		<a href="#">
			<div class="icon-block row no-margin-bottom">
				<div class="col s12">
					<h3 id="logo-container" class="brand-logo center white-text">
						Blend.io
					</h3>
				</div>
			</div>
		</a>

		<br>
		
		<a href="{{ url('student_dashboard') }}">
			<li @if ($currentRoute == "student_dashboard") class="active" @endif>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
							<i class="material-icons deep-purple-text text-lighten-5"><h5 class="no-margin-bottom">home</h5></i>
						</div>
						<div class="col s12">
							<small class='deep-purple-text text-lighten-5'>DASHBOARD</small>
						</div>
					</div>
				</div>
			</li>
		</a>

		<a href="{{ url('student_curriculum') }}">
			<li @if ($currentRoute == "student_curriculum" || $currentRoute == "student_lessons") class="active" @endif>
				<div class="icon-block">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>import_contacts</h5></i>
					</div>
					<span class="col s12">
						<small class='deep-purple-text text-lighten-5'>TASKS</small>
					</span>
				</div>
			</li>
		</a>

		<a href="{{ url('student_progress') }}">
			<li @if ($currentRoute == "student_progress") class="active" @endif>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>timeline</h5></i>
					</div>
					<div class="col s12">
						<small class='deep-purple-text text-lighten-5'>PROGRESS</small>
					</div>
				</div>
			</li>
		</a>

		<a href="{{ url('student_sections') }}">
			<li @if ($currentRoute == "student_sections" || $currentRoute =="student_archived_sections" ) class="active" @endif>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>list</h5></i>
					</div>
					<div class="col s12">
						<small class='deep-purple-text text-lighten-5'>CLASSES</small>
					</div>
				</div>
			</li>
		</a>

		<a href="#">
			<li>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>forum</h5></i>
					</div>
					<div class="col s12">
						<small class='deep-purple-text text-lighten-5'>MESSAGES</small>
					</div>
				</div>
			</li>
		</a>

		<a href="{{ route('logout') }}"  onclick="event.preventDefault();
                	document.getElementById('logout-form').submit();">
            <li>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>exit_to_app</h5></i>
					</div>
					<div class="col s12">
		                <small class='deep-purple-text text-lighten-5'>{{ __('LOGOUT') }}</small>   	
		           		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                    @csrf
		                </form>
					</div>
				</div>

			</li>
		</a>        
    </ul>
</aside>

