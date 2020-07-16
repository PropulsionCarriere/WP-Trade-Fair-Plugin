@extends('layouts.dashboard')

@section('main')
	<h1>Your company's profile</h1>
	<div class="tf-profile-form-wrapper">
		@if(count(TradeFair::flash()->get('tf-profile-success')) > 0)
			@foreach(TradeFair::flash()->get('tf-profile-success') as $message)
				<p class="tf-success">{{__($message)}}</p>
			@endforeach
		@endif
		<form target="" action="" method="post">
			<div class="tf-form-row">
				@include('partials.fields.user-meta-input',[
					'name' => \TradeFair\CarbonFields\UserMeta::COMPANY_NAME,
					'label' => 'Company\'s name',
				])
			</div>
			<div class="tf-form-row">
				@include('partials.fields.textarea',[
					'name' => \TradeFair\CarbonFields\UserMeta::COMPANY_DESC,
					'label' => 'Company\'s description',
					'value' => carbon_get_user_meta(wp_get_current_user()->ID, \TradeFair\CarbonFields\UserMeta::COMPANY_DESC)
				])
				@include('partials.fields.media',[
					'name' => \TradeFair\CarbonFields\UserMeta::COMPANY_LOGO,
					'label' => 'Select a logo',
					'class' => "w-25 ml-2",
					'id' => carbon_get_user_meta(wp_get_current_user()->id, \TradeFair\CarbonFields\UserMeta::COMPANY_LOGO)
				])
			</div>
			<div class="tf-form-row">
				@include('partials.fields.user-meta-input',[
					'name' => \TradeFair\CarbonFields\UserMeta::COMPANY_WEBSITE,
					'label' => 'Website link',
				])
				<div class="ml-2"></div>
				@include('partials.fields.user-meta-input',[
					'name' => \TradeFair\CarbonFields\UserMeta::COMPANY_CONFERENCE_LINK,
					'label' => 'Conference link',
				])
			</div>
			<div class="tf-form-row" style="max-width: 200px">
				@include('partials.fields.media',[
					'name' => \TradeFair\CarbonFields\UserMeta::COMPANY_SALES_BROCHURE,
					'label' => 'Select sales brochure',
					'id' => carbon_get_user_meta(wp_get_current_user()->id, \TradeFair\CarbonFields\UserMeta::COMPANY_SALES_BROCHURE)
				])
			</div>
			<input type="submit" value="{{__('Update')}}">
		</form>
	</div>
@endsection
