@extends('layouts.default')
@section('content')

@if($errors->any())
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert">&times;</a>
  <strong> Update: </strong> {{$errors->first()}}.
</div> <!--end of error message -->
@endif

<h3>Booking ID: {{$data->bookingID}}</h3>
<h3>For User: {{$data->primaryUser}}</h3>
<h3>Transfer on: {{$data->transferin}}</h3>
<h3>Transfer To: {{$data->forBranch}}</h3>
<h3>Current Location: {{$kitdata->location}}</h3>
<h3>Last Known User:</h3>

{{Form::open(['url' => 'transfer/'.$data->bookingID.'/edit2']) }}

@if($kitdata->location == 'intransit')
<input type="submit" name="arrived"  value="Confirm Transfer Has Been Received">

@elseif($kitdata->location !== $data->forBranch)
<input type="submit" name="intransit"  value="Confirm Transfer Has Been Sent">
{{Form::close()}}

@endif

@stop
