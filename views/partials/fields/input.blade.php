<div class="tf-input-field">
	<label for="{{$name}}">{{__($label)}}</label>
	<input name="{{$name}}"
		   value="{{esc_attr__(TradeFair::oldInput()->get($name,null)??$value??"")}}"
		   type="{{$type??"text"}}"
		   id="{{$name}}"/>
	@include('partials.fields.field-validation-error',['name'=>$name])
</div>
