@include('admin.header')
@include('errors')
@include('message')

<div class="login-box">
  <div class="login-box-body">
    <p class="login-box-msg">Itshield Bank</p>
    {!! Form::open(['route' => 'admin.login.post']) !!}
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
      </div>
    {!! Form::close() !!}
  </div>
</div>

@include('admin.footer')

