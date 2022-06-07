<template>
    <div>
        <div class="modal fade" id="select-file" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Create/Update Disease</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <file-manager v-bind:settings="settings"></file-manager>
                    </div>
                    <div class="modal-footer">
                        {{fileSelected}}
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="button" class="btn btn-accent btn-sm" @click.prevent="selectFiles">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";

    export default {
        name: "SelectFile",
        data(){
            return{
                errors: new Errors(),
                submitting: false,
                settings: {
                    windowsConfig: 1
                },
                modelValue: {}
            }
        },
        computed: {
            fileSelected() {
                return this.$store.state.fm.left.selected.files;
            }
        },
        watch: {
            fileSelected() {
                if (this.fileSelected.length > 0) {
                    this.modelValue.url = `/storage/${this.fileSelected[0]}`;
                    this.isFilemanagerOpen = false;
                }
            }
        },
        methods:{
            openDialog() {
                $("#select-file").modal("show");
            },
            selectFiles() {
                this.$emit("filesSelected", this.fileSelected);
                $("#select-file").modal("hide");
            },
        }
    }
</script>

<style scoped>

</style>
