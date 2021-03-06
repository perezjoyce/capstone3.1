			<!-- LOGIN MODAL --> 
			<div id="login-modal" class="modal">

				<div class='right row'>
					<a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
				</div>

				<form method="POST" action="{{ route('login') }}">
					@csrf
				
			    	<div class="row">
				        <div class="col s12">
			     			<h4 class="deep-purple-text text-darken-4">{{ __('Log In') }}</h4>
			     		</div>
			     	</div>

			     	<div class="row">
				        <div class="input-field col s12">
							<input name='email' type="email" class="autocomplete validate {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" />
							<label for="email">{{ __('E-Mail Address') }}</label>

					        @if ($errors->has('email'))
				                <span class="helper-text" role="alert">
			                       {{ $errors->first('email') }}
			                    </span>
				            @endif
				        </div>
			      	</div>

			      	<div class="row">
			      		<div class="input-field col s12">
							<input name="password" type="password" class="autocomplete validate {{ $errors->has('password') ? ' is-invalid' : '' }}" />
							<label for="password">{{ __('Password') }}</label>

			                @if ($errors->has('password'))
			                     <span class="helper-text" role="alert">
			                       {{ $errors->first('password') }}
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
			      		<div class="input-field col s12">
							<button type='submit' class="waves-effect waves-light btn-large orange">
								<i class="material-icons right">chevron_right</i> {{ __('Log In') }}</button>
						
					      	{{--@if (Route::has('password.request'))--}}
					  {{----}}
				                {{--<a class='waves-effect waves-light btn orange' href="{{ route('password.request') }}">--}}
				                    {{--{{ __('Forgot Password?') }}--}}
				                {{--</a>--}}
				        {{----}}
				            {{--@endif--}}
				        </div>
			      	</div>

				</form> 
			</div>


			<!-- REGISTER MODAL --> 
			<div id="register-modal" class="modal">

				<div class='right row no-margin-bottom'>
					<a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
				</div>

					    
				<form method="POST" action="{{ route('register') }}">
					@csrf
				
			    	<div class="row">
				        <div class="col s12">
			     			<h4 class="deep-purple-text text-darken-4">{{ __('Register') }}</h4>
			     		</div>
			     	</div>

			     	<div class="row">
						<div class="input-field col s5">
							<select id="role" name='role' class="validate {{ $errors->has('role') ? ' is-invalid' : '' }}" value="{{ old('role') }}">
								<!-- <option value='' disabled selected>Role</option> -->
								<option value="student">Student</option>
								<option value="teacher">Teacher</option>
								
							</select>
							<label for='role'>I'm a</label>
						</div>
				
				        <div class="input-field col s7">
							<input id="name" name='name' type="text" class="validate {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" />
							<label for="name">{{ __('Complete Name') }}</label>

					        @if ($errors->has('name'))
				                <span class="helper-text" role="alert">
			                       {{ $errors->first('name') }}
			                    </span>
				            @endif
				        </div>
				    </div>

			      	<div class="row">
				        <div class="input-field col s5">
							<input id="username" name='username' type="text" class="validate {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" />
							<label for="username">{{ __('Username') }}</label>

					        @if ($errors->has('username'))
				                <span class="helper-text" role="alert">
			                       {{ $errors->first('username') }}
			                    </span>
				            @endif
				        </div>
			      	
				        <div class="input-field col s7">
							<input id="email" name='email' type="email" class="validate {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" />
							<label for="email">{{ __('E-Mail Address') }}</label>

					        @if ($errors->has('email'))
				               <span class="helper-text" role="alert">
			                       {{ $errors->first('email') }}
			                    </span>
				            @endif
				        </div>
			      	</div>

			      	<div class="row">
			      		<div class="input-field col s5">
							<input id="password" name="password" type="password" class="validate {{ $errors->has('password') ? ' is-invalid' : '' }}" />
							<label for="password">{{ __('Password') }}</label>

			                @if ($errors->has('password'))
			                    <span class="helper-text" role="alert">
			                       {{ $errors->first('password') }}
			                    </span>
			                @endif
				        </div>
			      	
			      		<div class="input-field col s7">
							<input id="password_confirmation" name="password_confirmation" type="password"/>
							<label for="password_confirmation">Confirm Password</label>

							 @if ($errors->has('password_confirmation'))
				               <span class="helper-text" role="alert">
			                       {{ $errors->first('password_confirmation') }}
			                    </span>
				            @endif
				        </div>

			      	</div>


			      	<div class="row no-margin-bottom">
			      		<div class="input-field col s12">
							<button type='submit' class="aves-effect waves-light btn-large orange">
								<i class="material-icons right"></i>
								{{ __('Register') }}
							</button>
						
				        </div>
			      	</div>

				</form> 
			</div>



			<!-- LEVEL MODAL // not edited not final-->
			<div id="level-modal" class="modal">

				<div class='right row'>
					<a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
				</div>

					    
				<form method="POST" action="{{ route('register') }}">
					@csrf
				
			    	<div class="row">
				        <div class="col s12">
			     			<h4>{{ __('Register') }}</h4>
			     		</div>
			     	</div>

			     	<div class="row">
						<div class="input-field col s5">
							<select name='role' class="validate {{ $errors->has('role') ? ' is-invalid' : '' }}" value="{{ old('role') }}">
								<!-- <option value='' disabled selected>Role</option> -->
								<option value="student">Student</option>
								<option value="teacher">Teacher</option>
								
							</select>
							<label for='role'>{{ __('Role') }}</label>
						</div>
				
				        <div class="input-field col s7">
							<input name='name' type="text" class="validate {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" />
							<label for="name">{{ __('Complete Name') }}</label>

					        @if ($errors->has('name'))
				                <span class="helper-text" role="alert">
			                       {{ $errors->first('name') }}
			                    </span>
				            @endif
				        </div>
				    </div>

			      	<div class="row">
				        <div class="input-field col s5">
							<input name='username' type="text" class="validate {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" />
							<label for="username">{{ __('Username') }}</label>

					        @if ($errors->has('username'))
				                <span class="helper-text" role="alert">
			                       {{ $errors->first('username') }}
			                    </span>
				            @endif
				        </div>
			      	
				        <div class="input-field col s7">
							<input name='email' type="email" class="validate {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" />
							<label for="email">{{ __('E-Mail Address') }}</label>

					        @if ($errors->has('email'))
				               <span class="helper-text" role="alert">
			                       {{ $errors->first('email') }}
			                    </span>
				            @endif
				        </div>
			      	</div>

			      	<div class="row">
			      		<div class="input-field col s5">
							<input name="password" type="password" class="validate {{ $errors->has('password') ? ' is-invalid' : '' }}" />
							<label for="password">{{ __('Password') }}</label>

			                @if ($errors->has('password'))
			                    <span class="helper-text" role="alert">
			                       {{ $errors->first('password') }}
			                    </span>
			                @endif
				        </div>
			      	
			      		<div class="input-field col s7">
							<input_confirmation" name="password_confirmation" type="password"/>
							<label for="password_confirmation">Confirm Password</label>

							 @if ($errors->has('password_confirmation'))
				               <span class="helper-text" role="alert">
			                       {{ $errors->first('password_confirmation') }}
			                    </span>
				            @endif
				        </div>

			      	</div>


			      	<div class="row">
			      		<div class="input-field col s12">
							<button type='submit' class="waves-effect waves-light btn light-blue">
								<i class="material-icons right"></i>
								{{ __('Register') }}
							</button>
						
				        </div>
			      	</div>

				</form> 
			</div>




			<!-- EDIT DISCUSSION MODAL-->
			<div id="edit-discussion-modal" class="modal">

				<div class='right row'>
					<a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
				</div>


				<form method="POST" action="{{ route('register') }}">
					@csrf

					<div class="row">
						<div class="col s12">
							<h4>{{ __('Edit Discussion Modal') }}</h4>
						</div>
					</div>


					<div class="row">
						<div class="input-field col s12">
							<button type='submit' class="waves-effect waves-light btn light-blue">
								<i class="material-icons right"></i>
								{{ __('Save Changes') }}
							</button>

						</div>
					</div>

				</form>
			</div>



			<!-- MODAL TEMPLATE-->
			<div id="modal-template" class="modal">

				<div class='right row'>
					<a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
				</div>


				<form method="POST" action="{{ route('register') }}">
					@csrf

					<div class="row">
						<div class="col s12">
							<h4>{{ __('Edit Discussion Modal') }}</h4>
						</div>
					</div>


					<div class="row">
						<div class="input-field col s12">
							<button type='submit' class="waves-effect waves-light btn light-blue">
								<i class="material-icons right"></i>
								{{ __('Save Changes') }}
							</button>

						</div>
					</div>

				</form>
			</div>


			{{--CLASS LIST--}}
			<div id="teacher-sections-modal" class="modal">
				<div class="row">
					<div class="modal-content">
						<h4></h4>
						<p></p>
					</div>
				</div>
			</div>


			{{--REMOVE STUDENT FOM CLASS--}}
			<div id="remove-student-modal" class="modal modal-small">
				<div class='right row'>
					<a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
				</div>
				<div class="modal-content">
					<form method="POST" action="" id="remove-student-modal-form">
						@csrf
						@method('delete')

						<div class="row">
							<div class="col s12">
								<h5 class="red-text">Remove A Student</h5>
								<br>
								<p id='remove-student-modal-question'></p>
							</div>
							<div class="col s12">
								<input type="hidden" id="remove-from-section" name="remove-from-section">
								<input type="hidden" id="remove-student" name="remove-student">
								<input type="hidden" id="remove-from-level" name="remove-from-level">
								<input type="hidden" id="remove-from-sectionName" name="remove-from-sectionName">
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<button type='submit' class="waves-effect waves-light btn grey" id="remove-student-modal-btn">
									<i class="material-icons left">delete</i>
									{{ __('Yes, Please') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>


            {{--EDIT STUDENT SETTINGS MODAL--}}
            <div id="edit-student-settings" class="modal modal-small">
                <div class="row">
                    <div class="modal-content">
                        <h5 class="green-text bold">Edit A Student's Settings</h5>
                        <br>
                        <p class="light" id="edit-student-settings-question"></p>
                        <br>

                        <form action="" method="POST" id="edit-student-settings-form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="input-group">
                                    <label for="edit-student-name" class="active light">Student's Correct Name</label>
                                    <input type="text" name="edit-student-name" id="edit-student-name" required>
                                    <input type="hidden" name="student-id" id="student-id">
                                </div>
                                <div class="input-group">
                                    <label for="edit-student-password" class="active light">Student's New Password</label>
                                    <input type="text" name="edit-student-password" id="edit-student-password">
                                </div>
                                <input type="hidden" name="edit-student-level" id="edit-student-level">
                                <input type="hidden" name="edit-student-section" id="edit-student-section">
                                <input type="hidden" name="edit-student-subject" id="edit-student-subject">
                            </div>

                            <button class="btn green lighten-2" style="margin-top:15px;" id="edit-student-settings-btn">
                                <i class="material-icons left">edit</i>
                                Apply Changes</button>
                        </form>
                    </div>
                </div>
            </div>


			{{--STUDENT MODAL--}}
            <div id="student-modal" class="modal modal-small">
                <div class="row">
                    <div class="modal-content">
                        <h5 class="green-text bold">Join a class</h5>
						<p class="light grey-text">Type the class code that your teacher gave.</p>
                        <form action="joinClass" method="POST">
                            @csrf
                            <input type="text" name="access_code" required>
                            <button class="btn green" style="margin-top:15px;">Join now</button>
                        </form>
                    </div>
                </div>
            </div>


            {{--STUDENT MODAL--}}
            {{--<div id="view-own-profile" class="modal modal-small">--}}
                {{--<div class="row">--}}
                    {{--<div class="modal-content">--}}
                        {{--<h5 class="green-text bold">Account Details</h5>--}}
                        {{--<form action="joinClass" method="POST">--}}
                            {{--@csrf--}}
                            {{--<input type="text" name="access_code" required>--}}
                            {{--<button class="btn orange" style="margin-top:15px;">Save Changes</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


			{{--ADMIN MODAL CONTAINER--}}
			<div id="report-status-modal" class="modal modal-small">
				<div class="row">
					<div class="modal-content">
						<p id="report-status-modal-question"></p>
							<form action="" method="GET" id="report-status-modal-form">
							    @csrf
                                {{--@method('put')--}}
								<input type="hidden" id="report-status-modal-chapter" name="chapter">
								<input type="hidden" id="report-status-modal-field" name="field">
							<button class="btn orange" style="margin-top:15px;" id="report-status-modal-form-btn">Yes, Please.</button>
							</form>
						</div>
				</div>
			</div>

			{{--ADMIN MODAL CONTAINER--}}
			<div id="admin-modal-container" class="modal">
				<div class="row">
					<div class="modal-content">
						<p id="admin-modal-container-question"class="light"></p>
					</div>
				</div>
			</div>


			{{--ADMIN MODAL CONTAINER SMALL--}}
			<div id="admin-modal-container-small" class="modal modal-small">
				<div class="row">
					<div class="modal-content">
						<p id="admin-modal-container-small-question"class="light"></p>
						<br>
						{{--@csrf--}}
						<input type="text" id="admin-modal-container-small-input" name="">
						<button class="btn" id="btn-admin-modal-container-small">Save</button>
					</div>
				</div>
			</div>

			{{--ADMIN ADD OR DELETE LEVEL OR SUBJECT --}}
			<div id="admin_addOrDeleteLevelOrSubject_modal" class="modal modal-small">
				<div class="row">
					<div class="modal-content">
						<p id="admin_addOrDeleteLevelOrSubject_question" class="light"></p>
						<br>
						{{--@csrf--}}
						<input id="admin_addOrDeleteLevelOrSubject_input" name="">
						<button class="btn" id="btn_admin_addOrDeleteLevelOrSubject">Submit</button>
					</div>
				</div>
			</div>







