<template>
    <div class="button is-drop">
        <i class="sl sl-icon-bell is-icon-xl"></i>
        <span class="b-badge is-danger text-bold" v-text="notifications.length"></span>
        <div class="dropContain notifications-drop dropContain-notifications">
            <div class="dropOut">
                <ul v-if="notifications.length">
                    <li
                        v-for="(notification, index) in notifications"
                        :key="index"
                        @click="markAsRead(notification.id ? notification.id : null, notification.data.link)">
                       <i class="drop-icon sl sl-icon-arrow-right-circle"></i> {{notification.data.message}}
                        <span class="notification-time">
                            {{notification.created_at}}
                        </span>
                    </li>
                </ul>
                <ul v-else>
                    <li>No Notifications</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                notifications: this.data.sort()
            }
        },

        mounted() {
            Echo.private(`App.Models.User.${window.User.id}`)
                .notification((notification) => {
                    this.toast(
                        'success',
                        notification.data.message,
                        'Check it', notification.data.link
                    );
                    this.notifications.unshift(notification);
                });
        },

        methods: {
            markAsRead(notificationId, redirectUrl) {
                if(notificationId) {
                    axios.post(`/notifications/${notificationId}`)
                        .then(response => window.location = redirectUrl);
                } else{
                    window.location = redirectUrl;
                }
            },
        }
    }
</script>

<style>
    .notifications-drop {
        width: 400px !important;
    }

    .notifications-drop li {
        width: 100% !important;
    }

    .notifications-drop .dropOut {
        width: 100% !important;
    }

    .notification-time {
        background: #b1b1b1;
        position: absolute;
        right: 10px;
        margin-top: 25px;
        font-size: 10px;
        color: #fff;
        padding: 2px;
        font-weight: lighter;
        border-radius: 10px;
    }

    .dropContain-notifications{
        overflow-x: hidden;
        overflow-y: auto;
        max-height: 400px;
    }
</style>
