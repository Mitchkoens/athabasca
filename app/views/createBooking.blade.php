@extends('layouts.default')
@section('content')
<?php
    $rec = Session::get('rec',NULL);
    $kits = DB::table('kitType')->lists('kitType');
    $users = DB::table('users')->lists('username');
?>

<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Select a Date Range</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker("option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  $(function() { $("#to" ).datepicker( "option", "dateFormat", "D dd M yy" )});
  $(function() { $("#from" ).datepicker( "option", "dateFormat", "D dd M yy" )});
  $(function() { $( "#from" ).datepicker( "setDate", +1 )});
  $(function() { $( "#to" ).datepicker( "setDate", +14 )});
  $(function() { $( "#from" ).datepicker( "option", "minDate", "+1d" )});
  $(function() { $( "#to" ).datepicker( "option", "minDate", "+1d" )});

  </script>
</head>

  <div class = "jumbotron">

    <h2>Select the Type of kit you want to Book(will default to Ipad Kit)</h2>
    {{Form::open(['url' => 'createbooking']) }}
    <p>{{Form::label('desKit', 'Select Kit Type: ')}}
    {{Form::select('desKit', $kits,$kit) }}</p>
    <div class="errors">{{Session::get('errors');}}</div>

  </div>
  <div class = "Booking">
    {{Form::label('branch', 'Booking Location')}}
    {{Form::select('desBranch', array('ABB'=>'ABB', 'CAL'=>'CAL','CPL'=>'CPL')) }}
    {{Form::label('eName', 'Event Name')}}
    {{Form::text('eName')}}
   </div>

    <div class = "Booking">
    {{Form::label('start', ' Booking Start Date ')}}
    <input type="text" id="from" name="from" readOnly="true">

    {{Form::label('end', 'Booking End Date')}}
    <input type="text" id="to" name="to" readOnly="true">
    </div>

    @for($i = 1; $i <= $rec; $i++)
      <div class = "Booking">
        {{Form::label($i, 'Additional Recipients: ')}}
        {{Form::select($i, $users) }}
      </div>
    @endfor
   <input type="submit" name="add"  value="Add Another Recipients">
   <input type="submit" name="create"  value="Create Booking">
   {{Form::close()}}
  </div>

</div>
@stop
