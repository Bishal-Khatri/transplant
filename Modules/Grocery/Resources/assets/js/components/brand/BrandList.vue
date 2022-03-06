<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group m-b-xs m-t-xs">
                                    <input type="text" class="form-control" placeholder="Search by Item Name.." aria-describedby="button-addon2" v-model="meta.filter" @keydown.enter="getBrands"
                                           @click:append="getBrands" @keypress="getBrands">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">

                            </div>
                            <div class="col-lg-3">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-filled">
                    <!--<div class="panel-heading">-->
                    <!--Item list for grocery-->
                    <!--</div>-->
                    <div class="panel-body">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th style="width: 50px;">
                                    <input type="checkbox">
                                </th>
                                <th style="width: 50px;">#</th>
                                <th style="width: 80px;">Image</th>
                                <th>Brand Name</th>
                                <th style="width: 164px" class="text-right">
                                    <span class="float-left">Actions</span>
                                    <button @click.prevent="$refs.createBrand.openDialog()" class="text-right btn btn-default btn-xs">Add brand</button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="brands && brands.length" v-for="(value, index) in brands" :key="index">
                                <td><input type="checkbox"></td>
                                <td>
                                    {{ value.id }}
                                </td>
                                <td>
                                    <a href="javascript:void()" v-if="value.image_thumbnail">
                                        <img alt="image" class="rounded image-md" :src="'/storage/'+value.image_thumbnail">
                                    </a>
                                    <img v-else alt="image" class="rounded image-md" src="/images/placeholder-dark.jpg">
                                </td>
                                <td>
                                    <a href="#" @click.prevent="">{{ value.name }}</a>

                                    <div class="small"><i class="fa fa-clock-o"></i> Created {{ value.created_at }}</div>
                                </td>
                                <td>
                                    <div class="btn-group pull-left">
                                        <a class="btn btn-default btn-xs" href="#" @click.prevent="$refs.createBrand.openDialog(value)">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <button class="btn btn-default btn-xs text-danger" @click.prevent="showDeleteModal(value.id)">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <pagination :data="brands_pg" @pagination-change-page="getBrands"></pagination>
        </div>

        <create-brand ref="createBrand"/>

        <div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <form action="" id="deleteForm">
                            <button type="submit" class="btn btn-accent" @click.prevent="deleteBrand">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import InventoryService from "../../../services/InventoryService";
    import CreateBrand from "./CreateBrand";
    import {EventBus} from '../../app';

    export default {
        name: "BrandList",
        components: {
            CreateBrand
        },
        data() {
            return {
                id: '',
                filter: '',
                brands: [],
                brands_pg: {},

                meta:{
                    filter: '',
                },
            };
        },
        created() {},
        mounted() {
            this.getBrands();
            EventBus.$on('brandAdded', () => {
                this.getBrands();
            });
        },
        computed: {
        },
        methods: {
            async getBrands(page=1){
                try {
                    const response = await InventoryService.getBrands(page,this.meta);
                    this.brands = response.data.data.brands.data;
                    this.brands_pg = response.data.data.brands;
                }catch (error) {
                    // Errors.Notification(error.response);
                }
            },

            showDeleteModal(brand_id){
                this.id = brand_id;
                $("#deleteBrandModal").modal('show');
            },

            async deleteBrand(){
                const response = await InventoryService.deleteBrand(this.id);
                if (response.data.error === false) {
                    // Errors.Notification(response);
                    this.getBrands()
                }
                $("#deleteBrandModal").modal('hide');
                this.clear();
            },
            clear(){
                this.id = '';
            },
        },
    }
</script>

<style scoped>

</style>
