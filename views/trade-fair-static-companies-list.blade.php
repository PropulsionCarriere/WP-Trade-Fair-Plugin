@if(count($exhibitors) == 0)
	<div class="tf-no-companies"><?= __('There are currently no companies registered', 'trade_fair')?></div>
@endif
@foreach($exhibitors as $exhibitor)
	@if(carbon_get_user_meta($exhibitor->id, TradeFair\CarbonFields\UserMeta::COMPANY_NAME))
		@php
			TradeFair::render('trade-fair-company-card',['company'=>$exhibitor]);
		@endphp
	@endif
@endforeach
