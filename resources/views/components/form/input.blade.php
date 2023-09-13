@props([ 'label'=>'' , 'name' , 'placeholder' , 'type'=>'text' , 'value'=>''
])

<div class="mb-3">
    <label for="">{{$label}}</label><br />
    <input type="{{$type}}" name="{{$name}}" placeholder="{{$placeholder}}"
     @class([ 'form-control' , 'is-invalid'=>$errors->has($name),
    ]),
    {{ $attributes }},
    value="{{ old($name , $value) }}">
    @error($name)
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
<!-- {{ $attributes }} -->
