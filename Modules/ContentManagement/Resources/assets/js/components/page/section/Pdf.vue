<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Pdf</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="btn btn-link">Save</a>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
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
        <delete-section ref="deleteSection"></delete-section>
    </div>
</template>

<script>
    import DeleteSection from "./DeleteSection";

    export default {
        name: "Pdf",
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
