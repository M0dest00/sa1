@extends('admin.master')
@section('body')

<style type="text/css">
  th{
    cursor: default;
  }
</style>
  <section class="content-header">
    <h1>
      Role Details
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"> {{$role->name}}</h3>
    </div><!-- /.box-header -->
  <table class="table table-bordered table-striped" style="width: 73%;" id="myTable">
    <thead>
      <tr>
        <th>Permissions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permissions as $permission)
            <tr>
              <td>{{$permission->name}}</td>
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
          "emptyTable": "There are no permissions!"
        }
  });
</script>
@stop
