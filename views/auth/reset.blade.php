@extends('app')

@section('title', 'Reset Password')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Reset Password
				</div>
				<div class="panel-body">
					@include('_errors')
					<form class="form-horizontal" role="form" method="POST" action="{{url('auth/reset')}}">
						<input name="_token" value="{{csrf_token()}}" type="hidden"/>
						<input name="token" value="{{$token}}" type="hidden"/>
						<div class="form-group{{error('email') ? ' has-error' : ''}}">
							<label for="email" class="col-md-4 control-label">
								E-Mail Address
							</label>
							<div class="col-md-8">
								<input id="email" name="email" value="{{$email or old('email')}}" type="email" class="form-control" required="required"/>
								@if(error('email'))
									<span class="help-block">
                                        <strong>{{error('email')}}</strong>
                                    </span>
								@endif
							</div>
						</div>
						<div class="form-group{{error('password') ? ' has-error' : ''}}">
							<label for="password" class="col-md-4 control-label">
								Password
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
							<label for="password-confirm" class="col-md-4 control-label">
								Confirm Password
							</label>
							<div class="col-md-8">
								<input id="password-confirm" name="password_confirmation" type="password" class="form-control" required="required"/>
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
									<i class="fa fa-btn fa-refresh"></i> Kennwort zurücksetzen
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
