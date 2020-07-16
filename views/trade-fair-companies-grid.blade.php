<div class="tf-companies-grid grid-{{$n_cols??2}}">
	@foreach($exhibitors as $exhibitor)
		@php TradeFair::render('trade-fair-company-card',['company'=>$exhibitor]); @endphp
	@endforeach
</div>
