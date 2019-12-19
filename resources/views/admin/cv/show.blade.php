@extends('admin.master')
@section('body')

  <sectio class="content-header">
    <h1>CV</h1>
  </sectio>

  <section class="content">
    <img src="{{asset($cv->picture_path())}}" alt="" width="200" height="200">
    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td>Full Name : {{$cv->full_name}}</td>
        </tr>
        <tr>
          <td>Age : {{$cv->age}} years</td>

        </tr>
        <tr>
          <td>Nationality : {{$cv->country->nationality}}</td>
        </tr>
        <tr>
          <td>Address : {{$cv->address}}/{{$cv->city->name}},{{$cv->country->name}}</td>
        </tr>
        @foreach($cv_tags as $tag)
        <tr>
          <td>Skills : {{$tag->tag->name}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </section>

@stop
