<template>
    <v-dialog v-model="dialog" persistent max-width="600px" scrollable>
        <template v-slot:activator="{ on, attrs }">
            <v-tooltip top color="black">
                <template v-slot:activator="{ on }">
                    <v-btn v-on="on" @click="dialog = true" v-bind="attrs" small class="secondary mr-4">Create Brand</v-btn>
                </template>
                <span>Create New Brand</span>
            </v-tooltip>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Create Brand</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field label="Brand name *"
                                          :error-messages="errors.get('brand_name')"
                                          required dense v-model="brand_name">
                            </v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" small text @click.prevent="dialog = false; clearForm();">Discard</v-btn>
                <v-btn color="success darken-1" small text @click="saveBrand" :loading="saveBtnLoading">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import {Errors} from "../../../utils/error";
    import InventoryService from "../../../services/InventoryService";
    import {mapActions} from "vuex";
    export default {
        name: "CreateBrand",
        props: {
        },
        components: {
        },
        mounted(){
        },
        data: () => ({
            errors: new Errors(),
            brand_name: "",
            saveBtnLoading: false,
            dialog: false,
        }),
        methods: {
            ...mapActions('inventory',['setBrandList']),
            openDialog(value){
                this.dialog = true;
                this.id = value.id;
                this.brand_name = value.name;
            },
            async saveBrand() {
                try {
                    this.saveBtnLoading = true;
                    const formData = {
                        id: this.id,
                        brand_name: this.brand_name
                    };
                    const response = await InventoryService.createBrand(formData);
                    if (response.data.error === false) {
                        this.dialog = false;
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                this.setBrandList();
            },

            clearForm() {
                this.errors.clear();
                this.brand_name = this.id = '';
            },
            close() {
                this.$emit('click', !this.dialog);
            }
        },
    };
</script>

<style >
</style>
