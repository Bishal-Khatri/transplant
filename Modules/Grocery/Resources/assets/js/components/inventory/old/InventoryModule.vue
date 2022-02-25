<template>
    <v-container id="itemList" fluid tag="section">
        <v-row no-gutters>
            <v-col cols="12">
                <v-toolbar flat color="white" dense>
                    <v-tabs color="primary">
                        <v-tab :to="{ name: 'inventory-items' }" style="text-decoration: none;">
                            Items
                        </v-tab>
                        <v-tab :to="{ name: 'inventory-category' }" style="text-decoration: none;">
                            Categories
                        </v-tab>
                        <v-tab :to="{ name: 'inventory-brand' }" style="text-decoration: none;">
                            Brands
                        </v-tab>
                        <v-tab :to="{ name: 'inventory-vendor' }" style="text-decoration: none;">
                            Vendors
                        </v-tab>
                    </v-tabs>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-list two-line subheader>
                    <router-view></router-view>
                </v-list>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "EmployeeModule",
        data(){
            return{}
        },
        created() {
            this.$store.state.pageTitle = "Inventory";
        },
        mounted(){
            this.init();
        },
        computed: {},
        methods:{
            ...mapActions('inventory',['setCategoryList', 'setBrandList', 'setVendorList']),
            async init(){
                this.setCategoryList();
                this.setBrandList();
                this.setVendorList();
            }
        }
    }
</script>

<style scoped>

</style>
