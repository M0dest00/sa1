@extends('admin.master')

@section('body')
  <section class="content">
    {!! Form::open(['route' => 'test', 'files' => true]) !!}
      <div class="form-group"> {{ Form::label('Picture') }} {!! Form::file('picture') !!} </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
  </section>
@endsection
