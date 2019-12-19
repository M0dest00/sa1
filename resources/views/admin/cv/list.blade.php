@extends('admin.master')

@section('body')
<section class="content-header">
  <a href="{{route('cv.search')}}" class="btn btn-warning btn-sm fa fa-arrow-left"> Back</a>
</section>
<section class="content">
  <h1>Results</h1>
  <table class="table table-bordered table-striped datatable">
    <thead>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Actions</th>
    </thead>
    <tbody>
      @foreach($CVs as $cv)
        <tr>
          <td>{{$cv->first_name}}</td>
          <td>{{$cv->last_name}}</td>
          <td>
            <a href="{{route('cv.show',['id' => $cv->id])}}" class="btn btn-success btn-sm fa fa-eye"> Show</a>
            <a href="{{route('cv.interview',['cv_id' => $cv->id])}}" class="btn btn-primary btn-sm fa"> Interview</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>
@stop
