@extends('layouts.dashboard')

@section("main")
<div class="tf-company">
	<div class="tf-company-header">
		@if($thumbnail = TradeFair::getExhibitorLogoByID($companyID,300,300))
			{!! $thumbnail !!}
		@endif
		@if($name = TradeFair::getExhibitorNameByID($companyID))
			<h1 class="tf-company-name">{{$name}}</h1>
		@endif
	</div>
	<div class="tf-company-body">
		@if($description = TradeFair::getCompanyDescriptionByID($companyID))
			<p class="tf-company-description">{{$description}}</p>
		@endif
		<div class="tf-company-links">
			<ul>
				@if($conferenceLink = carbon_get_user_meta($companyID, TradeFair\CarbonFields\UserMeta::COMPANY_CONFERENCE_LINK))
					<li><a class="tf-link tf-contact" rel="noopener noreferrer" href="{{esc_attr($conferenceLink)}}" target="_blank">
						<?= __('Talk to a salesman', 'trade_fair')?>
					</a></li>
				@endif
				@if($accountingLink = carbon_get_user_meta($companyID, TradeFair\CarbonFields\UserMeta::COMPANY_ACCOUNTING_LINK))
					<li><a class="tf-link tf-contact" rel="noopener noreferrer" href="{{esc_attr($conferenceLink)}}" target="_blank">
							<?= __('Make a transaction', 'trade_fair')?>
						</a></li>
				@endif
				@if($brochure = carbon_get_user_meta($companyID, TradeFair\CarbonFields\UserMeta::COMPANY_SALES_BROCHURE))
					<li><a class="tf-link tf-sales-brochure" rel="noopener noreferrer" href="{{esc_attr__(wp_get_attachment_url($brochure))}}" target="_blank">
						<?php echo __('Read sales brochure', 'trade_fair')?>
					</a></li>
				@endif
				@if($website = carbon_get_user_meta($companyID, TradeFair\CarbonFields\UserMeta::COMPANY_WEBSITE))
					<li><a class="tf-link tf-know-more" rel="noopener noreferrer" href="{{esc_attr__($website)}}" target="_blank">
						<?php echo __('Visit website', 'trade_fair')?>
					</a></li>
				@endif
			</ul>
		</div>
	</div>
</div>
@endsection
