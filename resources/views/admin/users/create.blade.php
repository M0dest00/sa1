@extends('admin.master')
@section('body')

<section class="content-header">
  <h1>
    Create User
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        {!! Form::open(['route' => 'user.store', 'files' => true]) !!}


        <div class="box-body" style="width: 70%;">


          <div class="form-group">
            <label>Name</label>
            <input required class="form-control" type="text" name="name">
          </div>


          <div class="form-group">
            <label>Email</label>
            <input required class="form-control" type="email" name="email">
          </div>


          <div class="form-group">
            <label>Password</label>
            <input required class="form-control" type="password" name="password">
          </div>



          <div class="form-group">
            <label>Phone : </label>
            <input required class="form-control" type="number" name="phone" placeholder="(01)---------">
          </div>


          <div class="form-group">
            <label>Address</label>
            <input required class="form-control" type="text" name="address">
          </div>


          <div class="form-group">
            {!! Form::label('country_id','Nationality', ['class' => 'control-label']) !!}
            {!! Form::select('country_id',$countries,null, ['class' => 'form-control','required']) !!}
          </div>

          <div class="form-group">
            <label>Start Time </label>

            <div class='input-group date' id='datetimepicker1'>
              <input required type='datetime-local' class="form-control" name="start"/>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>

          <div class="form-group">
            <label>End Time </label>

            <div class='input-group date' id='datetimepicker2'>
              <input required type='datetime-local' class="form-control" name="end"/>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>


        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@stop
@section('page_scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({format: 'YYYY-MM-DD hh:mm:ss'});
    $('#datetimepicker2').datetimepicker({format: 'YYYY-MM-DD hh:mm:ss'});
  });
</script>

@endsection
