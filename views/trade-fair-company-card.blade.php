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
		@if($description = TradeFair::getCompanyDescription($company))
			<p class="tf-company-description">{{$description}}</p>
		@endif
	</div>
	<div class="tf-company-card-footer">
		@if($conferenceLink = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_CONFERENCE_LINK))
			<a class="tf-link tf-contact" rel="noopener noreferrer" href="{{esc_attr($conferenceLink)}}" target="_blank">
				<?= __('Contact now', 'trade_fair')?>
			</a>
		@endif
		@if($website = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_WEBSITE))
			<a class="tf-link tf-know-more" rel="noopener noreferrer" href="{{esc_attr__($website)}}" target="_blank">
				<?php echo __('Learn More', 'trade_fair')?>
			</a>
		@endif
		@if($brochure = carbon_get_user_meta($company->id, TradeFair\CarbonFields\UserMeta::COMPANY_SALES_BROCHURE))
			<a class="tf-link tf-sales-brochure" rel="noopener noreferrer" href="{{esc_attr__(wp_get_attachment_url($brochure))}}" target="_blank">
				<?php echo __('Download sales brochure', 'trade_fair')?>
			</a>
		@endif
	</div>
</div>



