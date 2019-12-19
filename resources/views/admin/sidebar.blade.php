<header class="main-header">
  <a href="{{route('admin.dashboard')}}" class="logo">
    <span class="logo-lg"><b>Itshield Dashboard</b></span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
  </nav>
</header>
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
      </div>
      <div class="pull-left info">
      </div>
    </div>

    <ul class="sidebar-menu">

      {{-- <!--Users-->
      <li class="treeview {{(Route::current()->getName() == 'user.index' || Route::current()->getName() =='user.create') ? 'active' : '' }}" >
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> Users </span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          <li class="{{(Route::current()->getName() == 'user.index') ? 'active' : ''}}"><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i> All Users </a></li>

          <li class="{{(Route::current()->getName() == 'user.create') ? 'active' : ''}}"><a href="{{route('user.create')}}"><i class="fa fa-circle-o"></i> Create User </a></li>

        </ul>
      </li> --}}
      <!--END Users-->
      <!--Admins-->
      {{-- <li class="treeview {{(Route::current()->getName() == 'admin.index' || Route::current()->getName() =='admin.create') ? 'active' : '' }}" >
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> Admins </span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          <li class="{{(Route::current()->getName() == 'admin.index') ? 'active' : ''}}"><a href="{{route('admin.index')}}"><i class="fa fa-circle-o"></i> All Admins </a></li>

          <li class="{{(Route::current()->getName() == 'admin.create') ? 'active' : ''}}"><a href="{{route('admin.create')}}"><i class="fa fa-circle-o"></i> Create Admin </a></li>

        </ul>
      </li> --}}
      <!--END Admins-->

      <!--Roles-->
      {{-- <li class="treeview {{(Route::current()->getName() == 'role.index' || Route::current()->getName() =='role.create') ? 'active' : '' }}" >
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> Roles </span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          <li class="{{(Route::current()->getName() == 'role.index') ? 'active' : ''}}"><a href="{{route('role.index')}}"><i class="fa fa-circle-o"></i> All Roles </a></li>

          <li class="{{(Route::current()->getName() == 'role.create') ? 'active' : ''}}"><a href="{{route('role.create')}}"><i class="fa fa-circle-o"></i> Create Role </a></li>

        </ul>
      </li> --}}
      <!--END Roles-->



      {{-- <!--Categories-->
      <li class="treeview {{(Route::current()->getName() == 'category.index' || Route::current()->getName() =='category.create') ? 'active' : '' }}" >
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> Categories </span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          <li class="{{(Route::current()->getName() == 'category.index') ? 'active' : ''}}"><a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i> All Categories </a></li>

          <li class="{{(Route::current()->getName() == 'category.create') ? 'active' : ''}}"><a href="{{route('category.create')}}"><i class="fa fa-circle-o"></i> Add Category </a></li>

        </ul>
      </li> --}}
      <!--END Categories-->

      <!--Questions-->
      {{-- <li class="treeview {{(Route::current()->getName() == 'question.index' || Route::current()->getName() =='question.create') ? 'active' : '' }}" >
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> Questions </span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          <li class="{{(Route::current()->getName() == 'question.index') ? 'active' : ''}}"><a href="{{route('question.index')}}"><i class="fa fa-circle-o"></i> All Questions </a></li>

          <li class="{{(Route::current()->getName() == 'question.create') ? 'active' : ''}}"><a href="{{route('question.create')}}"><i class="fa fa-circle-o"></i> Add Question </a></li>

        </ul>
      </li> --}}
      <!--END Questions-->
      <!--Exams-->
      {{-- <li class="treeview {{(Route::current()->getName() == 'exam.index' || Route::current()->getName() =='exam.create') ? 'active' : '' }}" >
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> Exams </span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          <li class="{{(Route::current()->getName() == 'exam.index') ? 'active' : ''}}"><a href="{{route('exam.index')}}"><i class="fa fa-circle-o"></i> All Exams </a></li>

          <li class="{{(Route::current()->getName() == 'exam.create') ? 'active' : ''}}"><a href="{{route('exam.create')}}"><i class="fa fa-circle-o"></i> Add Exam </a></li>

        </ul>
      </li> --}}
      <!--END Exams-->
      {{-- CV Modules --}}
      @if (Auth::check() && Auth::user()->role == 'user')
      <li class="treeview" >
        <a href="#">
          <i class="fa fa-dashboard"></i> <span> CV </span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li class=""><a href="{{route('cv.create')}}"><i class="fa fa-circle-o"></i>Create CV</a></li>
            <li ><a href="{{ route('cv.edit',['id' => Auth::user()->id])}}"><i class="fa fa-circle-o"></i> My CV </a></li>


        </ul>
      </li>
    @elseif (Auth::check() && Auth::user()->role == 'admin')
      <li ><a href="{{route('cv.search')}}"><i class="fa fa-circle-o"></i>Search in CVs</a></li>
      <li ><a href="{{route('cv.manage')}}"><i class="fa fa-circle-o"></i> Manage CV </a></li>
      <li class=""><a href="{{route('tagType.add')}}"><i class="fa fa-circle-o"></i>Create Tag Type</a></li>
      <li ><a href="{{route('tag.add')}}"><i class="fa fa-circle-o"></i>Create Tag</a></li>
      <li ><a href="{{route('lang.create')}}"><i class="fa fa-circle-o"></i><span>Add Language</span></a></li>
      <li ><a href="{{route('skill.create')}}"><i class="fa fa-circle-o"></i><span>Add Skill</span></a></li>
      <li ><a href="{{route('certificate.create')}}"><i class="fa fa-circle-o"></i><span>Add Certificate</span></a></li>
      <li ><a href="{{route('request.all')}}"><i class="fa fa-circle-o"></i><span>Employees Requests</span></a></li>
    @elseif (Auth::check() && Auth::user()->role == 'company')
      <li ><a href="{{route('request.create')}}"><i class="fa fa-circle-o"></i><span>Request Employee</span></a></li>
    @endif
    @if (Auth::check())
      <li><a href="{{route('admin.logout')}}"><i class="fa fa-circle-o"></i><span>logout</span></a></li>
    @endif

      </ul>

  </section>

</aside>
