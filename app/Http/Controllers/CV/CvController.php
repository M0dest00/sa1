<?php

namespace App\Http\Controllers\CV;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\CV;
use App\City;
use App\Country;
use App\CV_Language;
use App\Language;
use App\CV_Skill;
use App\Skill;
use App\SocialAccountType;
use App\CV_SocialAccount;
use App\CV_Phone;
use App\TagType;
use App\Tag;
use App\CV_Tag;
use App\CV_EducationHistory;
use App\CV_WorkHistory;
use App\CV_Certificate;
use App\Certificate;
use App\CompanyRequest;
class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cvCollection = CV::all();
      // return $cvCollection;
      return view('admin.cv.manage',compact('cvCollection'));
    }
    public function getTest()
    {
      return view('admin.cv.test');
    }
    public function test(Request $request)
    {
      return $request;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $cities = City::all();
      $countries = Country::all();
      $accountTypes = SocialAccountType::all();
      return view('admin.cv.create',compact('cities','countries','accountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return $request->file('picture');
      foreach ($request->phone_numbers as $phoneNum) {
        if($phoneNum<0){
          return redirect()->back()->with(['message' => "invalid phone number"]);
        }
      }
      if($request->has('account_types')){
        $this->validate($request,[
          'account_types' => 'min:1',
          'social_accounts' => 'required|min:1',
        ]);
      }
      $this->validate($request,[
        'picture' => 'image',
        'first_name' => 'bail|required|max:255|alpha',
        'last_name' => 'required|max:255|alpha',
        'nationality' => 'required',
        'gender' => 'required',
        'birth_date' => 'required',
        'city' => 'required',
        'address' => 'required',
        'phone_numbers' => 'required|min:1',
        'phone_numbers.*' => 'numeric|integer',
        'country_codes' => 'required|min:1',
      ]);
      $city = City::find($request->city);
      $request_array = [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'date_of_birth' => $request->birth_date,
        'nationality' => $request->nationality,
        'gender_id' => $request->gender,
        'address' => $request->address,
        'city_id' => $request->city,
        'country_id' => $city->country_id,
      ];
      // cv picture is set to be a default value till fixing "picture no object" bug in the cv form
      // if($request->input('picture') !== null){
      //   $picture = $request->input('picture');
      //   $picture = str_replace('data:image/png;base64,', '', $picture);
      //   $picture = str_replace(' ', '+', $picture);
      //   $pictureName = time() . '_' . uniqid() . '.png';
      //   \File::put(public_path() . '/cv/pictures//'. $pictureName, base64_decode($picture));
      //   $request_array['picture'] = $pictureName;
      // }
      // else {
      //   $request_array['picture'] = 'default.jpg';
      // }
      if($request->hasFile('picture')){
        $fullImage = $request->file('picture');
        $fullImageName = $fullImage->getClientOriginalName() . time() . '.' . $fullImage->getClientOriginalExtension();
        $destinationPath = public_path() . '/cv/pictures//';
        $request->file('picture')->move($destinationPath, $fullImageName);
        $request_array['picture'] = $fullImageName;
      }
      else {
        $request_array['picture'] = 'default.jpg';
      }
      $request_array['driving_license_availablity'] = (isset($request->driving_license_availablity))? 1 : 0 ;
      $request_array['smoker'] = (isset($request->smoker))? 1 : 0 ;
      $request_array['travel_availablity'] = (isset($request->travel_availablity))? 1 : 0 ;
      $request_array['user_id'] = \Auth::user()->id;
      // return $request_array;
      $cv = CV::create($request_array);
      // return $request->phone_numbers;
      foreach ($request->phone_numbers as $i => $value) {
        if(isset($request->country_codes[$i])){
          CV_Phone::create([
            'cv_id' => $cv->id,
            'number' => $value,
            'country_code' => $request->country_codes[$i],
          ]);
        }
      }
      if($request->has('account_types')){
        foreach ($request->account_types as $i => $value) {
          if(isset($request->social_accounts[$i])){
            CV_SocialAccount::create([
              'cv_id' => $cv->id,
              'account' => $request->social_accounts[$i],
              'social_account_type' => $value,
            ]);
          }
        }
      }
      return redirect(route('cv.edit',['id' => \Auth::user()->id]));
    }

    public function getSkills($id)
    {
      $cv = CV::find($id);
      $cvSkills = CV_Skill::where('cv_id',$id)->get();
      $skills = Skill::all();
      return view('admin.cv.skills',compact('cv','cvSkills','skills'));
    }
    public function postSkills(Request $request,$id)
    {
      // return $request;
      if($request->has('skills') && $request->has('updatedSkills')){
        $this->validate($request,[
          'skills' => Rule::unique('cv_skills','skill_id')->where(function($query) use ($id){
            return $query->where('cv_id',$id);
          }),
        ]);
      }
      if($request->has('skills')){
        $this->validate($request,[
          'skills' => 'required|array|min:1',
          'skills.*' => 'required|distinct',
          'description.*' => 'required|max:255|',
          'description' => 'required|array|min:1',
        ]);
      }
      if($request->has('cvSkillsIds')){
        $this->validate($request,[
          'updatedSkills' => 'required|min:1|array',
          'updatedSkills.*' => 'required|distinct',
          'updatedDescription' => 'required|array|min:1',
          'updatedDescription.*' => 'required|max:255|',
        ]);
      }
      // $skillIds = [];
      // for ($i=0; $i < sizeof($request->skills); $i++) {
      //   $skill = Skill::create([
      //     'name' => $request->skills[$i],
      //     'description' => $request->description[$i],
      //   ]);
      //   array_push($skillIds,$skill->id);
      // }
      if($request->has('skills')){
        foreach ($request->skills as $index => $skill_id) {
          CV_Skill::create([
            'skill_id' => $skill_id,
            'description' => $request->description[$index],
            'cv_id' => $id,
          ]);
        }
      }
      if($request->has('cvSkillsIds')){
        for ($i=0; $i < sizeof($request->cvSkillsIds); $i++) {
          $skill = CV_Skill::find($request->cvSkillsIds[$i]);
          $skill->update([
            'skill_id' => $request->updatedSkills[$i],
            'description' => $request->updatedDescription[$i],
          ]);
        }
      }
      return redirect()->back();
    }

    public function getLangs($id)
    {
      $cv = CV::find($id);
      $languages = Language::all();
      $Cvlanguages = CV_Language::where('cv_id',$id)->get();
      // return $languages->count();
      return view('admin.cv.langs',compact('cv','Cvlanguages','languages'));
    }


    public function postLangs(Request $request,$id)
    {
      // return $request;
      if($request->has('languages')){
        $this->validate($request,[
          'languages' => 'required|array|min:1',
          'languages.*' => 'required|distinct',
          'description.*' => 'required|max:255|',
          'description' => 'required|array|min:1',
        ]);
      }
      if($request->has('CvLangsId')){
        $this->validate($request,[
          'updatedLangs' => 'required|min:1|array',
          'updatedLangs.*' => 'required|distinct',
          'updatedDescription' => 'required|array|min:1',
          'updatedDescription.*' => 'required|max:255|',
        ]);
      }
      $request_array=[];
      for ($i=0; $i <sizeof($request->languages) ; $i++) {
        array_push($request_array,[
          'language_id' => $request->languages[$i],
          'description' => $request->description[$i],
        ]);
      }
      // return $request_array;
      $cvCheck = CV_Language::where('cv_id',$id)->get();
      foreach($request_array as $data)
      {
        if ($cvCheck) {
          foreach ($cvCheck as $check) {
            if($data['language_id'] == $check->language_id){
              return redirect()->back()->with(['message'=>'this language is already in your cv']);
            }
          }
        }
        CV_Language::create([
          'cv_id' => $id,
          'language_id' => $data['language_id'],
          'description' => $data['description'],
        ]);
      }
      if($request->has('CvLangsId')){
        $array_update = [];
        for ($i=0; $i < sizeof($request->CvLangsId); $i++) {
          array_push($array_update,[
            'id' => $request->CvLangsId[$i],
            'language_id' => $request->updatedLangs[$i],
            'description' => $request->updatedDescritpion[$i],
          ]);
        }
        foreach ($array_update as $data) {
          $Cvlanguage = CV_Language::find($data['id']);
          $Cvlanguage->update([
            'language_id' => $data['language_id'],
            'description' => $data['description'],
          ]);
        }
      }
      return redirect()->back();
    }

    public function getTags($id)
    {
      $cv = CV::find($id);
      $tagTypes = TagType::all();
      $cvTags = CV_Tag::where('cv_id',$id)->get();
      return view('admin.cv.tags',compact('cv','tagTypes','cvTags'));
    }

    public function postTags(Request $request,$id)
    {


      // return $request;
      if($request->has('updatedTags')){
        CV_Tag::where('cv_id',$id)->delete();
        foreach ($request->updatedTags as $newTagsIds) {
          CV_Tag::create([
            'cv_id' => $id,
            'tag_id' => $newTagsIds,
          ]);
        }
      }
      else {
        CV_Tag::where('cv_id',$id)->delete();
      }
      if($request->has('tags') && $request->has('updatedTags')){
        $this->validate($request,[
          'tags' => Rule::unique('cv_tags','tag_id')->where(function($query) use ($id){
            return $query->where('cv_id',$id);
          }),
        ]);
      }
      if($request->has('tags')){
        $this->validate($request,[
          'tags.*' => 'required|min:1',
          'tags' => 'required|min:1',
        ]);
        foreach ($request->tags as $tagId) {
          CV_Tag::create([
            'cv_id' => $id,
            'tag_id' => $tagId,
          ]);
        }
      }

      return redirect()->back();
    }

    public function getSearch()
    {
      $tags = Tag::all();
      $cities = City::all();
      $skills = Skill::all();
      $certificates = Certificate::all();
      return view('admin.cv.search',compact('tags','cities','skills','certificates'));
    }

    public function postSearch(Request $request)
    {
      // if(isset($request->tags) && count($request->tags) > 0){
      //   $good_tags = $request->tags;
      //
      //   return CV::whereHas('cv_tags', function ($query) use ($good_tags) {
      //     $query->whereIn('tag_id', $good_tags);
      //   })->get();
      //
      //   if(!$tagsCVIDs->isEmpty()){
      //     $tagsCVIDs = $tagsCVIDs->toArray();
      //     $tagsValidation = CV_Tag::whereIn('cv_id',$tagsCVIDs)->pluck('tag_id')->toArray();
      //     if(array_diff($request->tags,$tagsValidation)) return "no results found" ;
      //     $CVIDs = array_merge($CVIDs,$tagsCVIDs);
      //   }
      //   else {
      //     return "no results found";
      //   }
      // }
      // return $request;
      $CVIDs = [];
      $flag = 0;
      if(isset($request->first_name)){
        $flag++;
        $firstNameCVIDs = CV::where('first_name',$request->first_name)->pluck('id');
        if(!$firstNameCVIDs->isEmpty()){
          $firstNameCVIDs = $firstNameCVIDs->toArray();
          $CVIDs = ($flag == 1)? $firstNameCVIDs : array_merge($CVIDs,$firstNameCVIDs);
        }
        else {
          return redirect()->back()->with(['message' => 'no results found']);
        }
      }
      if(isset($request->last_name)){
        $flag++;
        $lastNameCVIDs = CV::where('last_name',$request->last_name)->pluck('id');
        if(!$lastNameCVIDs->isEmpty()){
          $lastNameCVIDs = $lastNameCVIDs->toArray();
          $CVIDs = ($flag == 1)? $lastNameCVIDs : array_merge($CVIDs,$lastNameCVIDs);
        }
        else {
          return redirect()->back()->with(['message' => 'no results found']);
        }
      }
      if(isset($request->tags) && count($request->tags) > 0){
        $flag++;
        $tagsCVIDs = CV_Tag::where('tag_id',$request->tags)->pluck('cv_id');
        if(!$tagsCVIDs->isEmpty()){
          $tagsCVIDs = $tagsCVIDs->toArray();
          $tagsValidation = CV_Tag::whereIn('cv_id',$tagsCVIDs)->pluck('tag_id')->toArray();
          if(array_diff($request->tags,$tagsValidation)) return redirect()->back()->with(['message' => 'no results found']) ;
          $CVIDs = ($flag == 1)? $tagsCVIDs : array_merge($CVIDs,$tagsCVIDs);
        }
        else {
          return redirect()->back()->with(['message' => 'no results found']);
        }
      }
      if(isset($request->city)){
        $flag++;
        $cityCVIDs = CV::where('city_id',$request->city)->pluck('id');
        if(!$cityCVIDs->isEmpty()){
          $cityCVIDs = $cityCVIDs->toArray();
          $CVIDs = ($flag == 1)? $cityCVIDs : array_merge($CVIDs,$cityCVIDs);
        }
        else {
          return redirect()->back()->with(['message' => 'no results found']);
        }
      }
      if(isset($request->skills) && count($request->skills) > 0){
        $flag++;
        $skillCVIDs = CV_Skill::where('skill_id',$request->skills)->pluck('cv_id');
        if(!$skillCVIDs->isEmpty()){
          $skillCVIDs = $skillCVIDs->toArray();
          $skillsValidation = CV_Skill::whereIn('cv_id',$skillCVIDs)->pluck('skill_id')->toArray();
          if(array_diff($request->skills,$skillsValidation)) return redirect()->back()->with(['message' => 'no results found']) ;
          $CVIDs = ($flag == 1)? $skillCVIDs : array_merge($CVIDs,$skillCVIDs);
        }
        else {
          return redirect()->back()->with(['message' => 'no results found']);
        }
      }
      if(isset($request->certificates) && count($request->certificates) > 0){
        $flag++;
        $certificateCVIDs = CV_Certificate::where('certificate_id',$request->certificates)->pluck('cv_id');
        if(!$certificateCVIDs->isEmpty()){
          $certificateCVIDs = $certificateCVIDs->toArray();
          $certificatesValidation = CV_Certificate::whereIn('cv_id',$certificateCVIDs)->pluck('certificate_id')->toArray();
          if(array_diff($request->certificates,$certificatesValidation)) return redirect()->back()->with(['message' => 'no results found']) ;
          $CVIDs = ($flag == 1)? $certificateCVIDs : array_merge($CVIDs,$certificateCVIDs);
        }
        else {
          return redirect()->back()->with(['message' => 'no results found']);
        }
      }
      if($flag > 1){
        if(count($CVIDs) != count(array_unique($CVIDs))){
          $fileredCVIDs = [];
          foreach (array_count_values($CVIDs) as $key => $value) {
            if($value>1){
              $fileredCVIDs[] = $key;
            }
            $CVIDs = $fileredCVIDs;
          }
        }
        else return redirect()->back()->with(['message' => 'no results found']);
      }
      $CVs = [];
      foreach ($CVIDs as $CVID) {
        array_push($CVs,CV::find($CVID));
      }
      return view('admin.cv.list',compact('CVs'));
    }

    public function getContact($id)
    {
      $cv = CV::find($id);
      $countries = Country::all();
      $accountTypes = SocialAccountType::all();
      $cvSocialAccounts = CV_SocialAccount::where('cv_id',$id)->get();
      $cvPhones = CV_Phone::where('cv_id',$id)->get();
      return view('admin.cv.contact',compact('cvSocialAccounts','cvPhones','cv','accountTypes','countries'));
    }

    public function postContact(Request $request,$id)
    {
      // return $request;
      if($request->has('updatedSocials')){
        $this->validate($request,[
          'updatedSocials.*' => 'email'
        ]);
        CV_SocialAccount::where('cv_id',$id)->delete();
        foreach ($request->updatedSocials as $key => $value) {
          CV_SocialAccount::create([
            'cv_id' => $id,
            'account' => $value,
            'social_account_type' => $request->updatedAccountTypes[$key],
          ]);
        }
      }
      if($request->has('updatedPhones')){
        $this->validate($request,[
          'updatedPhones.*' => 'max:9999999999|numeric|distinct',
          'updatedPhones' => 'array|',
        ]);
        CV_Phone::where('cv_id',$id)->delete();
        foreach ($request->updatedPhones as $key => $value) {
          CV_Phone::create([
            'cv_id' => $id,
            'number' => $value,
            'country_code' => $request->updatedCountryCodes[$key],
          ]);
        }
      }
      if($request->has('country_codes')){
        $this->validate($request,[
          'phone_numbers.*' => 'required|max:9999999999|numeric|unique:cv_phones,number',
          // 'phone_numbers' => 'array|distinct|'
        ]);
        foreach ($request->country_codes as $index => $code) {
          // $phoneNum = $code.$request->phone_numbers[$index];
          CV_Phone::create([
            'cv_id' => $id,
            'number' => $request->phone_numbers[$index],
            'country_code' => $code,
          ]);
        }
      }
      if($request->has('account_types')){
         $this->validate($request,[
           'social_accounts.*' => 'required|email',
         ]);

        foreach ($request->account_types as $index => $type) {
          $this->validate($request,[
            'social_accounts.*' => Rule::unique('social_accounts','account')->where(function($query) use ($type){
              return $query->where('social_account_type',$type);
            }),
          ]);
          CV_SocialAccount::create([
            'cv_id' => $id,
            'account' => $request->social_accounts[$index],
            'social_account_type' => $type,
          ]);
        }
      }
      return redirect()->back();
    }

    public function deleteAccount($id)
    {
      CV_SocialAccount::destroy($id);
      return redirect()->back();
    }
    public function deletePhone($id)
    {
      CV_Phone::destroy($id);
      return redirect()->back();
    }

    public function getCertificates($id)
    {
      $cv = CV::find($id);
      $cvCertificates = CV_Certificate::where('cv_id',$id)->get();
      $certificates = Certificate::all();
      return view('admin.cv.certificates',compact('cv','cvCertificates','certificates'));
    }
    public function postCertificates(Request $request,$id)
    {
      // return $request;
      if($request->has('updatedCertificate')){
        $this->validate($request,[
          'updatedCertificate.*' => 'distinct',
          'updatedCertificate.*' => Rule::unique('cv_certificates','certificate_id')->where(function($query) use($id){
            return $query->where('cv_id',$id);
          }),
        ]);
        CV_Certificate::where('cv_id',$id)->delete();
        foreach ($request->updatedCertificate as $key => $value) {
          CV_Certificate::create([
            'cv_id' => $id,
            'certificate_id' => $value,
            'description' => $request->updatedDescription[$key],
          ]);
        }
      }
      if($request->has('certificate')){
        $this->validate($request,[
          'certificate.*' => 'distinct',
          'certificate.*' => Rule::unique('cv_certificates','certificate_id')->where(function($query) use($id){
            return $query->where('cv_id',$id);
          }),
          'description.*' => 'required|max:255|',
        ]);
        foreach ($request->certificate as $key => $value) {
          CV_Certificate::create([
            'cv_id' => $id,
            'certificate_id' => $value,
            'description' => $request->description[$key],
          ]);
        }
      }
      return redirect()->back();
    }
    public function deleteCertificate($id)
    {
      CV_Certificate::destroy($id);
      return redirect()->back();
    }
    public function removeLang($id)
    {
      CV_Language::destroy($id);
      return redirect()->back();
    }
    public function removeSkill($id)
    {
      CV_Skill::destroy($id);
      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $cv = CV::find($id);
      $cv_tags = CV_Tag::where('cv_id',$id)->get();
      return view('admin.cv.show',compact('cv','cv_tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $cities = City::all();
      $cv = CV::where('user_id',$id)->first();
      // return $cv;
      return view('admin.cv.edit',compact('cv','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        if(isset($request->city)){
          $city = City::find($request->city);
          $request['city_id'] = $city->id;
          $request['country_id'] = $city->country_id;
        }
        $request['driving_license_availablity'] = (isset($request->driving_license_availablity))? 1 : 0 ;
        $request['smoker'] = (isset($request->smoker))? 1 : 0 ;
        $request['travel_availablity'] = (isset($request->travel_availablity))? 1 : 0 ;
        $cv = CV::find($id);
        $cv->update([
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'address' => $request->address,
          'city_id' => $request['city_id'],
          'country_id' => $request['country_id'],
          'driving_license_availablity' => $request['driving_license_availablity'],
          'smoker' => $request['smoker'],
          'travel_availablity' => $request['travel_availablity'],
        ]);
        return redirect()->back();
    }

    public function getWork($id)
    {
      $cv = CV::find($id);
      $cvWorks = CV_WorkHistory::where('cv_id',$id)->get();
      return view('admin.cv.work',compact('cv','cvWorks'));
    }

    public function postWork(Request $request,$id)
    {
      // return $request;
      if($request->has('updatedJobTitle')){
        $this->validate($request,[
          'updatedFrom.*' => 'required|date',
          'updatedTo.*' => 'required|date',
          'updatedCompanyName.*' => '|required|max:255',
          'updatedJobTitle.*' => '|required|max:255',
          'updatedDescription.*' => '|required|max:255|',
        ]);
        CV_WorkHistory::where('cv_id',$id)->delete();
        foreach ($request->updatedJobTitle as $key => $value) {
          CV_WorkHistory::create([
            'cv_id' => $id,
            'company_name' => $request->updatedCompanyName[$key],
            'job_title' => $value,
            'description' => $request->updatedDescription[$key],
            'from' => $request->updatedFrom[$key],
            'to' => $request->updatedTo[$key],
          ]);
        }
      }
      $this->validate($request,[
        'from.*' => 'required|date',
        'to.*' => 'required|date',
        'company_name.*' => '|required|max:255',
        'job_title.*' => '|required|max:255',
        'description.*' => '|required|max:255|',
      ]);
      if($request->job_title != null){
        foreach ($request->job_title as $key => $value) {
          CV_WorkHistory::create([
            'cv_id' => $id,
            'company_name' => $request->company_name[$key],
            'job_title' => $value,
            'description' => $request->description[$key],
            'from' => $request->from[$key],
            'to' => $request->to[$key],
          ]);
        }
      }
      return redirect()->back();

    }
    public function deleteWork($id)
    {
      CV_WorkHistory::destroy($id);
      return redirect()->back();
    }

    public function getEducation($id)
    {
      $cv = CV::find($id);
      $cvEducations = CV_EducationHistory::where('cv_id',$id)->get();
      return view('admin.cv.education',compact('cv','cvEducations'));
    }
    public function postEducation(Request $request,$id)
    {
      // return $request;
      if($request->has('updatedEducationInstitution')){
        $this->validate($request,[
          'updatedFrom.*' => 'required|date',
          'updatedTo.*' => 'required|date',
          'updatedEducationInstitution.*' => '|required|max:255',
          'updatedDescription.*' => '|required|max:255|',
        ]);
        CV_EducationHistory::where('cv_id',$id)->delete();
        foreach ($request->updatedJobTitle as $key => $value) {
          CV_EducationHistory::create([
            'cv_id' => $id,
            'education_institution' => $request->updatedEducationInstitution[$key],
            'description' => $request->updatedDescription[$key],
            'from' => $request->updatedFrom[$key],
            'to' => $request->updatedTo[$key],
          ]);
        }
      }
      $this->validate($request,[
        'from.*' => 'required|date',
        'to.*' => 'required|date',
        'education_institution.*' => '|required|max:255',
        'description.*' => '|required|max:255|',
      ]);
      if($request->education_institution != null){
        foreach ($request->education_institution as $key => $value) {
          CV_EducationHistory::create([
            'cv_id' => $id,
            'education_institution' => $value,
            'description' => $request->description[$key],
            'from' => $request->from[$key],
            'to' => $request->to[$key],
          ]);
        }
      }
      return redirect()->back();

    }

    public function deleteEducation($id)
    {
      CV_EducationHistory::destroy($id);
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function tagTypeTags($id)
    {
      return response()->json([
        'tags' => Tag::where('tag_type_id',$id)->get(),
      ]);
    }
    public function getRequest()
    {
      $tags = Tag::all();
      return view('admin.cv.request',compact('tags'));
    }
    public function postRequest(Request $request)
    {
      foreach ($request->tags as $key => $value) {
        CompanyRequest::create([
          'company_id' => \Auth::user()->id,
          'tag_id' => $value,
        ]);
      }
      return redirect()->back()->with(['message'=>"your request has been submit successfuly"]);
    }
    public function indexRequest()
    {
      $requests = CompanyRequest::all();
      return view('admin.cv.indexRequest',compact('requests'));
    }
    public function showRequest($id)
    {
      $requests = CompanyRequest::where('company_id',$id)->get();
      // return $requests;
      $company = CompanyRequest::where('company_id',$id)->first();
      return view('admin.cv.showRequest',compact('requests','company'));
    }

}
