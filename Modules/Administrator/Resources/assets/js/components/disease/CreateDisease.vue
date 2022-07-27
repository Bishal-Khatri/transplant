<template>
    <div>
        <div class="modal fade" id="create-disease-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Create/Update Disease</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="form-group row">
                            <label>Disease Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" v-model="title">
                            <span class="form-text text-danger" v-html="errors.get('title')"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-accent btn-sm" @click.prevent="saveDisease">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../../app';
    import {Errors} from "../../../../../../../resources/js/error";
    import DataService from "../../../services/DataService";

    export default {
        name: "AddQuantity",
        props: {
        },
        components: {
        },
        data: () => ({
            errors: new Errors(),
            submitting: false,
            disease: "",
            disease_id: "",

            // form data
            title: "",
        }),
        computed:{
        },
        methods: {
            openDialog(disease) {
                if (disease){
                    this.disease = disease;
                    this.title = disease.title;
                    this.disease_id = disease.id;
                }
                $("#create-disease-dialog").modal("show");
            },

            async saveDisease() {
                this.submitting = true;
                try {
                    const formData = {
                        id: this.disease_id,
                        title: this.title,
                    };

                    const response = await DataService.saveDisease(formData);
                    if (response.data.error === false) {
                        $("#create-disease-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.submitting = false;
                } catch (error) {
                    this.submitting = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('diseaseCreated');
                this.submitting = false;
            },

            clearForm() {
                this.title = this.disease = this.disease_id = '';
                this.errors.clear();
            },
        },
    };
</script>

<style >
</style>
