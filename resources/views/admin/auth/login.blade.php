@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">登录</div>
				<div class="panel-body">
					@if (count($errors)>0)
						<div class="alert alert-danger">

							<ul>

								@foreach ($errors->all() as $error)
                                	<li>{{ $error }}</li>
                                @endforeach

							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('admin/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">账号：</label>
							<div class="col-md-6">
								<input type="text" required   class="form-control" name="account" value="{{ old('account') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">密码：</label>
							<div class="col-md-6">
								<input type="password" required class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> 下次自动登录
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">登录</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">忘记密码?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
