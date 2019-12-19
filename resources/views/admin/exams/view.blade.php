@extends('admin.master')
@section('body')

<style type="text/css">
  th{
    cursor: default;
  }
</style>
  <section class="content-header">
    <h1>
      Exam Questions
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"> Result : {{$user->result}} / {{ $user->questions->count() }}</h3>
    </div><!-- /.box-header -->
  <table class="table table-bordered table-striped" style="width: 73%;" id="myTable">
    <thead>
      <tr>
        <th>Question</th>
        <th>Time</th>
        <th>Answers</th>
        <th>Correct Answers</th>
        <th>User's Answers</th>
      </tr>
    </thead>
    <tbody>
      @foreach($questions as $question)
            <tr>
              <td>{{$question->name}}</td>
              <td>{{$question->time}} Minutes</td>
              <td>
                <ul>
                  @foreach ($question->answers as $answer)
                    <li>{{ $answer->answer }}</li>
                  @endforeach
                </ul>
              </td>
              <td>
                <ul>
                  @foreach ($question->answers->where('correct',1) as $answer)
                    <li>{{ $answer->answer }}</li>
                  @endforeach
                </ul>
              </td>
              <td>
                <ul>
                  @foreach ($user->answers->where('question_id',$question->id) as $answer)
                    <li>{{ $answer->answer }}</li>
                  @endforeach
                </ul>
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
