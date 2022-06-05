<template>
    <div class="modal" id="change-status-dialog" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title ml-2">Create User</h2>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body ml-2 mr-2 mb-0">
                    <p>
                        <strong>Attention !</strong> Are you sure you want to <code>{{ status_type.toUpperCase() }}</code> status of this hospital?
                        Click <code>Change</code> button.
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button v-if="submitting_status" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                    <button v-else type="submit" class="btn btn-accent btn-sm" @click.prevent="changeHospitalStatus">Change</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import AdministratorService from "../../../services/AdministratorService";
    import {EventBus} from "../../app";

    export default {
        name: "changeHospitalStatus",
        props: ["hospital"],
        data(){
            return{
                errors: new Errors(),

                submitting_status:false,
                status_type: '',
                status: '',
            }
        },
        methods:{
            changeStatus(status_type, status){
                this.status_type = status_type;
                this.status = status;
                $("#change-status-dialog").modal('show');
            },

            async changeHospitalStatus(){
                this.submitting_status = true;
                try {
                    const formData = {
                        'hospital_id': this.hospital.id,
                        'status_type': this.status_type,
                        'status': this.status,
                    };

                    const response = await AdministratorService.changeHospitalStatus(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                        this.status_type = this.status = '';
                        EventBus.$emit('hospitalStatusChanged');
                        $("#change-status-dialog").modal('hide');
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                }
                this.submitting_status = false;
            },
        }
    }
</script>

<style scoped>

</style>
