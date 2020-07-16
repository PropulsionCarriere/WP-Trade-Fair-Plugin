<div class="tf-company-card">
	<div class="tf-company-logo-wrapper">
		<img class="tf-company-logo"
			 src="{{\TradeFair::core()->image()->thumbnail( carbon_get_user_meta($company->id, 'trade_fair_logo'), 200, 200, $crop = false )}}"
			 alt="{{carbon_get_user_meta($company->id, 'trade_fair_company_name')}} logo"/>
	</div>
	<p class="tf-company-name">{{carbon_get_user_meta($company->id, 'trade_fair_company_name')}}</p>
	<p class="tf-company-description">{{carbon_get_user_meta($company->id, 'trade_fair_company_description')}}</p>
	<a class="tf-contact" rel="noopener noreferrer" href="{{esc_attr__(carbon_get_user_meta($company->id, 'trade_fair_conference_link'))}}">{{__('Contact now')}}</a>
	<a class="tf-know-more" rel="noopener noreferrer" href="{{esc_attr__(carbon_get_user_meta($company->id, 'trade_fair_company_website'))}}">{{__('Learn More')}}</a>
</div>
