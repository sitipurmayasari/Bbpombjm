@extends('layouts.pr')
@section('breadcrumb')
<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Kalender Agenda</li>
    </ol>
  </nav>
{{-------------------------------------- kalender -------------------------------------------------------}}
<link rel="stylesheet" href="{{asset('assets/css/fullcalendar/packages/core/main.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/fullcalendar/packages/daygrid/main.css')}}" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<style>
a {
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease; }
  a, a:hover {
    text-decoration: none !important; }

.content {
  padding: 7rem 0; }

h2 {
  font-size: 20px; }

.form-control:active, .form-control:focus {
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none; }

#calendar {
  margin: 0 auto; }
  #calendar .fc-view-container {
    background-color: #fff;
    -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2); }
  #calendar .fc-toolbar.fc-header-toolbar .fc-center {
    display: block; }

/* #calendar-container {
  position: fixed;
  top: 0;
  left: 20px;
  right: 20px;
  bottom: 20px; } */

.fc-header-toolbar {
  /*
    the calendar will be butting up against the edges,
    but let's scoot in the header's buttons
    */
  padding-top: 1em;
  padding-left: 1em;
  padding-right: 1em; }

@media (max-width: 767.98px) {
  .fc-toolbar {
    display: block !important;
    text-align: center; }
    .fc-toolbar .fc-center {
      display: block;
      margin-top: 20px;
      margin-bottom: 20px; } }

</style>
@endsection
@section('content')
    <div id='calendar-container'>
        <div id='calendar'></div>
    </div>
@endsection

@section('footer')
{{-- calendar script --}}
<script src="{{asset('assets/css/fullcalendar/packages/core/main.js')}}"></script>
<script src="{{asset('assets/css/fullcalendar/packages/interaction/main.js')}}"></script>
<script src="{{asset('assets/css/fullcalendar/packages/daygrid/main.js')}}"></script>
<script src="{{asset('assets/css/fullcalendar/packages/timegrid/main.js')}}"></script>
<script src="{{asset('assets/css/fullcalendar/packages/list/main.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      height: 'parent',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
      },
      defaultView: 'dayGridMonth',
      defaultDate: new Date(),
    //   navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: 
      [
        { title: '2 events in 1 day',
        url: '{{ route('calendars.lihat', ['1']) }}',
        start: '2021-11-01',
        end: '2021-11-01'
      },
      {
        title: '1 day Event',
        url: '{{ route('calendars.lihat', ['1']) }}',
        start: '2021-11-03',
        end: '2021-11-03'
      },
      {
        title: '2 events in 1 day',
        url: '{{ route('calendars.lihat', ['2']) }}',
        start: '2021-11-01',
        end: '2021-11-01'
      },
      {
        title: 'Long Event',
        url: '{{ route('calendars.lihat', ['2']) }}',
        start: '2021-11-07',
        end: '2021-11-10'
      },
    ]
      // function(start, end, callback) {
      //       // var mydata = {
      //       //   action: "fw_ajax_callback",
      //       //   subaction: "get_myappointments",
      //       // };
      //       $.ajax({
      //         url: "{{route('calendars.getData') }}",
      //         type: 'GET',
      //         // data: mydata,
      //         dataType: 'json',
      //         success: function(response) {
      //             var events =   
      //                                 [
      //                     { title: '2 events in 1 day',
      //                     url: '{{ route('calendars.lihat', ['1']) }}',
      //                     start: '2021-11-01',
      //                     end: '2021-11-01'
      //                   },
      //                   {
      //                     title: '1 day Event',
      //                     url: '{{ route('calendars.lihat', ['1']) }}',
      //                     start: '2021-11-03',
      //                     end: '2021-11-03'
      //                   },
      //                   {
      //                     title: '2 events in 1 day',
      //                     url: '{{ route('calendars.lihat', ['2']) }}',
      //                     start: '2021-11-01',
      //                     end: '2021-11-01'
      //                   },
      //                   {
      //                     title: 'Long Event',
      //                     url: '{{ route('calendars.lihat', ['2']) }}',
      //                     start: '2021-11-07',
      //                     end: '2021-11-10'
      //                   },
      //                 ];
      //             if (!!response) {
      //               for (let index = 0; index < response.length; index++) {
      //                 // alert(response[index]['date_from']);
      //                 // events.push({
      //                 //     title: response[index]['titles'],
      //                 //     start: response[index]['date_from'],
      //                 //     end: response[index]['date_to']
      //                 //   });
                      
      //               }
                    
      //             }
      //             console.log("Haloo events "+events);
      //             callback(events);
      //         }

      //       });
      //   }
    });

    calendar.render();
  });

</script>
@endsection
