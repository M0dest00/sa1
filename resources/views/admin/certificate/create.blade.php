@extends('admin.master')

@section('body')
  <section class="content-header">
    <h1>Create Certificate</h1>
  </section>
  <section class="content">
    <form class="col-md-10" action="{!! route('certificate.create') !!}" method="post">
      {{csrf_field()}}
      <label>*Certificate Name</label>
      <div class="form-group">
        <input type="text" name="certificate" class="form-control">
      </div>
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </section>

@endsection
