@extends('admin.master')

@section('body')
  <section class="content-header">
    <a href="{!! route('cv.edit',['id' => $cv->id]) !!}" class="btn btn-warning btn-sm fa fa-arrow-left"> Back</a>
  </section>

  <section class="content">
    <form class="col-md-10" action="{!! route('cv.add.certificates',['id' => $cv->id]) !!}" method="post">
      {{csrf_field()}}
      @if ($cvCertificates->count()>0)
        <h2>Certificates</h2>
        @foreach ($cvCertificates as $cvCertificate)
          <div class="form-row col-md-12">
            <div class="form-group col-md-3">
              <select class="form-control select2 " name="updatedCertificate[]">
                @foreach ($certificates as $certificate)
                  @if ($cvCertificate->certificate_id == $certificate->id)
                    <option selected value="{{ $certificate->id }}">{{ $certificate->certificate }}</option>
                  @else
                    <option value="{{ $certificate->id }}">{{ $certificate->certificate }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="col-md-7 form-group">
              <input type="text" name="updatedDescription[]" value="{{ $cvCertificate->description }}" class="form-control">
            </div>
            <div class="form-group col-md-2">
              <a href="{!! route('cv.delete.certificate',['id' => $cvCertificate->id]) !!}" class="btn-danger btn-sm btn delete fa">Remove</a>
            </div>
          </div>
        @endforeach
      @endif
      <div class="certificate-container">
        <label class="col-md-12">Add Certificate</label>
        <div class="form-row col-md-12">
          <div class="form-group col-md-3">
            <select class="form-control select2" name="certificate[]">
              <option disabled selected>Certificate Name</option>
              @foreach ($certificates as $certificate)
                <option value="{{ $certificate->id }}">{{ $certificate->certificate }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-7">
            <input type="text" name="description[]" class="form-control" placeholder="Description" >
          </div>
          <div class="form-group col-md-2">
            <button type="button" class="btn btn-success fa " id="new-certificate-btn">Add Another Certificate</button>
          </div>
        </div>
      </div>
      <div class="form-group col-md-12">
        <button type="submit" class="btn-primary btn">Submit</button>
      </div>
    </form>
  </section>
@stop
@section('page_scripts')
  <script>
    $(document).ready(function(){
      $("#new-certificate-btn").on('click',function(){
        $('.certificate-container').append(`
          <div class="form-row col-md-12">
            <div class="form-group col-md-3">
              <select class="form-control select2" name="certificates[]">
                <option disabled selected>Certificate Name</option>
                @foreach ($certificates as $certificate)
                  <option value="{{ $certificate->id }}">{{ $certificate->certificate }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="text" name="description[]" class="form-control" placeholder="Description" >
            </div>
          </div>
          `);
          setTimeout(function(){
            $('.select2').select2();
          },100);
      });
    });
  </script>
@endsection
