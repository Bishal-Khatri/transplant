<template>
    <div>
        <div class="modal fade" id="delete-section-dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Confirm Delete</h4>
                        <!--<small>Click <code>Delete</code> button to confirm.</small>-->
                    </div>
                    <div class="modal-body">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <form action="" id="deleteForm">
                            <button class="btn btn-accent" v-if="submitting"><i class="fa fa-spinner fa-spin"></i></button>
                            <button type="submit" class="btn btn-accent" @click.prevent="deleteSection" v-else>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../../resources/js/error";
    import PageService from "../../../../services/PageService";
    import {EventBus} from "../../../app";

    export default {
        name: "DeleteSection",
        props: {
        },
        components: {
        },
        data: () => ({
            errors: new Errors(),
            submitting: false,
            section_id: '',
        }),
        computed:{
        },
        methods: {
            async openDialog(section_id) {
                 this.section_id = section_id;
                $("#delete-section-dialog").modal("show");

            },
            async deleteSection() {
                this.submitting = true;
                try {
                    const response = await PageService.deleteSection(this.section_id);
                    if (response.data.error === false) {
                        this.section_id = '';
                        Errors.Notification(response);
                    }
                    $("#delete-section-dialog").modal("hide");
                } catch (error) {
                    Errors.Notification(error.response);
                    $("#delete-section-dialog").modal("hide");
                }
                EventBus.$emit('sectionUpdated');
                this.submitting = false;
            },
        },
    }
</script>

<style scoped>

</style>
