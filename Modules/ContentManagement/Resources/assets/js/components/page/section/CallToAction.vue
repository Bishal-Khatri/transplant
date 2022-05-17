<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Call To Action <input type="checkbox" class="js-switch ml-4" checked /> Visible</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="btn btn-link">Save</a>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="" @click.prevent="$refs.deleteSection.openDialog(section.id)"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="nav nav-tabs justify-content-end bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="home" aria-selected="true">Content</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="style-tab" data-toggle="tab" href="#style" role="tab" aria-controls="profile" aria-selected="false">Style</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">

                    </div>
                    <div class="tab-pane fade" id="style" role="tabpanel" aria-labelledby="style-tab">
                        <form class="form-label-left input_mask">
                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="order" placeholder="Order">
                            </div>
                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Page Title">
                                <span class="fa fa-align-left form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12  form-group has-feedback">
                                <textarea class="form-control" name="" id="" cols="30" rows="5" placeholder="Short Description"></textarea>
                            </div>
                        </form>
                    </div>
                </div>

                <!--<form class="form-label-left input_mask">-->
                <!--<div class="col-md-12 col-sm-12  form-group has-feedback">-->
                <!--<input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Page Title">-->
                <!--<span class="fa fa-align-left form-control-feedback left" aria-hidden="true"></span>-->
                <!--</div>-->

                <!--<div class="col-md-12 col-sm-12  form-group has-feedback">-->
                <!--<textarea class="form-control" name="" id="" cols="30" rows="5" placeholder="Short Description"></textarea>-->
                <!--</div>-->
                <!--</form>-->
            </div>
        </div>
        <delete-section ref="deleteSection"></delete-section>
    </div>
</template>

<script>
    import DeleteSection from "./DeleteSection";

    export default {
        name: "CallToAction",
        props: [
            'page',
            'section',
        ],
        components: {
            DeleteSection,
        },
    }
</script>

<style scoped>

</style>
