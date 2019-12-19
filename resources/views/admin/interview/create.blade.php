@extends('admin.master')
@section('body')
  <section class="content-header">
    <h1>Set Interview Time For {{ $cv->full_name }}</h1>
  </section>
  <section class="content">
    <form class="col-md-10" action="{!! route('cv.interview',['cv_id' => $cv->id]) !!}" method="post">
      {{ csrf_field() }}
      <div class="form-row">
        <div class="form-group col-md-8">
          <input type="text" class="form-control" name="interviewer" required placeholder="interviewer">
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="datetimepicker form-control" name="from" required placeholder="From">
        </div>
      </div>
      <div class="form-row ">
        <div class="form-group col-md-8">
          <select class="select2 form-control" name="supervisor">
            <option selected disabled>Supervisor</option>
            {{-- @foreach ($admins as $admin)
            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
            @endforeach --}}
          </select>
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="datetimepicker form-control" required placeholder="To" name="to" >
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </section>
@endsection
