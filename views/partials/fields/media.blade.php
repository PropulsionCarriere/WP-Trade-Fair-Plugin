<div class="tf-input-field{{isset($class)?" ".$class:""}}">
	<label for="{{$name}}">{{__($label)}}</label>
	<div class="tf-media-upload" data-media-upload="{{$name}}">
		<input data-media-unset="{{$name}}" class="unset-button" type="button" value="X"/>
		<div class='image-preview-wrapper'>
			@if($id)
				@if($src = TradeFair::core()->image()->thumbnail( $id, 200, 200, false ))
					<img class="media-preview" src="{{$src}}" alt="company's logo"/>
				@else
					<p class="filename">
						{{basename(get_attached_file($id))}}
					</p>
				@endif
			@else
				<div class="placeholder"></div>
			@endif
		</div>
		<input id="{{$name}}" type="button"
			   @if($id) value="{{__( 'Change')}}"
			   @else value="{{__( 'Select')}}"
			   @endif/>
		<input type='hidden' name='{{$name}}' id='image_attachment_id' value='{{$id}}'>

	</div>
	@include('partials.fields.field-validation-error',['name'=>$name])
</div>
