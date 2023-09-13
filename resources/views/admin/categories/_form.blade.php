@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>

</div>
@endif


<x-form.input type="text" name="name" placeholder="Name" label="Category Name" value="{{$categories->name}}" />

<div class="mb-3">
    <label for="">Category Parent</label><br />
    <select name="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
        <option value="{{$parent->id}}" @if($parent->id == old( 'parent_id' , $categories->parent_id)) selected @endif>{{$parent->name}}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" placeholder="Description">{{old('description', $categories->description)}}</textarea>
</div>

<div class="mb-3">
    <label for="image">Image</label><br />
    <input type="file" name="image" id="image" class="form-control" accept="image/*">
    @if($categories->image)
    <img src="{{asset('storage/' . $categories->image)}}" alt="" height="50">
    @endif
</div>


<div class="mb-3">
    <label for="">Status</label>
    @foreach($status_option as $key => $value)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="status_{{$key}}" value="{{$key}}"  @if($key == old( 'status' , $categories->status)) checked @endif>
        <label class="form-check-label" for="status_{{$key}}">{{$value}}</label>
    </div>
    @endforeach
</div>



<button type="submit" class="btn btn-primary mt-4 mb-3">{{$button ?? 'save'}}</button>