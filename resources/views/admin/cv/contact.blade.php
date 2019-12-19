@extends('admin.master')

@section('body')
  <section class="content-header">
    <a href="{!! route('cv.edit',['id' => $cv->id]) !!}" class="btn btn-warning btn-sm fa fa-arrow-left"> Back</a>
  </section>
  <section class="content">
    <form class="col-md-10" action="{!! route('cv.add.contact',['id' => $cv->id]) !!}" method="post">
      {{csrf_field()}}
      @if ($cvSocialAccounts->count()>0)
        <h2>Social Accounts</h2>
        @foreach ($cvSocialAccounts as $social)
          <div class="form-row col-md-12">
            <div class="form-group col-md-3">
              <select class="form-control select2" name="updatedAccountTypes[]">
                @foreach ($accountTypes as $type)
                  @if ($type->name == $social->social_account_type)
                    <option selected value="{{ $type->name }}">{{ $type->name }}</option>
                  @else
                    <option value="{{ $type->name }}">{{ $type->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="text" name="updatedSocials[]" class="form-control" value="{{ $social->account }}">
            </div>
            <div class="col-md-2">
              <a href="{!! route('cv.delete.account',['id' => $social->id]) !!}" class="btn btn-danger delete btn-sm fa">Delete</a>
            </div>
          </div>
        @endforeach
      @endif
      @if ($cvPhones->count()>0)
        <h2>Phone Numbers</h2>
        @foreach ($cvPhones as $phone)
          <div class="form-row col-md-12">
            <div class="form-group col-md-3">
              <select class="form-control select2" name="updatedCountryCodes[]">
                @foreach ($countries as $country)
                  @if ($country->country_code == $phone->country_code)
                    <option selected value="{{$country->country_code}}">{{$country->name}},{{$country->country_code}}</option>
                  @else
                    <option selected value="{{$country->country_code}}">{{$country->name}},{{$country->country_code}}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="number" class="form-control" name="updatedPhones[]" value="{{ $phone->number }}"  onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;">
            </div>
            <div class="col-md-2">
              <a href="{!! route('cv.delete.phone',['id' => $phone->id]) !!}" class="btn btn-danger delete btn-sm fa">Delete</a>
            </div>
          </div>
        @endforeach
      @endif
        <div class="accountsContainer">
          <label>Add Social Account</label>
          <div class="form-row col-md-12">
            <div class="form-group col-md-3">
              <select class="form-control select2" name="account_types[]">
                <option disabled selected>Account Type</option>
                @foreach ($accountTypes as $type)
                  <option value="{{ $type->name }}">{{ $type->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="text" name="social_accounts[]" maxlength="255" class="form-control" placeholder="E-mail Address">
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-success fa" id="newAccountBtn">Add another Account</button>
            </div>
          </div>
        </div>
        <div class="phonesContainer">
          <label>Add Phone Number</label>
          <div class="form-row col-md-12">
            <div class="form-group col-md-3">
              <select class="select2 form-control" name="country_codes[]">
                <option selected disabled>Country Code</option>
                @foreach ($countries as $country)
                  <option value="{{$country->country_code}}">{{$country->name}},{{$country->country_code}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="number" class="form-control" name="phone_numbers[]" placeholder="Phone Number"  onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;">
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-success fa" id="newPhoneBtn">Add another Phone</button>
            </div>
          </div>
        </div>
        <div class="form-group col-md-12">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
  </section>
@endsection
@section('page_scripts')
  <script>
    $(document).ready(function(){
      $("#newAccountBtn").on('click',function(){
        $('.accountsContainer').append(`
          <div class="form-row col-md-12">
            <div class="form-group col-md-3">
              <select class="form-control select2" name="account_types[]">
                <option disabled selected>Account Type</option>
                @foreach ($accountTypes as $type)
                  <option value="{{ $type->name }}">{{ $type->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="text" name="social_accounts[]" maxlength="255" class="form-control" placeholder="E-mail Address">
            </div>
          </div>
          `);
          setTimeout(function(){
            $('.select2').select2();
          },100);
      });
      $("#newPhoneBtn").on('click',function(){
        $('.phonesContainer').append(`
          <div class="form-row col-md-12">
            <div class="form-group col-md-3">
              <select class="select2 form-control" name="country_codes[]">
                <option selected disabled>Country Code</option>
                @foreach ($countries as $country)
                  <option value="{{$country->country_code}}">{{$country->name}},{{$country->country_code}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-7">
              <input type="number" class="form-control" name="phone_numbers[]" placeholder="Phone Number"  onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;">
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
