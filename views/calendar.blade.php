@extends('layout.default')

@section('title', $L('Calendar'))
@section('activeNav', 'calendar')
@section('viewJsName', 'calendar')

@push('pageScripts')
	<script src="{{ $U('/node_modules/fullcalendar/dist/fullcalendar.min.js?v=', true) }}{{ $version }}"></script>
	@if(!empty($L('fullcalendar_locale') && $L('fullcalendar_locale') != 'x'))<script src="{{ $U('/node_modules', true) }}/fullcalendar/dist/locale/{{ $L('fullcalendar_locale') }}.js?v={{ $version }}"></script>@endif
@endpush

@push('pageStyles')
	<link href="{{ $U('/node_modules/fullcalendar/dist/fullcalendar.min.css?v=', true) }}{{ $version }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
	<div class="col">
		<h1>
			@yield('title')
			<a id="ical-button" class="btn btn-outline-dark" href="#">
				<i class="fas fa-calendar-plus"></i>&nbsp;{{ $L('Share/Integrate calendar (iCal)') }}
			</a>
		</h1>
	</div>
</div>

<script>
	var fullcalendarEventSources = {!! json_encode(array($fullcalendarEventSources)) !!}
</script>

<div class="row">
	<div class="col">
		<div id="calendar"></div>
	</div>
</div>
@stop
