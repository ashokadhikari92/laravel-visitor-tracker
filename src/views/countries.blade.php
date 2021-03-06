@extends('visitstats::layout')

@section('visitortracker_content')
<div class="row">
	<div class="col-md-12">
		<h5>{{ $visitortrackerSubtitle }}</h5>

		<table class="table table-sm table-striped fs-1">
			<thead>
				<th>Country</th>
				<th>Unique Visitors</th>
				<th>Visits</th>
				<th>Last Visit</th>
			</thead>

			<tbody>
				@foreach ($visits as $visit)
					<tr>
						<td>
							@if ($visit->country_code)
								@if (file_exists(public_path('vendor/visitortracker/icons/flags/'.$visit->country_code.'.png')))
									<img class="visitortracker-icon"
										src="{{ asset('/vendor/visitortracker/icons/flags/'.$visit->country_code.'.png') }}"
										title="{{ $visit->country }}"
										alt="{{ $visit->country_code }}">
								@else
									<img class="visitortracker-icon"
										src="{{ asset('/vendor/visitortracker/icons/flags/unknown.png') }}"
										title="Unknown">
								@endif

								{{ $visit->country }}
							@else
								<img class="visitortracker-icon"
									src="{{ asset('/vendor/visitortracker/icons/flags/unknown.png') }}"
									title="Unknown">
								
								Unknown
							@endif
						</td>
							
						<td>
							{{ $visit->visitors_count }}
						</td>

						<td>
							{{ $visit->visits_count }}
						</td>

						<td>
							@include('visitstats::_last_visit')
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{{ $visits->links() }}
	</div>
</div>
@endsection