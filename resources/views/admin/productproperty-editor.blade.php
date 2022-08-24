
<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}" id="prfields">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        @include('admin::form.error')

<input type="text" name="property.property_name" class="form-control" placeholder="Property name" ><input type="text" class="form-control" placeholder="Property Value" name="property.property_value" ><span></span>      

        @include('admin::form.help-block')

    </div>
</div>
<button class="addbttn">+</button>  
<div class="dyfields"></div>