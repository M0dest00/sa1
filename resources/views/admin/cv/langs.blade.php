@extends('admin.master')

@section('body')
  <section class="content-header">
    <a href="{!! route('cv.edit',['id' => $cv->id]) !!}" class="btn btn-warning btn-sm fa fa-arrow-left"> Back</a>
  </section>

  <section class="content">
    <form  class="col-md-8"action="{{route('cv.add.langs',['id' => $cv->id])}}" method="post">
      {{csrf_field()}}
      <h2>Add/Edit Languages to CV</h2>
      <table class="table table-bordered table-striped">
        <thead>
          <th>Language</th>
          <th>Description</th>
        </thead>
        <tbody class="languages-container">
          @if($Cvlanguages->count()>0)
            @foreach($Cvlanguages as $Cvlanguage)
              <tr>
                <td>
                  <input type="hidden" name="CvLangsId[]" value="{{$Cvlanguage->id}}">
                  <div class="form-group ">
                    <select class="form-control select2" name="updatedLangs[]" style="width:250px;">
                      <option disabled selected > Select Language</option>
                      @foreach($languages as $language)
                        @if($language->id == $Cvlanguage->language_id)
                          <option selected value="{{$language->id}}">{{$language->language}}</option>
                        @else
                          <option value="{{$language->id}}">{{$language->language}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group ">
                    <input type="text" name="updatedDescription[]" value="{{$Cvlanguage->description}}" class="form-control " required>
                  </div>
                </td>
                <td>
                  <a href="{{route('cv.remove.lang',['id' => $Cvlanguage->id])}}" class="btn btn-xs btn-danger delete">Remove</a>
                </td>
              </tr>
            @endforeach
          @endif
          @if($Cvlanguages->count()==0)
          <tr>
            <td>
              <div class="form-group ">
                <select class="form-control select2 lang_select" name="languages[]" style="width:250px;">
                  <option disabled selected > Select Language</option>
                  @foreach($languages as $language)
                  <option value="{{$language->id}}">{{$language->language}}</option>
                  @endforeach
                </select>
              </div>
            </td>
            <td>
              <div class="form-group ">
                <input type="text" name="description[]" class="form-control description_input" disabled required placeholder="Descripe your Fluency">
              </div>
            </td>
          @endif
          <td>
            <button type="button" class="btn btn-success" id="new_lang_btn">Add another Language</button>
          </td>
          </tr>
        </tbody>
      </table>
      <div class="for-group col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </section>
@stop
@section('page_scripts')
  <script>
    $(document).ready(function(){
      $("#new_lang_btn").on('click',function(){
        $(".languages-container").append(`
          <tr>
            <td>
              <div class="form-group">
                <select class="form-control select2 lang_select" name="languages[]" style="width:250px;">
                  <option disabled selected > Select Language</option>
                  @foreach($languages as $language)
                  <option value="{{$language->id}}">{{$language->language}}</option>
                  @endforeach
                </select>
              </div>
            </td>
            <td>
              <div class="form-group ">
                <input type="text" name="description[]" class="form-control description_input" disabled required placeholder="Descripe your Fluency">
              </div>
            </td>
          </tr>`);
          setTimeout(function(){$(".select2").select2()},100);
          setTimeout(function(){$(".lang_select").change(function(){
            $(".description_input").prop('disabled',false);
          })},100);
      });
      $(".lang_select").change(function(){
        $(".description_input").prop('disabled',false);
      });
    });

  </script>
@stop
