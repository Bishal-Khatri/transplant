@extends('contentmanagement::layouts.admin')
@section('css')
    <style>
        .dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

        .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
        .dd-list .dd-list { padding-left: 30px; }
        .dd-collapsed .dd-list { display: none; }

        .dd-item,
        .dd-empty,
        .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

        .dd-handle {
            display: block;
            height: 35px;
            margin: 5px 0;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            /*background: #fafafa;*/
            background: #2A3F54 !important;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:         linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box; -moz-box-sizing: border-box;
        }
        .dd-handle:hover { color: #2ea8e5; background: #fff; }

        .dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
        .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
        .dd-item > button[data-action="collapse"]:before { content: '-'; }

        .dd-placeholder,
        .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
        .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }

        .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
        .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
        }

        /**
         * Nestable Extras
         */

        .nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

        #nestable-menu { padding: 0; margin: 20px 0; }

        #nestable-output,
        #nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
            background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
            background:         linear-gradient(top, #bbb 0%, #999 100%);
        }
        #nestable2 .dd-handle:hover { background: #bbb; }
        #nestable2 .dd-item > button:before { color: #fff; }

        @media only screen and (min-width: 700px) {

            .dd { float: left; width: 100%; }
            .dd + .dd { margin-left: 2%; }

        }

        .dd-hover > .dd-handle { background: #2ea8e5 !important; }

        /**
         * Nestable Draggable Handles
         */

        .dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:         linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box; -moz-box-sizing: border-box;
        }
        .dd3-content:hover { color: #2ea8e5; background: #fff; }

        .dd-dragel > .dd3-item > .dd3-content { margin: 0; }

        .dd3-item > button { margin-left: 30px; }

        .dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:         linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
        .dd3-handle:hover { background: #ddd; }

        /**
         * Socialite
         */

        .socialite { display: block; float: left; height: 35px; }
        .list-group-item{
            height: 30px;
        }
    </style>
@stop
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Menu Management</h3>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Select Menu</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="" style="color: #5A738E;" href="#" data-toggle="modal" data-target=".bs-example-modal-lg">Create New Menu</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Create New Menu</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('cms.menu.create') }}" method="post">
                                        @csrf
                                        <div class="modal-body m-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label>Menu Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter menu name" required name="title">
                                                        <span class="form-text text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="menu" id="" class="form-control select-menu">
                                        @if(isset($menus) AND !blank($menus))
                                            <option value="">Select Menu</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}">{{ $menu->title ?? '' }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-link"></i> Links</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#link" role="tab" aria-controls="link" aria-selected="true">External Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#page" role="tab" aria-controls="page" aria-selected="false">Pages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="false">Categories</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="link" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12 p-4">
                                            <form action="{{ route('cms.menu.save') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="display_name">Display Name <span class="text-danger">*</span></label>
                                                    <input type="text" id="display_name" class="form-control" name="display_name" required value="{{ old('display_name') }}"/>
                                                    @error('display_name')
                                                    <span class="form-text small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="link">Link <span class="text-danger">*</span></label>
                                                    <input type="text" id="link" class="form-control" name="link" placeholder="https://example.com" required value="{{ old('link') }}"/>
                                                    @error('link')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <button class="btn btn-sm btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="page" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-group" style="max-height: 370px;overflow-y: scroll">
                                                @if(isset($pages) AND !blank($pages))
                                                    @foreach($pages as $page)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{Illuminate\Support\Str::limit($page['title'], 25, $end='...')}}
                                                            <form action="{{ route('cms.menu.addPageToMenu') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="menu_id" value="{{ $selected_menu->id }}">
                                                                <input type="hidden" name="page_id" value="{{ $page['id'] }}">
                                                                <button type="submit" class="btn btn-xs btn-default mt-1">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        No categories found
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-group" style="max-height: 370px;overflow-y: scroll">
                                                @if($categories->count())
                                                    @foreach($categories as $category)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{Illuminate\Support\Str::limit($category['name'], 25, $end='...')}}
                                                            <form action="{{ route('cms.menu.addCategoryToMenu') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="menu_id" value="{{ $selected_menu->id }}">
                                                                <input type="hidden" name="category_id" value="{{ $category['id'] }}">
                                                                <button type="submit" class="btn btn-xs btn-default mt-1">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        No categories found
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Menu Structure: <code class="ml-3">{{ $selected_menu->title ?? 'Not-Available' }}</code></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(isset($menu_items) AND !blank($menu_items))
                                        <div class="dd" id="nestable2">
                                            <ol class="dd-list">
                                                @foreach($menu_items as $value)
                                                    <li class="dd-item" data-id="{{ $value->id }}">
                                                        <div class="dd-handle"> <span class="drag-indicator"></span>
                                                            <div class="drag-title float-left">
                                                                {{ $value->display_name }}
                                                            </div>
                                                            <div class="dd-nodrag btn-group float-right">
                                                                @include('contentmanagement::admin.menu.action-button', ['data' => $value, 'level' => 1])
                                                            </div>
                                                        </div>
                                                        @if ($value->children->count())
                                                            <ol class="dd-list">
                                                                @foreach($value->children as $child)
                                                                    <li class="dd-item" data-id="{{ $child->id }}">
                                                                        <div class="dd-handle"> <span class="drag-indicator"></span>
                                                                            <div class="drag-title float-left">
                                                                                {{ $child->display_name }}
                                                                            </div>
                                                                            <div class="dd-nodrag btn-group float-right">
                                                                                @include('contentmanagement::admin.menu.action-button', ['data' => $child, 'level' => 2])
                                                                            </div>
                                                                        </div>
                                                                        @if ($child->children->count())
                                                                            <ol class="dd-list">
                                                                                @foreach($child->children as $subchild)
                                                                                    <li class="dd-item" data-id="{{ $subchild->id }}">
                                                                                        <div class="dd-handle"> <span class="drag-indicator"></span>
                                                                                            <div class="drag-title float-left">
                                                                                                {{ $subchild->display_name }}
                                                                                            </div>
                                                                                            <div class="dd-nodrag btn-group float-right">
                                                                                                @include('contentmanagement::admin.menu.action-button', ['data' => $subchild, 'level' => 3])
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @else
                                        <p>No items available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-0">
                            <button class="btn btn-primary btn-sm float-right saveMenuOrder">Save Order</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Menu</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <p>You are about to delete this menu permanently. Continue?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary btn-xs" data-dismiss="modal">Discard</a>
                        <form action="{{ route('cms.menu.delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="menu_id" id="delete_input">
                            <button type="submit" class="btn btn-primary btn-xs">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->

        <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <form action="{{ route('cms.menu.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="edit_id" type="hidden" name="menu_id" class="form-control">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_title" class="col-form-label">Title</label>
                                        <input id="edit_title" type="text" name="display_name" placeholder="Menu Title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_alt_text" class="col-form-label">Alt text</label>
                                        <input id="edit_alt_text" type="text" name="alt_text" placeholder="Alt text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_target" class="custom-control custom-checkbox">
                                            <input type="checkbox" id="edit_target" name="target" value="_blank" class="custom-control-input">
                                            <span class="custom-control-label">Open menu in new tab?</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="custom_css" class="col-form-label">Custom CSS</label>
                                        <textarea name="custom_css" id="edit_custom_css" cols="30" rows="3" class="form-control" placeholder="Enter custom CSS"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal">Discard</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
        const selected_menu = @json($selected_menu);

        $('.dd').nestable({
            maxDepth:3
        });

        $('.select-menu').on('change', function(){
            $.ajax({
                type: "POST",
                url: "{{ route('cms.menu.select') }}",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {menu_id:this.value},
                success: function (msg) {
                    window.location.reload();
                }
            });
        });

        $('.saveMenuOrder').on('click', function(){
            $.ajax({
                type: "POST",
                url: "{{ route('cms.menu.saveOrder') }}",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data:$('.dd').nestable('serialize')},
                success: function (msg) {
                    // console.log(msg)
                    window.location.reload();
                }
            });
        });

        $('.delete_btn').on('click', function(e){
            e.preventDefault();
            let menu_id = $(this).data("id");
            $("#delete_input").val(menu_id);
            $("#deleteModal").modal('show');
        });

        $('.edit_btn').on('click', function(){
            let level = $(this).data('level');
            if(level === 1){
                // hide page and category
                $('#select_category, #select_post').hide();
            }else if(level === 2){
                // show page and category
                $('#select_category, #select_post').show();
            }else{
                // hide category
                $('#select_category').hide();
            }
            let post_id = $(this).data("post");
            if (post_id !== 0) {
                $("#edit_post").val(post_id);
            }
            let category_id = $(this).data("category");
            if (category_id !== 0) {
                $("#edit_category").val(category_id);
            }
            $("#edit_id").val($(this).data("id"));
            $("#edit_title").val($(this).data("title"));
            $("#edit_alt_text").val($(this).data("alt_text"));
            $("#edit_custom_css").val($(this).data("custom_css"));
            if ($(this).data("target") === '_blank') {
                $("#edit_target").prop('checked', 'true');
            }
            if ($(this).data("image") !== '') {
                $("#edit_image_url").prop('src', window.ASSET_URL+$(this).data("image"));
            }else{
                $("#edit_image_url").prop('src', '{{ asset('images/placeholder-dark.jpg') }}');
            }
            $("#editModal").modal('show');
        });

        $("#edit_image").on('change', function (event) {
            $("#edit_image_url").prop('src', URL.createObjectURL(event.target.files[0]));
        });

        {{--$('.add_page').on('click', function(){--}}
            {{--let post_id = $(this).data("post_id");--}}
            {{--$.ajax({--}}
                {{--type: "POST",--}}
                {{--url: "{{ route('cms.menu.addPageToMenu') }}",--}}
                {{--headers: {--}}
                    {{--'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')--}}
                {{--},--}}
                {{--data: {post_id:post_id, menu_id: selected_menu.id},--}}
                {{--success: function (response) {--}}
                    {{--if (response === 'success'){--}}
                        {{--window.location.reload();--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

        $(".modal").on("hidden.bs.modal", function () {
            $("#edit_id").val("");
            $("#edit_title").val("");
            $("#edit_image_url").prop('src', '{{ asset('images/placeholder-dark.jpg') }}');
            $("#edit_target").prop('checked', false);
            $("#delete_input").val("");
        });

        $("#select_category").on("change", function () {
            $("#edit_post").val("");
        });
        $("#select_post").on("change", function () {
            $("#edit_category").val("");
        })
    </script>
@endsection
