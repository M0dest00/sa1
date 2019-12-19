@extends('admin.master')
@section('body')

<style type="text/css">
  th{
    cursor: default;
  }
</style>
  <section class="content-header">
    <h1>
      All Users
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
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
            <tr>
              <td>{{$user->name}}</td>
                <td>
                  <a href="{{route('user.edit',$user->id)}}" class="btn btn-xs btn-primary">Edit</a>
                  <a href="{{route('user.delete',$user->id)}}" class="delete btn btn-xs btn-danger">Delete</a>
                  {{-- <a href="{{route('user.questions.assign',$user->id)}}" class="btn btn-xs btn-success">Questions <i class="fa fa-plus"></i>  --}}
                  {{-- @if($user->exam == 1)
                  <span class="glyphicon glyphicon-ok"></span>
                  @endif
                </a> --}}
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
