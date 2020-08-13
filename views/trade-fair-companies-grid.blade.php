<div class="tf-companies-grid grid-{{$n_cols??2}}">
	@foreach($exhibitors as $exhibitor)
		@if(carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_NAME))
			@php TradeFair::render('trade-fair-company-card',['company'=>$exhibitor]); @endphp
		@endif
	@endforeach
</div>
