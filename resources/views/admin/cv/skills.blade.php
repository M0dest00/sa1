@extends('admin.master')

@section('body')
  <section class="content-header">
    <a href="{!! route('cv.edit',['id' => $cv->id]) !!}" class="btn btn-warning btn-sm fa fa-arrow-left"> Back</a>
  </section>

  <section class="content">
    <form class="col-md-10" action="{{route('cv.post.skills',['id' => $cv->id])}}" method="post">
      {{csrf_field()}}
      <h2>Add/Edit CV Skills</h2>
      <table class="table table-bordered table-striped">
        <thead>
          <th>* Skill title</th>
          <th>* Brief Description</th>
        </thead>
        <tbody class="skills_container">
          @if($cvSkills->count()>0)
            @foreach($cvSkills as $cvSkill)
              <tr>
                <td>
                  <div class="form-group col-md-12 " style="width:250px;">
                    <select class="select2 form-control " name="updatedSkills[]">
                      <option selected disabled>Select Skill</option>
                      @foreach($skills as $skill)
                        @if($cvSkill->skill_id==$skill->id)
                          <option selected value="{{$skill->id}}">{{$skill->name}}</option>
                        @else
                          <option value="{{$skill->id}}">{{$skill->name}}</option>
                        @endif
                      @endforeach
                    </select>
                    <input type="hidden" name="cvSkillsIds[]" value="{{$cvSkill->id}}">
                  </div>
                </td>
                <td>
                  <div class="form-group col-md-12">
                    <input type="text" name="updatedDescription[]" class="form-control" value="{{$cvSkill->description}}">
                  </div>
                </td>
                <td>
                  <a href="{{route('cv.remove.skill',['id' => $cvSkill->id])}}" class="btn btn-danger btn-xs delete">Remove</a>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td>
                <div class="form-group col-md-12 " style="width:250px;">
                  <select class="select2 form-control " name="skills[]">
                    <option selected disabled>Select Skill</option>
                    @foreach($skills as $skill)
                      <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endforeach
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group col-md-12">
                  <input type="text" name="description[]" class="form-control" placeholder="Experience level" required>
                </div>
              </td>
          @endif
              <td>
                <button type="button" class="btn btn-success" id="add_new_skill">Add Another Skill</button>
              </td>
            </tr>
        </tbody>
      </table>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </section>
@stop
@section('page_scripts')
  <script>
    $(document).ready(function(){
      $("#add_new_skill").on('click',function(){
        $(".skills_container").append(`
          <tr>
            <td>
              <div class="form-group col-md-12 " style="width:250px;">
                <select class="select2 form-control " name="skills[]">
                  <option selected disabled>Select Skill</option>
                  @foreach($skills as $skill)
                    <option value="{{$skill->id}}">{{$skill->name}}</option>
                  @endforeach
                </select>
              </div>
            </td>
            <td>
              <div class="form-group col-md-12">
                <input type="text" name="description[]" class="form-control" placeholder="Experience level" required>
              </div>
            </td>
          </tr>
          `);
          setTimeout(function(){
            $(".select2").select2();
          },100);
      });
    });
  </script>
@stop
