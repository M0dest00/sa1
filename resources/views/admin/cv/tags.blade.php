@extends('admin.master')

@section('body')
  <section class="content-header">
    <a href="{!! route('cv.edit',['id' => $cv->id]) !!}" class="btn btn-warning btn-sm fa fa-arrow-left"> Back</a>
  </section>
  <section class="content">
    <h2>Manage Tags</h2>
    <form class="col-md-10" action="{{route('cv.add.tags',['id' => $cv->id])}}" method="post">
      {{csrf_field()}}
      @if($cvTags->count()!=0)
        <div class="form-group col-md-10">
          <label>CV Tags</label>
          <select class="form-control select2" name="updatedTags[]" multiple="multiple">
            @foreach($cvTags as $cvTag)
              <option selected value="{{$cvTag->tag->id}}">{{$cvTag->tag->name}}</option>
            @endforeach
          </select>
        </div>
      @endif
      <div class="form-group col-md-12">
        <label>Add New Tag</label>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <select class="form-control select2 tag_types_container">
            <option disabled selected>Choose Tag Type</option>
            @foreach($tagTypes as $tagType)
              <option value="{{$tagType->id}}">{{$tagType->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-2 add_tag_btn" hidden>
          <button type="button" class="btn btn-success" id="addTagBtn" >Add Tags</button>
        </div>
      </div>
      <div class="col-md-10 tags_selector_container">


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
      var tagTypesId = [];
      $(".tag_types_container").change(function(){
        var tageTypeId = $(".tag_types_container").children("option:selected").attr('value');
        if(!tagTypesId.includes(tageTypeId)){
          $(".add_tag_btn").show();
        }
      });
      $("#addTagBtn").on('click',function(){
        $(".add_tag_btn").hide();
        var tageTypeId = $(".tag_types_container").children("option:selected").attr('value');
        var tagTypeName = $(".tag_types_container").children("option:selected").html();
        if(!tagTypesId.includes(tageTypeId)){
          $(".tags_selector_container").append(`
            <div class="form-group">
              <label>${tagTypeName}</label>
              <select class="form-control select2" id="tags_container`+tageTypeId+`" name="tags[]" multiple="multiple">
              </select>
            </div>
          `);
          var routeUrl = "{{route('tagType.tags',':id')}}";
          url = routeUrl.replace(':id',tageTypeId);
          setTimeout(function(){
            $.ajax({
              url:url,
              success: data => {
                data.tags.forEach(
                  tag => $("#tags_container"+tageTypeId).append(`<option value="${tag.id}">${tag.name}</option>`)
                )
              }
            });
          },0);
        }
        tagTypesId.push(tageTypeId);
        setTimeout(function(){$(".select2").select2()},0);

      });
    });
  </script>


@stop
