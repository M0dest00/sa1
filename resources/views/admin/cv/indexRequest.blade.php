@extends('admin.master')

@section('body')
<section class="content-header">
  <h1>ALL Requests</h1>
</section>
<section class="content">
  <h1>Results</h1>
  <table class="table table-bordered table-striped datatable">
    <thead>
      <th>First Name</th>
      <th>Actions</th>
    </thead>
    <tbody>
      @foreach($requests as $request)
        <tr>
          <td>{{$request->user->name}}</td>
          <td>
            <a href="{!! route('request.show',$request->user->id) !!}" class="btn btn-success btn-sm">Show</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>
@stop
