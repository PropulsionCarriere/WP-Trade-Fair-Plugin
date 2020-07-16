<div class="tf-input-field">
	<label for="{{$name}}">{{__($label)}}</label>
	<textarea name="{{$name}}"
			  id="{{$name}}"
			   maxlength="{{$maxLength??150}}">
		{{trim(TradeFair::oldInput()->get($name,null)??$value??"")}}
	</textarea>
	@include('partials.fields.field-validation-error',[
		'name' => $name,
	])
</div>
