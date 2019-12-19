@extends('admin.master')

@section('body')
  <section class="content-header">
    <h1>Add Language</h1>
  </section>
  <section class="content">
    <form class="col-md-8" action="{{route('lang.store')}}" method="post">
      {{csrf_field()}}
      <div class="form-group">
        <label>Language Name</label>
        <input type="text" name="language" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </section>
@stop
