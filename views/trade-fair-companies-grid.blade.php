@if(count($exhibitors) == 0)
	<div class="tf-no-companies"><?= __('There are currently no companies registered', 'trade_fair')?></div>
@else
	<div class="tf-companies-grid grid-{{$n_cols??2}}">
		@if(count($exhibitors) > $n_cols && $period = TradeFair::schedule()->getCurrentPeriod())
			@include('trade-fair-rotating-companies-list',[
				'exhibitors' => $exhibitors,
				'offset' => round($period->relativeTimeElapsed()*count($exhibitors))
			])
		@else
			@include('trade-fair-static-companies-list',['exhibitors' => $exhibitors])
		@endif
	</div>
@endif
