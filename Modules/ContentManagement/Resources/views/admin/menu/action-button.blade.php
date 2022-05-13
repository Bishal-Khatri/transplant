<button class="btn btn-sm btn-link edit_btn mr-2"
        style="color: #fff;"
        data-level="{{$level}}"
        data-target="{{$data->target}}"
        data-custom_css="{{$data->custom_css}}"
        data-alt_text="{{$data->alt_text}}"
        data-post="{{$data->post_id}}"
        data-category="{{$data->category_id}}"
        data-image="{{$data->image}}"
        data-title="{{$data->display_name}}"
        data-id="{{$data->id}}">
    <i class="fa fa-edit"></i>
</button>

<button
    style="color: #fff;"
    class="btn btn-default btn-sm delete_btn" data-id="{{$data->id}}">
    <i class="fa fa-trash"></i>
</button>
