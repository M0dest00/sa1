@extends('admin.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css">
@section('body')

<section class="content-header">
  <h1 class="">Create CV</h1>
</section>

<section class="content">
      <!-- any page except the first page should have both page-"num" and next-page class name -->
  {{-- <form class="col-md-8" id="form_data" method="post" action="{{route('cv.store')}}" enctype="multipart/form-data" lastpage="5"> --}}
    {!! Form::open(['route' => ['cv.store'], 'files' => true , 'id' => "form_data",'lastpage' => '5','class' => 'col-md-10']) !!}
    {{-- {{ csrf_field() }} --}}
    <div id="form_pages" page_num="1" >
      <div class="page-1">
        <div id="page-image">
          <div class="form-group"> {{ Form::label('Picture') }} {!! Form::file('picture') !!} </div>
        </div>
      </div>
      <div class="page-2 next-page" >
        <h2>Basic Information</h2>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>*First Name</label>
            <input type="text" class="form-control input-2" name="first_name"  placeholder="First Name">
          </div>
          <div class="form-group col-md-6">
            <label>*Last Name</label>
            <input type="text" class="form-control input-2" name="last_name" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group">
          <label>*Nationality</label>
          <select class="form-control select2 nationalitySelect input-2" name="nationality">
            <option selected disabled>Select your Nationality</option>
            @foreach($countries as $country)
            <option value="{{$country->id}}">{{$country->nationality}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="inputState">*Gender</label>
          <select id="inputState" class="form-control select2 input-2" name="gender">
            <option selected disabled >Choose</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
          </select>
        </div>
        <div class="form-group">
            <label>*Birth Date</label>
            <input type="text" class="form-control datepicker input-2" name="birth_date">
        </div>
      </div>
      <div class="page-3 next-page">
        <h2>Residence</h2>
        <div class="form-group">
          <label>*City</label>
          <select class="form-control select2 input-3" id="citySelect"style="width:100%;" name="city">
            <option selected disabled>Select City</option>
            @foreach($cities as $city)
              <option value="{{$city->id}}">{{$city->name}},{{$city->country->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>*Address</label>
          <input type="text" class="form-control input-3" id="addressInput" placeholder="ex:Mohandseen,12411" disabled name="address">
        </div>
      </div>
      <div class="page-4 next-page">
        <h2>Contact Info</h2>
        <div class="phone-container">
          <label class="col-md-12">*Mobile phone</label>
          <div class="form-row">
            <div class="form-group col-md-3">
              <select class="select2 form-control country_code_select input-4" name="country_codes[]">
                <option disabled selected>Country Code</option>
                @foreach($countries as $country)
                  <option value="{{$country->country_code}}">{{$country->name}},{{$country->country_code}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="number" class="form-control phone_input input-4" name="phone_numbers[]" placeholder="Phone Number" maxlength="11" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;">
            </div>
            <div class="form-group col-md-2">
              <button id="add_phone" type="button" class="btn btn-warning">Add Another Phone</button>
            </div>
          </div>
        </div>
        <div class="accounts_container">
          <label class="col-md-12">Social Accounts</label>
          <div class="form-row">
            <div class="form-group col-md-3">
              <select class="form-control select2" name="account_types[]">
                <option selected disabled>Account Type</option>
                @foreach($accountTypes as $accountType)
                  <option value="{{$accountType->name}}">{{$accountType->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="email" name="social_accounts[]" class="form-control" placeholder="E-mail Address">
            </div>
            <div class="form-group col-md-2">
              <button type="button" class="btn btn-warning" id="add_account">Add Another Account</button>
            </div>
          </div>
        </div>
      </div>
      <div class="page-5 next-page">
        <h2>More Information</h2>
        <div class="form-group">
          <input type="checkbox" name="travel_availablity" class="form-check-input checker" value="1">
          <label>Available for Traveling</label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="driving_license_availablity" class="form-check-input checker" value="1">
          <label>Having a Driving License</label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="smoker" class="form-check-input checker" value="1">
          <label>Smoker</label>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3 previous" hidden>
        <button type="button" class="btn btn-primary " id="prevBtn" >Previous</button>
      </div>
      <div class="form-group col-md-3 submit" hidden>
        <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
      </div>
      <div class="form-group col-md-3 next" >
        <button type="button" id="nextBtn" class="btn btn-primary">Next</button>
      </div>
    </div>
    {!! Form::close() !!}
  {{-- </form> --}}
</section>
@stop
@section('page_scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
  <script>
    $(".next-page").hide();
    $(document).ready(function(){
      // lastPage variable define the pages count in case of any further changes
      var lastPage = $("#form_data").attr('lastpage');
      // next button function, show previous button on page number 2 and hide itselft at the last page
      $("#nextBtn").on('click',function(){
        var currentPage = $("#form_pages").attr('page_num');
        var empty = false;
        if($(".input-"+currentPage)[0]){
          $(".input-"+currentPage).each(function(){
            if(!$(this).val()){
              empty = true;
            }
          });
          if(empty){
            alert('You must fill all the * fields')
            return ;
          }
        }
        if(currentPage == 1)
          $(".previous").show();
        if(currentPage <= lastPage-1)
        {
          $("#form_pages").attr('page_num',parseFloat(currentPage)+1);
          var showPage = $("#form_pages").attr('page_num');
          $(".page-"+currentPage).hide();
          $(".page-"+showPage).show();
          if(currentPage == lastPage-1){
            $(".next").hide();
            $(".submit").show();
          }
        }
      });
      // previous button function, hide itself on the first page and show next button on the other pages when it's hidden on any page except the last page
      $("#prevBtn").on('click',function(){
        var currentPage = $("#form_pages").attr('page_num');
        if(currentPage > 1)
        {
          $(".next").show();
          if(currentPage == 2){
            $(".previous").hide();
          }
          if(currentPage <= lastPage){
            $("#form_pages").attr('page_num',parseFloat(currentPage)-1);
            var showPage = $("#form_pages").attr('page_num');
            $(".page-"+currentPage).hide();
            $(".submit").hide();
            $(".page-"+showPage).show();
          }
        }
      });

      $("#citySelect").change(function(){
        $("#addressInput").prop('disabled',false);
      });
      // $(".country_code_select").change(function(){
      //   $(".phone_input").prop('disabled',false);
      // });
      // var image_flag = false;
      // $uploadCrop = $('#page-image').croppie({
      // enableExif: true,
      // enableResize : false,
      // enableZoom : true,
      // mouseWheelZoom: true,
      // viewport: {
      // width: 150,
      // height: 150,
      // type: 'rectangle'
      // },
      // boundary: {
      //   width: 200,
      //   height: 200
      // }
      // });
      // $('#view_image').on('change', function () {
      // var reader = new FileReader();
      //   reader.onload = function (e) {
      //   $uploadCrop.croppie('bind', {
      //     url: e.target.result
      //   }).then(function(){
      //     image_flag=true;
      //     console.log('jQuery bind complete');
      //   });
      //   }
      //   reader.readAsDataURL(this.files[0]);
      // });
      // // submit button function crop the uploaded picture and submit the form
      // $('#submitBtn').click(function(event){
      //   if(image_flag==true){
      //     console.log(image_flag);
      //     $uploadCrop.croppie('result', {
      //       type: 'canvas',
      //       size: 'viewport'
      //       }).then(function (resp) {
      //       $('#input_image').val(resp);
      //       var currentPage = $("#form_pages").attr('page_num');
      //       if(currentPage == lastPage){
      //         $("#form_data").submit()
      //       }
      //     });
      //   }
      // });
      $("#add_phone").on('click',function(){
        $(".phone-container").append(`
          <div class="form-row">
            <div class="form-group col-md-3">
              <select class="select2 form-control country_code_select" name="country_codes[]">
                <option disabled selected>Country Code</option>
                @foreach($countries as $country)
                  <option value="{{$country->country_code}}">{{$country->name}},{{$country->country_code}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="number" class="form-control phone_input" name="phone_numbers[]" placeholder="Phone Number">
            </div>
          </div>
          `);
          setTimeout(function(){$(".select2").select2()},100);
      });
      $("#add_account").on("click",function(){
        $(".accounts_container").append(`
          <div class="form-row">
            <div class="form-group col-md-3">
              <select class="form-control select2" name="account_types[]">
                <option selected disabled>Account Type</option>
                @foreach($accountTypes as $accountType)
                  <option value="{{$accountType->name}}">{{$accountType->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="email" name="social_accounts[]" class="form-control">
            </div>
          </div>
          `);
          setTimeout(function(){$(".select2").select2()},100);
      });

    });
  </script>
@stop
