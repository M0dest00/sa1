@extends('admin.master')
@section('body')

  <section class="content-header">
    <h1>
      Edit Role
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">

                  {!! Form::model($role, ['route' => ['role.update', $role->id], 'files' => true]) !!}
                  {{ method_field('PUT') }}

                    <div class="box-body" style="width: 70%;">

                      <div class="form-group">
                        <label>Name</label>
                        <input required class="form-control" type="text" name="name" value="{{ $role->name }}">
                      </div>

                      <div class="form-group">
                      <label>Permissions</label>
                      <select class="selectpicker form-control" multiple data-live-search="true" required name="permissions[]">
                        @foreach ($permissions as $permission)
                          <option name="permissions[]" {{ $role->hasPermissionTo($permission) ? 'selected' : '' }}>{{$permission}}</option>
                        @endforeach
                      </select>
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
@section('page_scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />


@endsection
