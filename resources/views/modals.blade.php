			<!-- LOGIN MODAL --> 
			<div id="login-modal" class="modal">

				<div class='right row'>
					<a href="#!" class="modal-close waves-effect waves-light-blue btn-flat">&#9587</a>
				</div>

					    
				<form method="POST" action="{{ route('login') }}">
					@csrf
				
			    	<div class="row">
				        <div class="col s12">
			     			<h4>{{ __('Login') }}</h4>
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
							<button type='submit' class="waves-effect waves-light btn light-blue">
								<i class="material-icons right">cloud</i> {{ __('Login') }}</button>
						
					      	@if (Route::has('password.request'))
					  
				                <a class='waves-effect waves-light btn orange' href="{{ route('password.request') }}">
				                    {{ __('Forgot Password?') }}
				                </a>
				        
				            @endif
				        </div>
			      	</div>

				</form> 
			</div>


			<!-- REGISTER MODAL --> 
			<div id="register-modal" class="modal">

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
							<select id="role" name='role' class="validate {{ $errors->has('role') ? ' is-invalid' : '' }}" value="{{ old('role') }}">
								<!-- <option value='' disabled selected>Role</option> -->
								<option value="student">Student</option>
								<option value="teacher">Teacher</option>
								
							</select>
							<label for='role'>{{ __('Role') }}</label>
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




			{{--EDIT DISCUSSION MODAL--}}
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



			{{--MODAL TEMPLATE--}}
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

