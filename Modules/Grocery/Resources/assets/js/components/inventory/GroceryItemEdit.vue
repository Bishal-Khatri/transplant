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
                                <label for="name">Item Name <span style="font-size: 18px" class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Item Name" v-model="name" required>
                                <span class="form-text small text-danger" v-html="errors.get('name')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="name">SKU</label>
                                <input type="text" class="form-control" id="sku" placeholder="Item SKU" v-model="sku">
                                <span class="form-text small text-danger" v-html="errors.get('sku')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="service_charge">Service Charge</label>
                                <input type="text" class="form-control" id="service_charge" placeholder="eg: Rs.70 - Rs.150" v-model="service_charge">
                                <span class="form-text small text-danger" v-html="errors.get('service_charge')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="unit_size">Unit size</label>
                                <input type="text" class="form-control" id="unit_size" placeholder="eg: 1.5 kg" v-model="unit_size">
                                <span class="form-text small text-danger" v-html="errors.get('unit_size')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="main-image">
                                    Main Image <span style="font-size: 18px" class="text-danger">*</span><br>
                                    <small class="text-muted">Your image needs to be at least 500×500 pixels. Choose new file or Replace</small>
                                </label>
                                <input type="file" id="main-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg" @change="handelImage">
                                <img v-if="item_image_url" :src="item_image_url" alt="" name="image" class="rounded image-xl">
                                <img v-else src="/images/placeholder-dark.jpg" alt="" id="main-image-preview" name="image" class="rounded image-xl">
                            </div>
                            <div class="form-group mb-4">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote" rows="3" placeholder="Item Description" v-model="description" id="description"></textarea>
                                <span class="form-text small text-danger" v-html="errors.get('description')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="category">Category</label>
                                        <select class="category form-control category-select2" style="width: 100%;color:white" id="category" name="parent" v-model="category_id">
                                            <option value="0">Root</option>
                                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                        </select>
                                        <span class="form-text small text-danger" v-html="errors.get('category')"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Selected Category</h5>
                                        <p v-if="category">{{category.name}}<br>
                                            <small class="text-muted">Created: {{category.created_at}}</small>
                                        </p>
                                        <span v-else>Not-Available</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="brand">Brand</label>
                                        <select class="brand form-control brand-select2" style="width: 100%; color:white" id="brand" v-model="brand_id">
                                            <option value="0">Root</option>
                                            <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
                                        </select>
                                        <span class="form-text small text-danger" v-html="errors.get('brand')"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Selected Brand</h5>
                                        <p v-if="brand">
                                            {{brand.name}}<br>
                                            <small class="text-muted">Created: {{brand.created_at}}</small>
                                        </p>
                                        <span v-else>Not-Available</span>
                                    </div>
                                </div>
                            </div>
                            <a href="/grocery/item" class="btn btn-default">Discard</a>
                            <button class="btn btn-accent" v-if="submitting"><i class="fa fa-spinner fa-spin"></i></button>
                            <button type="submit" class="btn btn-accent" v-else>Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-filled panel-c-accent">
                    <div class="panel-heading">
                        Available Quantity
                        <div class="float-right">{{ inventory_details.available_quantity }}</div>
                    </div>
                    <div class="panel-heading">
                        Maximum Price
                        <div class="float-right">Rs. {{ inventory_details.max_price }}</div>
                    </div>
                    <div class="panel-heading">
                        Current Price
                        <div class="float-right">Rs. {{ inventory_details.current_price }}</div>
                    </div>
                    <div class="panel-heading">
                        Stock Level
                        <div class="float-right">{{ inventory_details.stock_level }}%</div>
                    </div>
                </div>
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Inventory Details
                        <button class="btn btn-default btn-xs float-right" @click.prevent="$refs.addQuantity.openDialog(item)">
                            <i class="fa fa-plus"></i> Add Quantity
                        </button>
                    </div>
                    <div class="panel-body">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Purchase Date</th>
                                <th>Initial Qty</th>
                                <th>Available Qty</th>
                                <th>Purchase Price</th>
                                <th>Selling Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="value in inventory_details.quantity" :key="value.id">
                                <td class=""><code>{{ value.purchase_date || 'n/a' }}</code></td>
                                <td class=""><code>{{ value.initial_quantity || 'n/a' }}</code></td>
                                <td class=""><code>{{ value.quantity || 'n/a' }}</code></td>
                                <td class=""><code>Rs.{{ value.purchase_price || 'n/a' }}</code></td>
                                <td class=""><code>Rs.{{ value.selling_price || 'n/a' }}</code></td>
                                <td class=""><button class="btn btn-default btn-xs" @click.prevent="showDelete(value.id)">Delete</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Additional images (Multiple File Upload) <br>
                        <small class="text-muted">Your image needs to be at least 500×500 pixels. Choose new file or Replace</small>
                    </div>
                    <div class="panel-body">
                        <div class="form-group mb-4">
                            <input type="file" id="additional-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg" @change="uploadAdditionalImages" multiple>
                        </div>
                        <div v-if="uploading_image" style="height: 150px;" class="mt-4 pt-4">
                            <div class="loader-bar"></div>
                            <p class="text-center mt-4 text-muted">Uploading Images</p>
                        </div>
                        <div v-else>
                            <img v-if="Object.keys(images).length === 0" src="/images/placeholder-dark.jpg" alt="" name="image" class="rounded image-xl">
                            <div class="row" v-else >
                                <div class="col-md-4 text-center mb-4" v-for="image in images">
                                    <img :src="'/storage/'+image.original" alt="" id="additional-image-preview" name="image" class="rounded mb-1 image-xl">
                                    <button class="btn btn-sm btn-outline-danger" @click.prevent="deleteAdditionalImage(image.id)" style="position: relative; top: 49px;">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Confirm Delete</h4>
                        <small>Click <code>Delete</code> button to confirm.</small>
                    </div>
                    <div class="modal-body">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click.prevent="hideDelete">Cancel</button>
                        <form action="" id="deleteForm">
                            <button class="btn btn-accent" v-if="delete_submitting"><i class="fa fa-spinner fa-spin"></i></button>
                            <button type="submit" class="btn btn-accent" @click.prevent="deleteQuantity" v-else>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <add-quantity ref="addQuantity"></add-quantity>
    </div>
</template>

<script>
    import InventoryService from "../../../services/InventoryService";
    import {EventBus} from "../../app";
    import AddQuantity from "./AddQuantity";
    import {Errors} from "../../../../../../../resources/js/error";
    export default {
        name: "GroceryItemEdit",
        components: {
            AddQuantity,
        },
        data: () => ({
            errors: new Errors(),
            delete_submitting: false,
            uploading_image: false,
            submitting: false,
            // form data
            name:'',
            description:'',
            main_image:'',
            sku:'',
            service_charge:'',
            category_id:'',
            brand_id:'',
            brand:'',
            category:'',
            unit_size:'',

            item:'',
            item_image_url:'',
            inventory_details:'',
            images:[],
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
            this.init();
            EventBus.$on('quantityAdded', () => {
                this.getItemDetails();
            });
            EventBus.$on('quantityDeleted', () => {
                this.getItemDetails();
            });
        },
        methods: {
            init(){
                var vm = this;
                $('.summernote').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ]
                });
                $('.category-select2').select2().on('change', function (e) {
                   vm.category_id = e.target.value
                });
                $('.brand-select2').select2().on('change', function (e) {
                   vm.brand_id = e.target.value
                });
            },
            setItemData(response){
                this.name = response.item_data.name;
                this.service_charge = response.item_data.service_charge;
                this.sku = response.item_data.sku;
                this.description = response.item_data.description;
                this.category_id = response.item_data.category_id;
                this.brand_id = response.item_data.brand_id;
                this.brand = response.item_data.brand;
                this.category = response.item_data.category;
                this.unit_size = response.item_data.unit_size;

                if (response.item_data.main_image_medium){
                    this.item_image_url = '/storage/' + response.item_data.main_image_medium;
                }

                this.images = response.item_data.images;
                this.inventory_details = response.inventory_details;
                this.item = response.item_data;
            },
            async getItemDetails() {
                const response = await InventoryService.getItemDetails(this.itemId);
                this.setItemData(response.data.data);

            },
            async saveItem() {
                this.submitting = true;
                try {
                    let formData = new FormData();
                    formData.append("item_id", this.itemId);
                    formData.append("item_name", this.name);
                    this.sku ? formData.append("sku", this.sku) : '';
                    this.service_charge ? formData.append("service_charge", this.service_charge) : '';
                    this.unit_size ? formData.append("unit_size", this.unit_size) : '';
                    var description = $("#description").val();
                    description ? formData.append("description", description): '';
                    if (this.category_id){
                        formData.append("category_id", this.category_id);
                    }
                    if (this.brand_id) {
                        formData.append("brand_id", this.brand_id);
                    }
                    if(this.main_image){
                        formData.append("main_image", this.main_image, this.main_image.name);
                    }

                    const response = await InventoryService.createItem(formData);
                    if (response.data.error === false) {
                        this.getItemDetails();
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('itemAdded');
                this.submitting = false;
            },

            handelImage(event){
                this.main_image = event.target.files[0];
                this.item_image_url = URL.createObjectURL(event.target.files[0]);
            },
            clearForm() {
                // this.id = this.item_name = this.sku = this.category = this.brand = '';
            },
            async showDelete(delete_id){
                this.delete_quantity_id = delete_id;
                $("#deleteModal").modal("show");
            },
            async hideDelete(){
                this.delete_quantity_id = '';
                $("#deleteModal").modal("hide");
            },
            async deleteQuantity(){
                this.delete_submitting = true;
                const response = await InventoryService.deleteQuantity(this.delete_quantity_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getItemDetails();
                    this.hideDelete();
                    EventBus.$emit('quantityDeleted');
                }
                this.delete_submitting = false;
            },
            async uploadAdditionalImages(event){
                this.uploading_image = true;
                const files = event.target.files;
                if (files.length){
                    for (let i=0; i < files.length; i++){
                        await this.uploadFile(files[i]);
                    }
                    this.getItemDetails();
                }
                this.uploading_image = false;
            },

            async uploadFile(file){
                const fd = new FormData();
                if (file) {
                    fd.append("file", file, file.name);
                }
                fd.append("item_id", this.itemId);
                try {
                    const response = await InventoryService.uploadAdditionalImage(fd);
                    if (response.data.error === false) {
                    }
                    Errors.Notification(response);
                }catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
            },

            async deleteAdditionalImage(image_id){
                const response = await InventoryService.deleteAdditionalImage(image_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getItemDetails();
                }
            }
        },
    }
</script>

<style scoped>

</style>
