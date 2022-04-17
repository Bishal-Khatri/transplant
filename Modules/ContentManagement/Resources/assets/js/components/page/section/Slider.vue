<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Slider</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="btn btn-link" v-if="submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                        <a class="btn btn-link" href="" v-else @click.prevent="updateSection">Save Section</a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="" @click.prevent="$refs.deleteSection.openDialog(section.id)"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-label-left input_mask">
                    <div class="checkbox col-md-12 col-sm-12  form-group">
                        <label><input type="checkbox" v-model="visibility"> Visibility</label>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <input type="number" style="width: 150px;" class="form-control form-control-sm" v-model="section_order" placeholder="Section Order">
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" v-model="title" placeholder="Section Title">
                        <span class="fa fa-align-left form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group">
                        <select class="form-control" v-model="slider_id">
                            <option selected>Choose Slider</option>
                            <option v-for="slider in sliders" :value="slider.id">{{ slider.title }}</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <delete-section ref="deleteSection"></delete-section>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../../resources/js/error";
    import DeleteSection from "./DeleteSection";
    import {EventBus} from "../../../app";
    import PageService from "../../../../services/PageService";

    export default {
        name: "Slider",
        props: [
            'page',
            'section',
            'sliders',
        ],
        components: {
            DeleteSection,
        },
        data(){
            return{
                errors: new Errors(),
                submitting: false,

                title: '',
                slider_id: '',
                visibility: 1,
                section_order: 0,
            }
        },
        async mounted(){
            await this.setData();
            this.init();
        },
        methods:{
            async setData(){
                this.title = this.section.title;
                this.slider_id = this.section.slider_id;
                this.visibility = this.section.visibility;
                this.section_order = this.section.order;
            },
            async init(){
            },

            async updateSection(){
                this.submitting = true;
                try {
                    const formData = {
                        section_id: this.section.id,
                        title: this.title,
                        slider_id: this.slider_id,
                        visibility: this.visibility,
                        order: this.section_order,
                    };

                    const response = await PageService.updateSection(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('sectionUpdated');
                this.submitting = false;
            }
        }
    }
</script>

<style scoped>

</style>
