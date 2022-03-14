@extends('adminlte::master2')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
<div id="app" style="min-height: 100%">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm p-1" style="background-color: #00a4c5e0">
        <div class="container">
            <a class="navbar-brand p-0" href="{{ url('/') }}">
                <img src="{{config('app.url')}}/{{config('adminlte.logo_img')}}" class="avatar" style="height: 35px"  alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}" style="font-size:16px; color:white;"><i class="fas fa-lg fa-home" ></i> My courses</a>
                    </li>
                    {{-- <li class="nav-item active">
                        <a class="nav-link" href="{{ route('my_course.list') }}" style="font-size:16px; color:white;"><i class="fas fa-lg fa-tachometer-alt " ></i> My Courses</a>
                    </li> --}}
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('my_schedule.list') }}" style="font-size:16px; color:white;"><i class="fas fa-lg fa-calendar-check"></i> Schedules</a>
                    </li>
                    
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(Auth::user()->avatar)
                                    @if(!str_starts_with(Auth::user()->avatar, 'http'))
                                        <img src="{{ config('app.url')}}/{{ Auth::user()->avatar }}" class="avatar rounded-circle img-thumbnail" style="height: 40px; width:40px"  alt="User Image">
                                    @else
                                        <img src="{{ Auth::user()->avatar }}" class="avatar rounded-circle img-thumbnail" style="height: 40px; width:40px"  alt="User Image">
                                    @endif
                                @else
                                    {{ Auth::user()->name }}
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role_id == 1)
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        Admin page
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>    
</div>

@endsection

@section('plugins.Sweetalert2', true)
@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script>
        function deleteAction(e, id) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    document.getElementById("deleteElement-"+id).submit();
                }
            })
        }
        function actionStatus(status, type) {
            Swal.fire({
                title: status,
                type: type,
            })
        }
    </script>
    @error('msg')
        <script>
            actionStatus("{{$message}}", "error")
        </script>
    @enderror
    @if(session('success'))
        <script>
            actionStatus("{{session('success')}}", "success")
        </script>               
    @endif
    @if(session('failed'))
    <script>
        actionStatus("{{session('failed')}}", "error")
    </script>               
@endif
@stop
