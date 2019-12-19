@extends('admin.master')
@section('body')

<style type="text/css">
  th{
    cursor: default;
  }
</style>
  <section class="content-header">
    <h1>
      All Exams
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
        <th># of Questions</th>
        <th>Result</th>
        <th>Result Needed to Pass</th>
        <th>Time</th>
        <th>Exam Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
            <tr>
              <td>{{$user->name}}</td>
              <td>{{count($user->questions)}}</td>
              <td>{{$user->result}}</td>
              <td>{{$user->pass_limit}}</td>
              <td>{{$user->questions->sum('time')}} Minutes</td>
                <td>

                  @if(count($user->questions) == 0)

                  <a href="{{route('exam.create')}}" class="btn btn-xs btn-success"> Assign <i class="fa fa-plus"></i></a>

                @else
                  <a href="{{route('exam.show',$user->id)}}" class="btn btn-xs btn-success">View</a>
                  {{-- <a href="{{route('exam.edit',$user->id)}}" class="btn btn-xs btn-primary">Edit</a> --}}
                  <a href="{{route('exam.delete',$user->id)}}" class="delete btn btn-xs btn-danger">Delete</a>

                  @endif
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
          "emptyTable": "There are no users!"
        }
  });
</script>
@stop
