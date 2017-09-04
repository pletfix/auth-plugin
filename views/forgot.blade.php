@extends('app')

@section('title', 'Password forgotten')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Reset Password
				</div>
				<div class="panel-body">
					@include('_errors')
					<form class="form-horizontal" role="form" method="POST" action="{{url('auth/reset/send')}}">
						<input name="_token" value="{{csrf_token()}}" type="hidden"/>
						<div class="form-group{{error('email') ? ' has-error' : ''}}">
							<label for="email" class="col-md-4 control-label">
								E-Mail Address
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
									<i class="fa fa-btn fa-envelope"></i> Send Reset Mail
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
