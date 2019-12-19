@extends('admin.master')

@section('body')
  <section class="content-header">
    <h1>Create Skill</h1>
  </section>
  <section class="content">
    <form class="col-md-10" action="{{route('skill.store')}}" method="post">
      {{csrf_field()}}
      <div class="form-group">
        <label>*Skill Name</label>
        <input type="text" name="skill" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn-primary btn">Submit</button>
      </div>
    </form>
  </section>
@stop
