@extends('admin.master')
@section('body')

  <sectio class="content-header">
    <h1>Request from {{$company->user->name}}</h1>
  </sectio>

  <section class="content">

    @foreach ($requests as $index => $request)
      <p>Tag #{{ $index }} {{ $request->tag->name }}</p>
    @endforeach
  </section>

@stop
