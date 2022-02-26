<template>
    <v-container id="collegeList" fluid tag="section">
        <v-card class="mx-auto" min-height="71vh">
            <v-toolbar color="info" dark>
                <v-toolbar-title style="width: 150px;">Brands</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-tooltip bottom color="black">
                    <template v-slot:activator="{ on }">
                        <v-text-field v-model="search"
                                      filled rounded dense single-line
                                      append-icon="mdi-magnify"
                                      label="Search"
                                      class="shrink ml-3"
                                      hide-details>
                        </v-text-field>
                    </template>
                    <span>Press ENTER key to search</span>
                </v-tooltip>
                <v-spacer></v-spacer>
                <create-brand ref="createBrand"/>
                <v-tooltip top color="black">
                    <template v-slot:activator="{ on }">
                        <v-btn icon v-on="on" @click.prevent="getBrands">
                            <v-icon>refresh</v-icon>
                        </v-btn>
                    </template>
                    <span>Refresh</span>
                </v-tooltip>
            </v-toolbar>
            <template v-if="loading">
                <v-row class="fill-height text-muted" style="height:200px" align-content="center" justify="center">
                    <v-col class="overline text-center" cols="12">
                        Fetching data....
                    </v-col>
                    <v-col cols="6">
                        <v-progress-linear color="deep-purple accent-4" indeterminate rounded height="6"></v-progress-linear>
                    </v-col>
                </v-row>
            </template>
            <template v-else>
                <v-simple-table dense fixed-header>
                    <template v-slot:default>
                        <thead>
                        <tr>
                            <th class="text-center" style="width:150px">#ID</th>
                            <th class="text-left">Brand Name</th>
                            <th class="text-center" style="width: 100px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="brands && brands.length === 0 && !loading">
                            <td colspan="8">
                                <v-alert tile class="mt-1" type="warning" elevation="1">
                                    No items to display.
                                    <v-icon small>mdi-arrow-up</v-icon>Click
                                    <code>ADD NEW</code> to add.
                                </v-alert>
                            </td>
                        </tr>
                        <tr v-if="!moduleIsReady || loading">
                            <td colspan="8">
                                <v-row class="fill-height text-muted" style="height:200px" align-content="center" justify="center">
                                    <v-col class="overline text-center" cols="12">
                                        Getting your files
                                    </v-col>
                                    <v-col cols="6">
                                        <v-progress-linear color="deep-purple accent-4" indeterminate rounded height="6"></v-progress-linear>
                                    </v-col>
                                </v-row>
                            </td>
                        </tr>
                        <tr v-else v-for="value in brands" :key="value.id">
                            <td class="text-center">{{ value.id }}</td>
                            <td>{{ value.name }}</td>
                            <td class="text-center">
                                <v-icon small color="primary" class="mr-2" @click.prevent="$refs.createBrand.openDialog(value)">edit</v-icon>
                                <v-icon small color="error" @click.prevent="deleteDialog = true; id = value.id">delete</v-icon>
                            </td>
                        </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </template>
        </v-card>
        <v-list-item>
            <v-spacer></v-spacer>

        </v-list-item>

        <v-dialog v-model="deleteDialog" max-width="350">
            <v-card>
                <v-card-title class="title">Delete Record?</v-card-title>

                <v-card-text>Are you sure you want to delete this record? <code>Confirm</code> to delete permanently.</v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="green darken-1" text @click="deleteDialog = false">Cancel</v-btn>

                    <v-btn color="red darken-1" @click.prevent="deleteBrand" :loading="deleteBtnLoading" text>Confirm</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>

    import {mapActions, mapGetters} from "vuex";
    import InventoryService from "../../../services/InventoryService";
    import {Errors} from "../../../utils/error";
    import CreateBrand from "../components/CreateBrand";

    export default {
        name: "BrandList",
        components: {
            CreateBrand
        },
        data() {
            return {
                dialog: false,
                loading: false,
                deleteDialog: false,
                deleteBtnLoading: false,
                moduleIsReady: true,
                id: '',
                search: '',
            };
        },
        created() {},
        mounted() {},
        computed: {
            ...mapGetters("inventory", ['brands'])
        },
        methods: {
            ...mapActions('inventory',['setBrandList']),
            async getBrands(){
                this.loading = true;
                await this.setBrandList();
                this.loading = false;
            },
            async deleteBrand(){
                this.deleteBtnLoading = true;
                const response = await InventoryService.deleteBrand(this.id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getBrands()
                }
                this.clear();
            },
            clear(){
                this.id = '';
                this.deleteDialog = this.deleteBtnLoading = false;
            },
        },
    }
</script>

<style scoped>

</style>
