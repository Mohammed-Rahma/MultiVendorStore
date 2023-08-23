<div class="mb-3">
    <label for="">Category Name</label><br />
    <input type="text" name="name" placeholder="name" class="form-control" value="{{ old('name' , $categories->name) }}">
</div>

<div class="mb-3">
    <label for="">Category Parent</label><br />
    <select name="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
        <option value="{{$parent->id}}" @selected($categories->parent_id == $parent->id)>{{$parent->name}}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="description">Description</label>
    <textarea class="form-control" placeholder="Description">{{ old('description' , $categories->description) }}</textarea>
</div>

<div class="mb-3">
    <label for="Image">Image</label><br />
    <input type="file" name="image" id="Image" class="form-control">
</div>

<div>
    <label for="">Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" @checked($categories->status == 'active')>
        <label class="form-check-label" for="exampleRadios1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived" @checked($categories->status == 'archived')>
        <label class="form-check-label" for="exampleRadios2">
            Archived
        </label>
    </div>
</div>

<button type="submit" class="btn btn-primary mt-4 mb-3">{{$button ?? 'save'}}</button>