<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Slider <input type="checkbox" class="js-switch ml-4" v-model="visibility" /> Visible</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="btn btn-link" v-if="submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                        <a class="btn btn-link" href="" v-else @click.prevent="updateSection" style="color: #5A738E;" >Save Section</a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="" @click.prevent="$refs.deleteSection.openDialog(section.id)"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Section Order
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" v-model="section_order" class="form-control">
                            <span class="form-text small text-danger" v-html="errors.get('section_order')"></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Section Title
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" v-model="title" class="form-control">
                            <span class="form-text small text-danger" v-html="errors.get('title')"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Section Body
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" v-model="slider_id">
                                <option selected>Choose Slider</option>
                                <option v-for="slider in sliders" :value="slider.id">{{ slider.title }}</option>
                            </select>
                        </div>
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
                this.visibility = this.section.visibility;
                this.section_order = this.section.order;

                let json_data = JSON.parse(this.section.json_data);
                this.slider_id = json_data.slider_id;
            },
            async init(){
            },

            async updateSection(){
                this.submitting = true;
                try {
                    let json_data = JSON.stringify({
                        slider_id: this.slider_id,
                    });

                    const formData = {
                        section_id: this.section.id,
                        title: this.title,
                        visibility: this.visibility,
                        order: this.section_order,
                        json_data: json_data,
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
