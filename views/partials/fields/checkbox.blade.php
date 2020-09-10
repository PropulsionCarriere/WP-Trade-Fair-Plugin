<div>
	<input name="{{$name}}"
		   value="{{true}}"
		   @if(TradeFair::oldInput()->get($name,$value??false))) checked @endif
		   type="checkbox"
		   id="{{$name}}"/>
	<label for="{{$name}}">{{$label}}</label>
	@include('partials.fields.field-validation-error',['name'=>$name])
</div>
