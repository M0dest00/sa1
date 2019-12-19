@extends('admin.master')
@section('body')

<section class="content-header">
  <h1>
    Create Exam
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        {!! Form::open(['route' => 'exam.store', 'files' => true]) !!}


        <div class="box-body" style="width: 70%;">

          <div class="form-group">
            <label>Number of questions </label>
            <input required class="form-control" type="number" name="questions">
          </div>

          <div class="form-group">
            <label> Result to Pass (Minimum # of correct answers to pass)  </label>
            <input required class="form-control" type="number" name="pass_limit">
          </div>

          <div class="form-group">
            {!! Form::label('user_id','User', ['class' => 'control-label']) !!}
            {!! Form::select('user_id',$users,null, ['class' => 'form-control','required']) !!}
          </div>


          <div class="form-group">
            {!! Form::label('category_id','Category', ['class' => 'control-label']) !!}
            {!! Form::select('category_id',$categories,null, ['class' => 'form-control','required']) !!}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({format: 'YYYY-MM-DD hh:mm:ss'});
    $('#datetimepicker2').datetimepicker({format: 'YYYY-MM-DD hh:mm:ss'});
  });
</script> --}}

@endsection
