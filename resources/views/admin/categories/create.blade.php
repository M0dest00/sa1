@extends('admin.master')
@section('body')

  <section class="content-header">
    <h1>
      Create Category
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">

                  {!! Form::open(['route' => 'category.store', 'files' => true]) !!}


                    <div class="box-body" style="width: 70%;">


                      <div class="form-group">
                        <label>Name</label>
                        <input  class="form-control"  type="text" name="name" required value="{{ old('name') }}">
                      </div>


                      <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required  >{{ old('description') }}</textarea>
                      </div>







                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  {!! Form::close() !!}
                </div>
      </div>
    </div>
  </section>
@stop
