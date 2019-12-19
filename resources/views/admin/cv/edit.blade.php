@extends('admin.master')
@section('body')
  <section class="content-header">
    <h1>Add to/Edit CV</h1>
  </section>

  <section class="content">
    @if ($cv)
      <form class="col-md-8" action="{{route('cv.update',['id' => $cv->id])}}" method="post" >
        {{ csrf_field() }}
        <div class="form-group">
          <input type="file" name="picture" >
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>First Name</label>
            <input type="text" class="form-control" name="first_name"  placeholder="{{$cv->first_name}}" value="{{$cv->first_name}}">
          </div>
          <div class="form-group col-md-6">
            <label>Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="{{$cv->last_name}}" value="{{$cv->last_name}}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>City</label>
            <select class="form-control select2" id="citySelect"style="width:100%;" name="city">
              @foreach($cities as $city)
                @if($city->name == $cv->city->name)
                  <option selected value="{{$city->id}}">{{$cv->city->name}},{{$cv->country->name}}</option>
                @else
                  <option value="{{$city->id}}">{{$city->name}},{{$city->country->name}}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" id="addressInput" placeholder="{{$cv->address}}" value="{{$cv->address}}" name="address">
          </div>
        </div>
        <div class="form-group">
          @if($cv->travel_availablity)
            <input type="checkbox" name="travel_availablity" class="form-check-input checker" checked="checked" value="1">
          @endif
          @if(!$cv->travel_availablity)
            <input type="checkbox" name="travel_availablity" class="form-check-input checker" value="1">
          @endif
          <label>Available for Traveling</label>
        </div>
        <div class="form-group">
          @if($cv->driving_license_availablity)
            <input type="checkbox" name="driving_license_availablity" checked="checked" class="form-check-input checker" value="1">
          @endif
          @if(!$cv->driving_license_availablity)
            <input type="checkbox" name="driving_license_availablity" class="form-check-input checker" value="1">
          @endif
          <label>Having a Driving License</label>
        </div>
        <div class="form-group">
          @if($cv->smoker)
            <input type="checkbox" name="smoker" checked="checked" class="form-check-input checker" value="1">
          @endif
          @if(!$cv->smoker)
            <input type="checkbox" name="smoker" class="form-check-input checker" value="1">
          @endif
          <label>Smoker</label>
        </div>

        <div class="form-group col-md-12">
          <br>
          <button type="submit" class="btn btn-primary">Submit Edits</button>
        </div>
      </form>
      <ul class="list-group col-md-4">
        <li class="list-group-item ">
          <a href="{{route('cv.add.tags',['id' => $cv->id])}}" class="btn fa  ">Add/Edit Tags</a>
        </li>
        <li class=" list-group-item" >
          <a href="{{route('cv.add.skills',['id' => $cv->id])}}" class="btn fa ">Add/Edit Skills</a>
        </li>
        <li class=" list-group-item" >
          <a href="{{route('cv.add.langs',['id' => $cv->id])}}" class="btn fa "  >Add/Edit Languages</a>
        </li>
        <li class=" list-group-item" >
          <a  href="{{route('cv.add.certificates',['id' => $cv->id])}}" class="btn fa">Add/Edit Certificates</a>
        </li>
        <li class=" list-group-item" >
          <a href="{{route('cv.add.contact',['id' => $cv->id])}}" class="btn fa ">Add/Edit Contact Info</a>
        </li>
        <li class=" list-group-item" >
          <a href="{{route('cv.add.work',['id' => $cv->id])}}" class="btn fa ">Add/Edit Work History</a>
        </li>
        <li class=" list-group-item" >
          <a href="{{route('cv.add.education',['id' => $cv->id])}}" class="btn fa ">Add/Edit Education History</a>
        </li>
      </ul>
    @else
      <h2>No CV yet for this account</h2>
    @endif


  </section>
@stop
