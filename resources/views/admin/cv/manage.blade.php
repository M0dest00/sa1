@extends('admin.master')
@section('body')
  <section class="content-header">
    <h1>Manage CV</h1>
  </section>

  <section class="content">
    <table class="table table-bordered table-striped datatable">
      <thead>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach($cvCollection as $cv)
          <tr>
            <td>{{$cv->first_name}}</td>
            <td>{{$cv->last_name}}</td>
            <td>
              {{-- <a href="{{ route('cv.edit',['id' => $cv->id])}}" ><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add/Edit Data</button></a> --}}
              <form  action="" method="post" class="form-group" id="delete_form">
                <button type="button" name="button" class="btn btn-danger btn-sm delete">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>
@stop
