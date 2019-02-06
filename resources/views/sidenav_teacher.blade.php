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
		
		<a href="{{ url('teacher_dashboard') }}">
			<li @if ($currentRoute == "teacher_dashboard") class="active" @endif>
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

		<a href="{{ url('teacher_curriculum') }}">
			<li @if ($currentRoute == "teacher_curriculum" || $currentRoute == "teacher_lesson") class="active" @endif>
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

		<a href="teacher_curriculum_content">
			<li @if ($currentRoute == "teacher_curriculum_content") class="active" @endif>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>timeline</h5></i>
					</div>
					<div class="col s12">
						<small class='deep-purple-text text-lighten-5'>STATISTICS</small>
					</div>
				</div>
			</li>
		</a>

		<a href="{{ url('teacher_sections') }}">
			<li @if ($currentRoute == "teacher_sections" || $currentRoute =="teacher_archived_sections" ) class="active" @endif>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>list</h5></i>
					</div>
					<div class="col s12">
						<small class='deep-purple-text text-lighten-5'>CLASS LIST</small>
					</div>
				</div>
			</li>
		</a>

		<a href="{{ url('teacher_students_list') }}">
			<li @if ($currentRoute == "teacher_students_list" || $currentRoute == "teacher_student_account") class="active" @endif>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons deep-purple-text text-lighten-5"><h5 class='no-margin-bottom'>people</h5></i>
					</div>
					<div class="col s12">
						<small class='deep-purple-text text-lighten-5'>STUDENTS</small>
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

