@extends('app')

@section('title', t('auth.forgot.title'))

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{t('auth.forgot.heading')}}
					</div>
					<div class="panel-body">
						@include('_errors')
						<form class="form-horizontal" role="form" method="POST" action="{{url('auth/reset/send')}}">
							<input name="_token" value="{{csrf_token()}}" type="hidden"/>
							<div class="form-group{{error('email') ? ' has-error' : ''}}">
								<label for="email" class="col-md-4 control-label">
									{{t('models.user.email')}}
								</label>
								<div class="col-md-8">
									<input id="email" name="email" value="{{old('email')}}" type="email" class="form-control" required="required"/>
									@if (error('email'))
										<span class="help-block">
											<strong>{{error('email')}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-btn fa-envelope"></i> {{t('auth.forgot.submit')}}
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
