@extends('app')

@section('title', 'Change Password')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Change Password
				</div>
				<div class="panel-body">
					@include('_errors')
					<form class="form-horizontal" role="form" method="POST" action="{{url('auth/password')}}">
						<input name="_token" value="{{csrf_token()}}" type="hidden"/>
						<div class="form-group{{error('old_password') ? ' has-error' : ''}}">
							<label for="old_password" class="col-md-4 control-label">
								Current Password
							</label>
							<div class="col-md-8">
								<input id="old_password" name="old_password" type="password" class="form-control" required="required" autofocus="autofocus"/>
								@if(error('old_password'))
									<span class="help-block">
                                        <strong>{{error('old_password')}}</strong>
                                    </span>
								@endif
							</div>
						</div>
						<div class="form-group{{error('password') ? ' has-error' : ''}}">
							<label for="password" class="col-md-4 control-label">
								New Password
							</label>
							<div class="col-md-8">
								<input id="password" name="password" type="password" class="form-control" required="required"/>
								@if(error('password'))
									<span class="help-block">
                                        <strong>{{error('password')}}</strong>
                                    </span>
								@endif
							</div>
						</div>
						<div class="form-group{{error('password_confirmation') ? ' has-error' : ''}}">
							<label for="password_confirmation" class="col-md-4 control-label">
								Confirm Password
							</label>
							<div class="col-md-8">
								<input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required="required"/>
								@if(error('password_confirmation'))
									<span class="help-block">
                                        <strong>{{error('password_confirmation')}}</strong>
                                    </span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Change Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
