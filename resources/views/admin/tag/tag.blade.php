@extends('admin.master')

@section('body')
  <section class="content-header">
    <h1>Create Tag</h1>
  </section>
  <section class="content">
    <form class="col-md-10" action="{{route('tag.store')}}" method="post">
      {{csrf_field()}}
      <div class="form-group col-md-7">
        <label>Tag Type</label>
        <select class="select2 form-control" name="tagType">
          <option disabled selected>Select Tag Type</option>
          @foreach($tagTypes as $tagType)
            <option value="{{$tagType->id}}">{{$tagType->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-7">
        <label class="col-md-12">Tag</label>
        <input type="text" name="tag" class="form-control" required>
      </div>
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </section>
@stop
