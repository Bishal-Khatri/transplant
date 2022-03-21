<form method="POST" action="{{ route('grocery.category.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ isset($category_data) ? $category_data->id : null }}">
    <div class="form-group mb-4">
        <label for="name">Category Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Category Name" value="{{ isset($category_data) ? $category_data->name : old('name') }}">
        @error('name')
        <span class="form-text small text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="category-image">Image</label>
        <input type="file" id="category-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg">
        @error('image')
        <span class="form-text small text-danger">{{ $message }}</span>
        @enderror
        <img src="{{ isset($category_data->image_medium) ? Storage::url($category_data->image_medium) : asset('images/placeholder-dark.jpg') }}" alt="" id="cat-image-preview" name="image" class="rounded image-xl">
    </div>
    <div class="form-group mb-4">
        <label for="parent">Parent</label>
        <select class="select2_demo_2 form-control" style="width: 100%" id="parent" name="parent">
            <option value="0">Root</option>
            @if(isset($root_categories) AND !blank($root_categories))
                @foreach($root_categories as $value)
                    <option value="{{ $value->id }}" {{ (isset($category_data) AND  (data_get($category_data, 'parent.id') == $value->id)) ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <button type="submit" class="btn btn-default">Save</button>
    @if(isset($category_data))
        <a href="{{ route('grocery.category.index') }}" class="btn btn-default">Discard</a>
    @endif
</form>
