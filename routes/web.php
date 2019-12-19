<?php
  Route::get('/test','CV\CvController@getTest')->name('test');
  Route::post('/test','CV\CvController@test')->name('test');


  Route::get('login', ['as' => 'admin.login', 'uses' => 'Admin\AdminController@getLogin']);
  Route::post('login', ['as' => 'admin.login.post', 'uses' => 'Admin\AdminController@postLogin']);
  Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'Admin\AdminController@getDashboard']);
  Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Admin\AdminController@getLogout']);




   //Admin
   Route::resource('/admin', 'Admin\AdminController');
   Route::get('/admin/delete/{id}', ['as' => 'admin.delete', 'uses' => 'Admin\AdminController@destroy']);

   //User
   Route::resource('/user', 'Admin\UserController');
   Route::get('/user/delete/{id}', ['as' => 'user.delete', 'uses' => 'Admin\UserController@delete']);
   Route::get('/user/questions/assign/{id}', ['as' => 'user.questions.assign', 'uses' => 'Admin\UserController@assignQuestions']);


   //Question
   Route::resource('/question', 'Admin\QuestionController');
   Route::get('/question/delete/{id}', ['as' => 'question.delete', 'uses' => 'Admin\QuestionController@delete']);

   //Category
   Route::resource('/category', 'Admin\CategoryController');
   Route::get('/category/delete/{id}', ['as' => 'category.delete', 'uses' => 'Admin\CategoryController@destroy']);

   //Exam
   Route::resource('/exam', 'Admin\ExamController');
   Route::get('/exam/delete/{id}', ['as' => 'exam.delete', 'uses' => 'Admin\ExamController@destroy']);

   //Role
   Route::resource('/role', 'Admin\RoleController');
   Route::get('/role/delete/{id}', ['as' => 'role.delete', 'uses' => 'Admin\RoleController@destroy']);



   //cv
   Route::get('/manage/cv',['as' => 'cv.manage','uses' => 'CV\CvController@index']);
   Route::get('/create/cv',['as' => 'cv.create','uses' => 'CV\CvController@create']);
   Route::get('/update/cv/{id}',['as' => 'cv.edit','uses' => 'CV\CvController@edit']);
   Route::post('/update/cv/{id}',['as' => 'cv.update','uses' => 'CV\CvController@update']);
   Route::get('/add/langs/{id}',['as' => 'cv.add.langs','uses' => 'CV\CvController@getLangs']);
   Route::post('/add/langs/{id}',['as' => 'cv.add.langs','uses' => 'CV\CvController@postLangs']);
   Route::get('/add/skills/{id}',['as' => 'cv.add.skills','uses' => 'CV\CvController@getSkills']);
   Route::post('/add/skills/{id}',['as' => 'cv.post.skills','uses' => 'CV\CvController@postSkills']);
   Route::get('/add/certificates/{id}',['as' => 'cv.add.certificates','uses' => 'CV\CvController@getCertificates']);
   Route::post('/add/certificates/{id}',['as' => 'cv.add.certificates','uses' => 'CV\CvController@postCertificates']);
   Route::post('/create/cv','CV\CvController@store')->name('cv.store');
   Route::get('/show/cv/{id}','CV\CvController@show')->name('cv.show');
   Route::get('/search/cv','CV\CvController@getSearch')->name('cv.search');
   Route::post('/search/cv','CV\CvController@postSearch')->name('cv.search');
   Route::get('/add/work/{id}','CV\CvController@getWork')->name('cv.add.work');
   Route::get('/add/tags/{id}','CV\CvController@getTags')->name('cv.add.tags');
   Route::post('/add/work/{id}','CV\CvController@postWork')->name('cv.add.work');
   Route::post('/add/tags/{id}','CV\CvController@postTags')->name('cv.add.tags');
   Route::get('/remove/work/{id}','CV\CvController@deleteWork')->name('cv.delete.work');
   Route::get('/remove/lang/{id}','CV\CvController@removeLang')->name('cv.remove.lang');
   Route::get('/add/contact/{id}','CV\CvController@getContact')->name('cv.add.contact');
   Route::get('/tagType/tags/{id}','CV\CvController@tagTypeTags')->name('tagType.tags');
   Route::post('/add/contact/{id}','CV\CvController@postContact')->name('cv.add.contact');
   Route::get('/delete/phone/{id}','CV\CvController@deletePhone')->name('cv.delete.phone');
   Route::get('/remove/skill/{id}','CV\CvController@removeSkill')->name('cv.remove.skill');
   Route::get('/add/education/{id}','CV\CvController@getEducation')->name('cv.add.education');
   Route::post('/add/education/{id}','CV\CvController@postEducation')->name('cv.add.education');
   Route::get('/delete/account/{id}','CV\CvController@deleteAccount')->name('cv.delete.account');
   Route::get('/delete/education/{id}','CV\CvController@deleteEducation')->name('cv.delete.education');
   Route::get('/delete/certificate/{id}','CV\CvController@deleteCertificate')->name('cv.delete.certificate');

   // interview
   Route::get('/create/interview/{cv_id}','Interview\InterviewController@create')->name('cv.interview');
   Route::post('/create/interview/{cv_id}','Interview\InterviewController@store')->name('cv.interview');


   // language
   Route::get('/create/language','Lang\LangController@create')->name('lang.create');
   Route::post('/create/language','Lang\LangController@store')->name('lang.store');

   // skill
   Route::get('/create/skill','Skill\SkillController@create')->name('skill.create');
   Route::post('/create/skill','Skill\SkillController@Store')->name('skill.store');

   // tags
   Route::get('/create/tagType','Tag\TagController@getTagType')->name('tagType.add');
   Route::post('/create/tagType','Tag\TagController@postTagType')->name('tagType.store');
   Route::get('/create/tag','Tag\TagController@getTag')->name('tag.add');
   Route::post('/create/tag','Tag\TagController@postTag')->name('tag.store');

   // certificate
   Route::get('/create/certificate','Certificate\CertificateController@create')->name('certificate.create');
   Route::post('/create/certificate','Certificate\CertificateController@store')->name('certificate.create');
   // request employee
   Route::get('/create/request','CV\CvController@getRequest')->name('request.create');
   Route::post('/create/request','CV\CvController@postRequest')->name('request.store');
   Route::get('/list/request','CV\CvController@indexRequest')->name('request.all');
   Route::get('/show/request/{id}','CV\CvController@showRequest')->name('request.show');

   Route::get('/tag/type/page','Tag\TagController@viewTag')->name('view.tags');
