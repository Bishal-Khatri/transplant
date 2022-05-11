<template>
    <div>
        <div class="modal fade" id="create-education-level-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Create/Update Education Level</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="form-group row">
                            <label>Education Levels Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" v-model="title">
                            <span class="form-text text-danger" v-html="errors.get('title')"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="submitting" type="button" class="btn btn-primary btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-success btn-sm" @click.prevent="saveEducationLevel">Save</button>
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
            education_level: "",
            education_level_id: "",

            // form data
            title: "",
        }),
        computed:{
        },
        methods: {
            openDialog(education_level) {
                if (education_level){
                    this.education_level = education_level;
                    this.title = education_level.title;
                    this.education_level_id = education_level.id;
                }
                $("#create-education-level-dialog").modal("show");
            },

            async saveEducationLevel() {
                this.submitting = true;
                try {
                    const formData = {
                        id: this.education_level_id,
                        title: this.title,
                    };

                    const response = await DataService.saveEducationLevel(formData);
                    if (response.data.error === false) {
                        $("#create-education-level-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.submitting = false;
                } catch (error) {
                    this.submitting = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('EducationLevelCreated');
                this.submitting = false;
            },

            clearForm() {
                this.title = this.education_level = this.education_level_id = '';
                this.errors.clear();
            },
        },
    };
</script>

<style >
</style>
