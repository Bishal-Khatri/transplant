<template>
    <div>
        <div class="panel m-b-none">
            <div class="panel-body">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>Menu</th>
                        <th class="text-right">
                            <a class="btn btn-default btn-sm" href="#" @click.prevent="$refs.addItem.openDialog(restaurant)">Add Item</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="!items.length">
                        <td colspan="2">No items found.</td>
                    </tr>
                    <tr v-else v-for="item in items" :key="item.id">
                        <td><code>{{ item.name }}</code></td>
                        <td class="text-right">Rs.{{ item.price }}</td>
                    </tr>

                    </tbody>
                </table>
                <div class="pull-right">
                    <pagination :data="items_pg" @pagination-change-page="getMenu"></pagination>
                </div>
            </div>
        </div>

        <add-item ref="addItem" :categories="categories"/>
    </div>
</template>

<script>

    import ClientService from "../../services/ClientService";
    import AddItem from "../AddItem";

    export default {
        name: "GroceryOrderList",
        props: [
            'restaurant',
            'categories',
        ],
        data(){
            return{
                timer: null,
                page: 1,
                filter: '',

                items:{},
                items_pg:{},
            }
        },
        components: {
            AddItem
        },
        mounted(){
            this.getMenu();
        },
        methods:{
            async getMenu(page = 1){
                const response = await ClientService.getMenu(page, this.filter);
                this.items_pg = response.data.data.items;
                this.items = response.data.data.items.data;
            }
        }
    }
</script>

<style scoped>

</style>
