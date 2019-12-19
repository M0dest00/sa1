@extends('admin.master')
@section('body')
<section class="content-header">
  <a href="{!! route('cv.edit',['id' => $cv->id]) !!}" class="btn btn-warning btn-sm fa fa-arrow-left"> Back</a>
</section>
<section class="content">
  <form class="col-md-12" action="{!! route('cv.add.work',['id' => $cv->id]) !!}" method="post">
    {{csrf_field()}}
    @if ($cvWorks->count()>0)
      <h2>Work History</h2>
      @foreach ($cvWorks as $work)
        <div class="form-row col-md-12">
          <div class="form-group col-md-4">
            <input type="text" name="updatedCompanyName[]" class="form-control"  value="{{ $work->company_name }}">
          </div>
          <div class="form-group col-md-4">
            <input type="text" name="updatedJobTitle[]" class="form-control"  value="{{ $work->job_title }}">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="updatedFrom[]" class="form-control datepicker" value="{{ $work->from }}">
          </div>
        </div>
        <div class="form-row col-md-12">
          <div class="form-group col-md-8">
            <input type="text" name="updatedDescription[]" class="form-control" value="{{ $work->description }}">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="updatedTo[]" class="form-control datepicker" value="{{ $work->to }}">
          </div>
          <div class="form-group col-md-2">
            <a href="{!! route('cv.delete.work',['id' => $work->id]) !!}" class="btn btn-danger btn-sm delete fa">Remove From History</a>
          </div>
        </div>
      @endforeach
    @endif
    <div class="workContainer">
      <label class="col-md-12">Add new Work History</label>
      <div class="form-row col-md-12">
        <div class="form-group col-md-4">
          <input type="text" name="company_name[]" class="form-control" placeholder="*Company Name">
        </div>
        <div class="form-group col-md-4">
          <input type="text" name="job_title[]" class="form-control" placeholder="*Job Title">
        </div>
        <div class="form-group col-md-2">
          <input type="text" name="from[]" class="form-control datepicker" placeholder="*From">
        </div>
      </div>
      <div class="form-row col-md-12">
        <div class="form-group col-md-8">
          <input type="text" name="description[]" placeholder="*Description" class="form-control">
        </div>
        <div class="form-group col-md-2">
          <input type="text" name="to[]" class="form-control datepicker" placeholder="*To">
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-4">

      </div>
      <div class="form-group col-md-4">
        <button type="button" class="btn btn-success fa" id="addWorkBtn">Add another Work History</button>
      </div>
    </div>
    <div class="form-group col-md-12">
      <button type="submit" class="btn btn-primary ">Submit</button>
    </div>
  </form>
</section>
@endsection
@section('page_scripts')
  <script>
    $(document).ready(function(){
      $('#addWorkBtn').on('click',function(){
        $(".workContainer").append(`
          <label class="col-md-12">Add new Work History</label>
          <div class="form-row col-md-12">
            <div class="form-group col-md-4">
              <input type="text" name="company_name[]" class="form-control" placeholder="*Company Name">
            </div>
            <div class="form-group col-md-4">
              <input type="text" name="job_title[]" class="form-control" placeholder="*Job Title">
            </div>
            <div class="form-group col-md-2">
              <input type="text" name="from[]" class="form-control datepicker" placeholder="*From">
            </div>
          </div>
          <div class="form-row col-md-12">
            <div class="form-group col-md-8">
              <input type="text" name="description[]" placeholder="*Description" class="form-control">
            </div>
            <div class="form-group col-md-2">
              <input type="text" name="to[]" class="form-control datepicker" placeholder="*To">
            </div>
          </div>
          `);
      });
    });
  </script>
@endsection
