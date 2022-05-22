<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control"
                                       placeholder="Search" v-model="filter"
                                       @keydown.backspace="setSearch"
                                       @keydown.enter="setSearch"
                                       @keypress="setSearch">
                            </div>
                            <div class="col-md-9">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a style="color: #5A738E;" href="#" @click.prevent="$refs.createDisease.openDialog()">Create New</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th style="width: 180px" class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!patients.length">
                                <td colspan="2">No items to display.</td>
                            </tr>
                            <tr v-else v-for="(patient, index) in patients" :key="index">
                                <td>
                                    <a class="mr-2" href="#" @click.prevent="$refs.createDisease.openDialog(disease)">{{ patient.title }}</a>
                                    <small class="">Created on {{ patient.created_at }}</small>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="#" @click.prevent="$refs.createDisease.openDialog(patient)" class="btn btn-secondary btn-sm" type="button">Edit</a>
                                        <a href="#" @click.prevent="showDeleteModal(patient.id)" class="btn btn-danger btn-sm deleteModal" type="button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <pagination :data="patients_pg" @pagination-change-page=""></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";

    export default {
        name: "PatientList",
        data(){
            return{
                errors: new Errors(),
                filter: '',

                patients: {},
                patients_pg: {},
            }
        },
        computed: {
        },
        mounted() {
        },
        methods: {
            setSearch:_.debounce(function(){
            }, 800),

        }
    }
</script>

<style scoped>

</style>
