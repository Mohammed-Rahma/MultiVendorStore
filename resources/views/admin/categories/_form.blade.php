@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>

</div>
@endif



<div class="mb-3">
    <label for="">Category Name</label><br />
    <input type="text" name="name" placeholder="name" @class([ 'form-control' , 'is-invalid'=>$errors->has('name'),
    ])
    value="{{ old('name' , $categories->name) }}">
    @error('name')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="">Category Parent</label><br />
    <select name="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
        <option value="{{$parent->id}}" @selected(old('$parent_id', $categories->parent_id) == $parent->id)>{{$parent->name}}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="description">Description</label>
    <textarea class="form-control" placeholder="Description">{{ old('description', $categories->description) }}</textarea>
</div>

<div class="mb-3">
    <label for="">Image</label><br />
    <input type="file" name="image" class="form-control" accept="image/*">
    @if($categories->image)
    <img src="{{asset('storage/' . $categories->image)}}" alt="" height="50">
    @endif
</div>

<div>
    <label for="">Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" @checked(old('stutas' , $categories->status) == 'active')>
        <label class="form-check-label" for="exampleRadios1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived" @checked(old('stutas' , $categories->status) == 'archived')>
        <label class="form-check-label" for="exampleRadios2">
            Archived
        </label>
    </div>
</div>

<button type="submit" class="btn btn-primary mt-4 mb-3">{{$button ?? 'save'}}</button>