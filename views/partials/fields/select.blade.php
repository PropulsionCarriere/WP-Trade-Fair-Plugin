
<div class="tf-input-field">
	<label for="{{$name}}">{{$label}}</label>
	<select name="{{$name}}" id="{{$name}}">
		@if(!isset($selected)) <option value="" disabled>{{__('Select an option')}}</option> @endif
		@foreach($options as $option)
			<option value="{{$option['value']}}"
			@isset($selected)
				@if($selected == $option['value'])
					selected
				@endif
			@endif
			>
				{{$option['label']}}
			</option>
		@endforeach
		@if(count($options) == 0)
			<option disabled>{{__('No options')}}</option>
		@endif
	</select>
	@include('partials.fields.field-validation-error',['name'=>$name])
</div>
