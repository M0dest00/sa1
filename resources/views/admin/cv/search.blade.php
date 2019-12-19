@extends('admin.master')
@section('body')
  <section class="content-header">
    <h1>Search For CVs</h1>
  </section>
  <section class="content">
    <form class="col-md-10" action="{{route('cv.search')}}" method="post">
      {{csrf_field()}}
        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="text" name="first_name" class="form-control" placeholder="First Name">
          </div>
          <div class="form-group col-md-6">
            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group">
          <label>Tags</label>
          <select class="select2 form-control"  name="tags[]" multiple="multiple">
            @foreach($tags as $tag)
              <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>City</label>
          <select class="select2 form-control" name="city">
            <option disabled selected>Choose City</option>
            @foreach($cities as $city)
              <option value="{{$city->id}}">{{$city->name}},{{$city->country->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Certificates</label>
          <select class="select2 form-control" name="certificates[]" multiple="multiple">
            @foreach ($certificates as $certificate)
              <option value="{{ $certificate->id }}">{{ $certificate->certificate }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Skills</label>
          <select class="select2 form-control" name="skills[]" multiple="multiple">
            @foreach($skills as $skill)
              <option value="{{$skill->id}}">{{$skill->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn-primary btn" >Search</button>
        </div>
      </div>
    </form>
    <table class="table table-bordered table-striped">

    </table>
  </section>
@stop
