@include('Admin.layout.header')

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('Admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
@include('Admin.layout.navbar')
<!-- /.navbar -->

<!-- Main Sidebar Container -->
@include('Admin.layout.sidebar')

{{-- content header --}}
@include('Admin.layout.pageHeader')

@yield('content')

@include('Admin.layout.footer')
