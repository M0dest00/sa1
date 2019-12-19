@extends('admin.master')

@section('body')
  <section class="content-header">
    <h1>Create Tag Type</h1>
  </section>
  <section class="content">
    <form action="{{route('tagType.store')}}" method="post" class="col-md-10">
      {{csrf_field()}}
      <div class="form-group">
        <label>Tag Type Name</label>
        <input type="text" name="tagType" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </section>
@stop
