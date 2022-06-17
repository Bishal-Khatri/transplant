<template>
    <ul class="messages">
        <!-- notifications -->
        <li v-for="(activity,index) in activities" :key="index">
            <i v-if="activity.description ==='updated'" class="fa fa-edit text-accent float-left"></i>
            <i v-else-if="activity.description ==='created'" class="fa fa-plus text-success float-left"></i>
            <i v-else class="fa fa-trash text-danger float-left"></i>
            <div class="message_date">
                <!--<h2 class="date text-info">May</h2>-->
                <!--<p class="month">12</p>-->
            </div>
            <div class="message_wrapper">
                <blockquote class="message">
                    A <strong>{{ activity.subject_type }}</strong> has been <strong>{{ activity.description }}</strong> by <strong>{{ activity.causer.name }}</strong>
                    <a href="">{{ activity.created_at }}</a>.</blockquote>
                <br />
            </div>
        </li>
    </ul>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import DataService from "../../../services/DataService";

    export default {
        name: "RecentActivity",
        components: {
        },
        data(){
            return{
                errors: new Errors(),

                // notification
                activities:{},
                notification_current_page:0,
                current_notification:{}
            }
        },
        computed: {
        },
        mounted() {
            this.getNotifications();
        },
        methods: {
            async getNotifications(page=1){
                const response = await DataService.getActivity(page);
                if(response.data.error === false){
                    this.activities = response.data.data.activities.data;
                }
            },

        }
    }
</script>

<style scoped>

</style>
