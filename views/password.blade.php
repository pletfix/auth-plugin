@extends('app')

@section('title', t('auth.password.title'))

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{t('auth.password.heading')}}
					</div>
					<div class="panel-body">
						@include('_errors')
						<form class="form-horizontal" role="form" method="POST" action="{{url('auth/password')}}">
							<input name="_token" value="{{csrf_token()}}" type="hidden"/>
							<div class="form-group{{error('old_password') ? ' has-error' : ''}}">
								<label for="old_password" class="col-md-4 control-label">
									{{t('auth.password.current_password')}}
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
									{{t('auth.password.new_password')}}
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
									{{t('auth.password.confirm_password')}}
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
										{{t('auth.password.submit')}}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
