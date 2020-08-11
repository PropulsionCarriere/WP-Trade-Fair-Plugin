<div class="tf-company-card">
	@if($thumbnailId = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_LOGO))
		<div class="tf-company-logo-wrapper">
			<img class="tf-company-logo"
				 src="{{\TradeFair::core()->image()->thumbnail( $thumbnailId, 200, 200, $crop = false )}}"
				 alt="{{carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_NAME)}} logo"/>
		</div>
	@endif
	<div class="tf-company-card-body">
		@if($name = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_NAME))
			<p class="tf-company-name">{{$name}}</p>
		@endif
		@if($description = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_DESC))
			<p class="tf-company-description">{{$description}}</p>
		@endif
	</div>
	<div class="tf-company-card-footer">
		@if($conferenceLink = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_CONFERENCE_LINK))
			<a class="tf-link tf-contact" rel="noopener noreferrer" href="{{esc_attr($conferenceLink)}}">{{__('Contact now')}}</a>
		@endif
		@if($website = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_WEBSITE))
			<a class="tf-link tf-know-more" rel="noopener noreferrer" href="{{esc_attr__($website)}}">{{__('Learn More')}}</a>
		@endif
		@if($brochure = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_SALES_BROCHURE))
			<a class="tf-link tf-sales-brochure" rel="noopener noreferrer" href="{{esc_attr__($brochure)}}">{{__('Download sales brochure')}}</a>
		@endif
	</div>
</div>



