<template>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="x_title">
                        <h2>General</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><button class="btn btn-link text-accent" type="submit">Save</button></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12" v-if="active_theme">
                            <img :src="'/storage/'+active_theme.logo" alt="logo" class="rounded" width="350">
                            <p>Current Logo</p>
                        </div>

                        <div class="col-md-12 col-sm-12 form-group">
                            <label>Website Logo</label>
                            <!--<input type="file" class="form-control" v-model="logo" placeholder="Website Logo">-->
                        </div>

                        <div class="col-md-12 col-sm-12 form-group">
                            <label>Website Name</label>
                            <input type="text" class="form-control" v-model="title" placeholder="Website Name">
                        </div>

                        <div class="col-md-12 col-sm-12 form-group">
                            <label>Home Page</label>
                            <select class="form-control" v-model="homepage_id">
                                <option value="" selected>Choose Page</option>
                                <option v-for="(page, index) in pages" :key="index" :value="page.id" >{{ page.title }}</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 form-group">
                            <label>Navigation Menu</label>
                            <select class="form-control" v-model="nav_menu_id">
                                <option value="" selected>Choose Menu</option>
                                <option v-for="(menu, index) in menus" :key="index" :value="menu.id">{{ menu.title }}</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12  form-group">
                            <label>Copyright Text</label>
                            <textarea v-model="copyright_text" class="form-control" cols="30" rows="10" placeholder="Copyright Text"></textarea>
                        </div>

                        <div class="col-md-12 col-sm-12  form-group">
                            <label>Footer
                                <div class="btn-group ml-4 btn-sm">
                                    <button class="btn btn-sm btn-accent" @click.prevent="setFooterStyle(0)">FOOTER LONG</button>
                                    <button class="btn btn-sm btn-accent" @click.prevent="setFooterStyle(1)">FOOTER SHORT 1</button>
                                    <button class="btn btn-sm btn-accent" @click.prevent="setFooterStyle(2)">FOOTER SHORT 2</button>
                                </div>
                            </label>
                            <textarea v-model="footer" class="form-control summernote footer-text" cols="30" rows="10" placeholder="Copyright Text">{{ active_theme.footer || '' }}</textarea>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ThemeCustomization",
        props:['active_theme', 'menus', 'pages'],
        data(){
            return{
                logo: '',
                title: '',
                homepage_id: '',
                nav_menu_id: '',
                copyright_text: '',
                footer: '',

                footer_styles:[
                    '<footer class="space--sm footer-2 "> <div class="container"> <div class="row"> <div class="col-md-6 col-lg-3 col-6"> <h6 class="type--uppercase">Company</h6> <ul class="list--hover"> <li> <a href="#">About Company</a> </li><li> <a href="#">Our Team</a> </li><li> <a href="#">Locations</a> </li><li> <a href="#">History</a> </li><li> <a href="#">Work With Us</a> </li></ul> </div><div class="col-md-6 col-lg-3 col-6"> <h6 class="type--uppercase">Developers</h6> <ul class="list--hover"> <li> <a href="#">Developer Center</a> </li><li> <a href="#">API Reference</a> </li><li> <a href="#">Downloads</a> </li><li> <a href="#">Tools</a> </li><li> <a href="#">Developer Blog</a> </li><li> <a href="#">Developer Forums</a> </li></ul> </div><div class="col-md-6 col-lg-3 col-6"> <h6 class="type--uppercase">Support</h6> <ul class="list--hover"> <li> <a href="#">Help Center</a> </li><li> <a href="#">Live Chat</a> </li><li> <a href="#">Downloads</a> </li><li> <a href="#">Press Kit</a> </li></ul> </div><div class="col-md-6 col-lg-3 col-6"> <h6 class="type--uppercase">Locations</h6> <ul class="list--hover"> <li> <a href="#">Melbourne</a> </li><li> <a href="#">London</a> </li><li> <a href="#">New York</a> </li><li> <a href="#">San Francisco</a> </li></ul> </div></div><div class="row"> <div class="col-md-6"> <span class="type--fine-print">&copy; <span class="update-year"></span> Stack Inc.</span> <a class="type--fine-print" href="#">Privacy Policy</a> <a class="type--fine-print" href="#">Legal</a> </div><div class="col-md-6 text-right text-left-xs"> <ul class="social-list list-inline list--hover"> <li> <a href="#"> <i class="socicon socicon-google icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-twitter icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-facebook icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-instagram icon icon--xs"></i> </a> </li></ul> </div></div></div></footer>',
                    '<footer class="text-center-xs space--xs "> <div class="container"> <div class="row"> <div class="col-md-7"> <ul class="list-inline"> <li> <a href="#"> <span class="h6 type--uppercase">About</span> </a> </li><li> <a href="#"> <span class="h6 type--uppercase">Careers</span> </a> </li><li> <a href="#"> <span class="h6 type--uppercase">Support</span> </a> </li></ul> </div><div class="col-md-5 text-right text-center-xs"> <ul class="social-list list-inline list--hover"> <li> <a href="#"> <i class="socicon socicon-google icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-twitter icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-facebook icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-instagram icon icon--xs"></i> </a> </li></ul> </div></div><div class="row"> <div class="col-md-7"> <span class="type--fine-print">&copy; <span class="update-year"></span> Stack Inc.</span> <a class="type--fine-print" href="#">Privacy Policy</a> <a class="type--fine-print" href="#">Legal</a> </div><div class="col-md-5 text-right text-center-xs"> <a class="type--fine-print" href="#">support@stack.io</a> </div></div></div></footer>',
                    '<footer class="space--sm footer-1 text-center-xs "> <div class="container"> <div class="row"> <div class="col-md-6"> <ul class="list-inline list--hover"> <li> <a href="#"> <span>Our Company</span> </a> </li><li> <a href="#"> <span>Locations</span> </a> </li><li> <a href="#"> <span>Products</span> </a> </li><li> <a href="#"> <span>Work With Us</span> </a> </li></ul> </div><div class="col-md-6 text-right text-center-xs"> <ul class="social-list list-inline list--hover"> <li> <a href="#"> <i class="socicon socicon-google icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-twitter icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-facebook icon icon--xs"></i> </a> </li><li> <a href="#"> <i class="socicon socicon-instagram icon icon--xs"></i> </a> </li></ul> <a href="#" class="btn type--uppercase"> <span class="btn__text"> Contact Us </span> </a> </div></div><div class="row"> <div class="col-md-12"> <img alt="Image" class="logo" src="img/logo-dark.png"/> <span class="type--fine-print">&copy; <span class="update-year"></span> Stack Inc.</span> <a class="type--fine-print" href="#">Privacy Policy</a> <a class="type--fine-print" href="#">Legal</a> </div></div></div></footer>'
                ]
            }
        },
        mounted(){
            this.init_data();
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ]
            });
        },
        methods:{
            init_data(){
                this.title = this.active_theme.title;
                this.homepage_id = this.active_theme.homepage_id;
                this.nav_menu_id = this.active_theme.nav_menu_id;
                this.copyright_text = this.active_theme.copyright;
                this.footer = this.active_theme.footer;
            },
            setFooterStyle(index){
                this.footer = this.footer_styles[index];
            }
        }
    }
</script>

<style scoped>

</style>
