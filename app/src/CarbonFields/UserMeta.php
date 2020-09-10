<?php


namespace TradeFair\CarbonFields;


class UserMeta
{
	const COMPANY_DESC_DEFAULT = "trade_fair_company_description";
	const COMPANY_DESC_EN = "trade_fair_company_description_en";
	const COMPANY_NAME = "trade_fair_company_name";
	const COMPANY_LOGO = "trade_fair_logo";
	const COMPANY_IS_PEDAGOGICAL = "trade_fair_is_academic";
	const COMPANY_LOCATION = "trade_fair_company_country";
	const COMPANY_LOCATION_OPTIONS = [
		'Canada' => 'Canada',
		'USA' => 'United-States',
		'Europe' => 'Europe',
		'Other' => 'Other'
	];
	const COMPANY_WEBSITE = "trade_fair_company_website";
	const COMPANY_CONFERENCE_LINK = "trade_fair_conference_link";
	const COMPANY_ACCOUNTING_LINK = "trade_fair_accounting_company_link";
	const COMPANY_SALES_BROCHURE = "trade_fair_sales_brochure";
}
