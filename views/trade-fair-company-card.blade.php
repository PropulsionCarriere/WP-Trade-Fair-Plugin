<div class="tf-company-card">
	<a href="{{TradeFair::getExhibitorProfileURLByID($company->id)}}">
		@if($thumbnail = TradeFair::getExhibitorLogoByID($company->id,200,200))
			<div class="tf-company-logo-wrapper">
				{!! $thumbnail !!}
				<span class="tf-type"><?= carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_IS_PEDAGOGICAL)?__("SPE", 'trade_fair'):__("PE", 'trade_fair')?></span>
			</div>
		@endif
		<div class="tf-company-card-body">
			@if($name = TradeFair::getExhibitorNameByID($company->id))
				<p class="tf-company-name">{{$name}}</p>
			@endif
		</div>
	</a>
</div>



