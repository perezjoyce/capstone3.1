<aside>
	<ul id="slide-out" class="sidenav sidenav-fixed center">
		
		<a href="#">
			<li>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
							<i class="material-icons"><h4 class='no-margin-bottom'>home</h4></i>
						</div>
						<div class="col s12">
							<small class='light'>DASHBOARD</small>
						</div>
					</div>
				</div>
			</li>
		</a>

		<a href="#">
			<li class='active'>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons"><h4 class='no-margin-bottom'>import_contacts</h4></i>
					</div>
					<div class="col s12">
						<small class='light'>CURRICULUM</small>
					</div>
				</div>
			</li>
		</a>

		<a href="#">
			<li class=''>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons"><h4 class='no-margin-bottom'>show_chart</h4></i>
					</div>
					<div class="col s12">
						<small class='light'>STATISTICS</small>
					</div>
				</div>
			</li>
		</a>

		<a href="#">
			<li>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons"><h4 class='no-margin-bottom'>list</h4></i>
					</div>
					<div class="col s12">
						<small class='light'>CLASS LIST</small>
					</div>
				</div>
			</li>
		</a>

		<a href="#">
			<div class="icon-block row no-margin-bottom">
				<div class="col s12">
					<i class="material-icons"><h4 class='no-margin-bottom'>people</h4></i>
				</div>
				<div class="col s12">
					<small class='light'>STUENTS</small>
				</div>
			</div>
		</a>

		<a href="#">
			<li>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons"><h4 class='no-margin-bottom'>forum</h4></i>
					</div>
					<div class="col s12">
						<small class='light'>MESSAGES</small>
					</div>
				</div>
			</li>
		</a>

		<a href="{{ route('logout') }}"  onclick="event.preventDefault();
                	document.getElementById('logout-form').submit();">
            <li>
				<div class="icon-block row no-margin-bottom">
					<div class="col s12">
						<i class="material-icons"><h4 class='no-margin-bottom'>exit_to_app</h4></i>
					</div>
					<div class="col s12">
		                <small class='light'>{{ __('LOGOUT') }}</small>   	
		           		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                    @csrf
		                </form>
					</div>
				</div>

			</li>
		</a>        


    </ul>
</aside>