@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop
@section('plugins.Sweetalert2', true)
@section ('plugins.ChartJS' , true )
@section('adminlte_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    @stack('js')
    
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
        function makeChart(elementId, chartType, dataLables, dataValues, dataColors) {
        var myChart1 = document.getElementById(elementId).getContext('2d');

        // Global Options
        Chart.defaults.global.defaultFontFamily = 'Lato';
        Chart.defaults.global.defaultFontSize = 18;
        Chart.defaults.global.defaultFontColor = '#777';

        var massPopChart = new Chart(myChart1, {
        type:chartType, // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels: dataLables,
            datasets:[{
            label:'Population',
            data: dataValues,
            //backgroundColor:'green',
            backgroundColor: dataColors,
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:3,
            hoverBorderColor:'#000'
            }]
        },
        options:{
            // title:{
            // display:true,
            // text:'Largest Cities In Massachusetts',
            // fontSize:25,
            // responsive: true
            // },
            legend:{
            display:true,
            position:'right',
            labels:{
                fontColor:'#000'
            }
            },
            layout:{
            padding:{
                left:50,
                right:0,
                bottom:0,
                top:0
            }
            },
            tooltips:{
            enabled:true
            }
        }
        });
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
    @yield('js')
@stop
