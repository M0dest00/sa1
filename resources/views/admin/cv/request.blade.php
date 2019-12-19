@extends('admin.master')
@section('body')
  <section class="content-header">
    <h1>Request Employee</h1>
  </section>

  <section class="content">
    <form class="col-md-10" action="{!! route('request.store') !!}" method="post">
      {{csrf_field()}}
      <div class="form-group">
        <label>Select Employee Tags</label>
        <select class="select2 form-control" multiple="multiple" name="tags[]">
          @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </section>
@stop
