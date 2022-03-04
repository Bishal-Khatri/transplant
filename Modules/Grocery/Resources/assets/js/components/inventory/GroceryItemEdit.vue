<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Item Details
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="" enctype="multipart/form-data" @submit.prevent="saveItem">
                            <div class="form-group mb-4">
                                <label for="name">Item Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Item Name" v-model="item.name">
                                <span class="form-text small text-danger"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="name">SKU</label>
                                <input type="text" class="form-control" id="sku" placeholder="Item SKU" v-model="item.sku">
                                <span class="form-text small text-danger"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="category-image">
                                    Main Image
                                    <br>
                                    <small class="text-muted">Your image needs to be at least 500×500 pixels. Choose new file or Replace</small>
                                </label>
                                <input type="file" id="main-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg">
                                <img v-if="item.main_image_medium" :src="'/storage/'+item.main_image_medium" alt="" name="image" class="rounded image-xl">
                                <img v-else src="/images/placeholder-dark.jpg" alt="" id="main-image-preview" name="image" class="rounded image-xl">
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
                                <div class="panel panel-filled">
                                    <div class="panel-body">
                                        <textarea class="form-control" rows="3" placeholder="Item Description" v-model="item.description" id="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="category">Category</label>
                                <select class="select2_demo_2 form-control" style="width: 100%" id="category" name="parent">
                                    <option value="0">Root</option>
                                    <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="brand">Brand</label>
                                <select class="select2_demo_2 form-control" style="width: 100%; color:white" id="brand">
                                    <option value="0">Root</option>
                                    <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
                                </select>
                            </div>
                            <a href="/grocery/item" class="btn btn-default">Discard</a>
                            <button type="submit" class="btn btn-accent">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Inventory Details
                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import InventoryService from "../../../services/InventoryService";

    export default {
        name: "GroceryItemEdit",
        data: () => ({
            item_id: "",
            item:''
        }),
        props: [
            'brands',
            'categories',
            'itemId',
        ],
        computed:{
        },
        async mounted(){
            await this.getItemDetails();
        },
        methods: {
            async getItemDetails() {
                const response = await InventoryService.getItemDetails(this.itemId);
                this.item = response.data.data.item_data;
            },
            async saveItem() {
                console.log(this.item);
                return;
                try {
                    let formData = new FormData();

                    formData.append("id", this.id);
                    formData.append("item_name", this.item_name);
                    formData.append("sku", this.sku);
                    if(this.item_image){
                        formData.append("main_image", this.item_image, this.item_image.name);
                    }

                    const response = await InventoryService.createItem(formData);
                    if (response.data.error === false) {
                        $("#create-item-dialog").modal("hide");
                        this.clearForm();
                        // Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    // this.errors.record(error.response.data);
                    // Errors.Notification(error.response);
                }
                EventBus.$emit('itemAdded');
            },

            handelImage(event){
                this.item_image= event.target.files[0];
            },
            clearForm() {
                this.id = this.item_name = this.sku = this.category = this.brand = '';
            },
        },
    }
</script>

<style scoped>

</style>
