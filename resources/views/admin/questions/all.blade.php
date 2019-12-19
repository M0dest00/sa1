@extends('admin.master')
@section('body')

<style type="text/css">
  th{
    cursor: default;
  }
</style>
  <section class="content-header">
    <h1>
      All Questions
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
  <table class="table table-bordered table-striped" style="width: 73%;" id="myTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Time</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($questions as $question)
            <tr>
              <td>{{$question->name}}</td>
              <td>{{$question->category->name}}</td>
              <td>{{$question->time}}  Minutes</td>
                <td>
                  <a href="{{route('question.edit',$question->id)}}" class="btn btn-xs btn-primary">Edit</a>
                  <a href="{{route('question.delete',$question->id)}}" class="delete btn btn-xs btn-danger">Delete</a>
               </td>
            </tr>

      @endforeach
    </tbody>
  </table>
</div>
      </div>
    </div>
  </section>
@stop

@section('page_scripts')
<script type="text/javascript">
  $('#myTable').DataTable({
     "ordering": false,
    "bLengthChange": false,
    "bInfo": false,
    "language": {
          "emptyTable": "There are no Questions!"
        }
  });
</script>
@stop
