@include('admin.header')
@section('sidebar')
  @include('admin.sidebar')
@show
<div class="content-wrapper">
@include('errors')
@include('message')
@yield('body')
</div>
@include('admin.footer')
@section('scrips')
 
  @include('admin.scripts')
  @yield('page_scripts')
@show
</body>
</html>

