<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Update Item
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group mb-4">
                                <label for="name">Item Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Item Name" value="">
                                <span class="form-text small text-danger"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="category-image">
                                    Main Image
                                    <br>
                                    <small class="text-muted">Your image needs to be at least 500×500 pixels. You can apply image cropping in Settings once the item is added.</small>
                                </label>
                                <input type="file" id="main-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg">
                                <img src="/images/placeholder-dark.jpg" alt="" id="main-image-preview" name="image" class="rounded image-xl">
                            </div>
                            <div class="form-group mb-4">
                                <label for="additional-image">
                                    Additional images
                                </label>
                                <input type="file" id="additional-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg">
                                <img src="/images/placeholder-dark.jpg" alt="" id="additional-image-preview" name="image" class="rounded image-xl">
                            </div>
                            <div class="form-group mb-4">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="3" placeholder="Item Description" id="description"></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="category">Category</label>
                                <select class="select2_demo_2 form-control" style="width: 100%" id="category" name="parent">
                                    <option value="0">Root</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="brand">Brand</label>
                                <select class="select2_demo_2 form-control" style="width: 100%" id="brand" name="parent">
                                    <option value="0">Root</option>
                                </select>
                            </div>

                            <a href="/grocery/item" class="btn btn-default">Discard</a>
                            <button type="submit" class="btn btn-accent">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GroceryItemEdit"
    }
</script>

<style scoped>

</style>
