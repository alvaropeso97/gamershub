<div class="widget widget-nopad">
    <div class="widget-header"> <i class="icon-list-alt"></i>
        <h3> Calendario de lanzamientos</h3>
    </div>
    <!-- /widget-header -->
    <div class="widget-content">
        <div id='calendar'>
        </div>
    </div>
    <!-- /widget-content -->
</div>

@section('script')
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: false,
                selectHelper: true,
                editable: false,
                events: [
                    @foreach($proximos_lanzamientos as $lanzamiento)
                        @php $fecha = strtotime($lanzamiento->fecha_lanzamiento); @endphp
                    {
                        title: '{{$lanzamiento->titulo}}',
                        start: new Date({{date('Y', $fecha)}}, {{date('m', $fecha)}}-1, {{date('d', $fecha)}}, 12, 0),
                        allDay: true,
                        url: '/juego/{{$lanzamiento->id}}/{{$lanzamiento->lnombre}}'
                    },
                    @endforeach
                ]
            });
        });
    </script><!-- /Calendar -->
@endsection