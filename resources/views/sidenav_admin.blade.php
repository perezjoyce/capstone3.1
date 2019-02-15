<aside class='z-depth-1'>
	<ul id="slide-out" class="sidenav sidenav-fixed center z-depth-1 deep-purple darken-4">

		<a href="#">
			<div class="icon-block row no-margin-bottom">
				<div class="col s12">
					<h3 id="logo-container" class="brand-logo center white-text">
						Blend.io
					</h3>
				</div>
			</div>
		</a>
		
		<a href="{{ url('admin_dashboard') }}">
			<li @if ($currentRoute == "admin_dashboard") class="active" @endif>
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

		<a href="{{ url('admin_curriculum') }}">
			<li @if ($currentRoute == "admin_curriculum" || $currentRoute == "admin_lesson") class="active" @endif>
				<div class="icon-block">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>import_contacts</h5></i>
					</div>
					<span class="col s12">
						<small class='deep-purple-text text-lighten-5'>CURRICULUM</small>
					</span>
				</div>
			</li>
		</a>

		<a href="{{ url('admin_users_list') }}">
			<li @if ($currentRoute == "admin_users_list" || $currentRoute == "admin_student_account") class="active" @endif>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>people</h5></i>
					</div>
					<div class="col s12">
						<small class='deep-purple-text text-lighten-5'>USERS</small>
					</div>
				</div>
			</li>
		</a>

		<a href="{{ url('admin_questions_approval') }}">
			<li @if ($currentRoute == "admin_questions_approval") class="active" @endif>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>assignment_turned_in</h5></i>
					</div>
					<div class="col s12">
						<small class='deep-purple-text text-lighten-5'>APPROVALS</small>
					</div>
				</div>
			</li>
		</a>

		<a href="#" class="tooltipped "disabled data-position="bottom" data-tooltip="Messaging is not yet available.">
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

