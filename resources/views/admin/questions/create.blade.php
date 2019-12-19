@extends('admin.master')
@section('body')

<section class="content-header">
  <h1>
    Create Question
  </h1>
</section>


<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        {!! Form::open(['route' => 'question.store', 'files' => true]) !!}


        <div class="box-body" style="width: 70%;">


          <div class="form-group">
            <label>Name</label>
            <input class="form-control" type="text" name="name" required>
          </div>
          <div class="form-group">
            <label>Time (Minutes)</label>
            <input class="form-control" type="number" name="time" required>
          </div>

          <div class="form-group">
            {!! Form::label('category_id','Category', ['class' => 'control-label']) !!}
            {!! Form::select('category_id',$categories,null, ['class' => 'form-control', 'required']) !!}
          </div>
          <div class="input_fields_wrap form-group">
            <button class="add_field_button" type="button">Add Correct Answer</button>
            <div><input type="text" name="correct_ans[]" required></div>
          </div>
          <div class="input_fields_wrap_2 form-group">
            <button class="add_field_button_2" type="button">Add Wrong Answer</button>
            <div><input type="text" name="answers[]" required></div>
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
<script type="text/javascript">
$(document).ready(function() {
  var wrapper = $(".input_fields_wrap"); //Fields wrapper
  var wrapper_2 = $(".input_fields_wrap_2"); //Fields wrapper
  var add_button = $(".add_field_button"); //Add button ID
  var add_button_2 = $(".add_field_button_2"); //Add button ID

  $(add_button).click(function(e) { //on add input button click
    e.preventDefault();
      $(wrapper).append('<div><input type="text" name="correct_ans[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
  });
  $(add_button_2).click(function(e) { //on add input button click
    e.preventDefault();
      $(wrapper_2).append('<div><input type="text" name="answers[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
  });

  $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove();
  });
  $(wrapper_2).on("click", ".remove_field", function(e) { //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove();
  });
});
</script>
@stop
