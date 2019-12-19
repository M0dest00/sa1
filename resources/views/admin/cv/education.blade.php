@extends('admin.master')
@section('body')
<section class="content-header">
  <a href="{!! route('cv.edit',['id' => $cv->id]) !!}" class="btn btn-warning btn-sm fa fa-arrow-left"> Back</a>
</section>
<section class="content">
  <form class="col-md-12" action="{!! route('cv.add.education',['id' => $cv->id]) !!}" method="post">
    {{csrf_field()}}
    @if ($cvEducations->count()>0)
      <h2>Education History</h2>
      @foreach ($cvEducations as $education)
        <div class="form-row col-md-12">
          <div class="form-group col-md-4">
            <input type="text" name="updatedEducationInstitution[]" class="form-control"  value="{{ $education->education_institution }}">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="updatedFrom[]" class="form-control datepicker" value="{{ $education->from }}">
          </div>
          <div class="form-group col-md-2">
            <input type="text" name="updatedTo[]" class="form-control future-datepicker" value="{{ $education->to }}">
          </div>
        </div>
        <div class="form-row col-md-12">
          <div class="form-group col-md-8">
            <input type="text" name="updatedDescription[]" class="form-control" value="{{ $education->description }}">
          </div>

          <div class="form-group col-md-2">
            <a href="{!! route('cv.delete.education',['id' => $education->id]) !!}" class="btn btn-danger btn-sm delete fa">Remove From History</a>
          </div>
        </div>
      @endforeach
    @endif
    <div class="educationContainer">
      <label class="col-md-12">Add new Education History</label>
      <div class="form-row col-md-12">
        <div class="form-group col-md-4">
          <input type="text" name="education_institution[]" class="form-control" placeholder="*Education Institution">
        </div>
        <div class="form-group col-md-2">
          <input type="text" name="from[]" class="form-control datepicker" placeholder="*From">
        </div>
        <div class="form-group col-md-2">
          <input type="text" name="to[]" class="form-control future-datepicker" placeholder="*To">
        </div>
      </div>
      <div class="form-row col-md-12">
        <div class="form-group col-md-8">
          <input type="text" name="description[]" class="form-control" placeholder="*Description">
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-3">

      </div>
      <div class="form-group col-md-4">
        <button type="button" class="btn btn-success fa" id="addEducationBtn">Add another Education History</button>
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
      $('#addEducationBtn').on('click',function(){
        $(".educationContainer").append(`
          <label class="col-md-12">Add new Education History</label>
          <div class="form-row col-md-12">
            <div class="form-group col-md-4">
              <input type="text" name="education_institution[]" class="form-control" placeholder="*Education Institution">
            </div>
            <div class="form-group col-md-2">
              <input type="text" name="from[]" class="form-control datepicker" placeholder="*From">
            </div>
            <div class="form-group col-md-2">
              <input type="text" name="to[]" class="form-control future-datepicker" placeholder="*To">
            </div>
          </div>
          <div class="form-row col-md-12">
            <div class="form-group col-md-8">
              <input type="text" name="description[]" class="form-control" placeholder="*Description">
            </div>
          </div>
          `);
      });
    });
  </script>
@endsection
