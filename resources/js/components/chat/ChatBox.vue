<template>
    <div style="display: inline;">
        <button @click.prevent="fetch" class="button primary-btn is-large">
            <i class="sl sl-icon-bubbles"></i> Chat
        </button>
        <div class="modal" :class="chatting ? 'is-active' : ''">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Order {{formattedOrderCode}} Chat</p>
                    <button class="delete" aria-label="close" @click.prevent="chatting=false"></button>
                </header>
                <section class="modal-card-body">

                    <ul class="user-media-list" v-chat-scroll>
                        <li
                            v-for="(detail, index) in chat"
                            :key="index"
                            :class="classes(detail.user.name)">
                            <article class="media light-raised">
                                <figure class="media-left">
                                    <p class="image is-48x48">
                                        <img class="img-circle rounded-avatar" :src="detail.user.avatar">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <small class="b-badge is-primary text-white">
                                                {{detail.user.name}}
                                            </small>
                                            <br>
                                            {{detail.message}}
                                            <br>
                                            <small class="is-pulled-right b-badge">
                                                {{detail.time}}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </li>
                    </ul>

                    <div v-if="activePeer" v-text="activePeer.name + ' is typing'"></div>

                    <div class="field">
                        <div class="control">
                            <input
                                type="text"
                                class="input is-medium"
                                placeholder="Message..."
                                v-model="message"
                                @keyup.enter="send"
                                @keydown="tapParticipants">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
    import 'vue-chat-scroll';

    export default {

        props: [
            'originalOrderCode',
            'formattedOrderCode',
            'orderId',
            'owner'
        ],

        computed: {
          channel() {
              return Echo.private(`order.${this.orderId}.chat`);
          }
        },

        data() {
            return {
                message: null,
                chatting: false,
                chat: [],
                activePeer: false,
                typingTimer: false,
            }
        },

        mounted() {
            this.channel
                .listen('Chats.ChatEvent', this.flashPeer)
                .listenForWhisper('typing', this.flashActivePeer);
        },

        methods: {

            fetch() {
                this.chatting = true;

                axios.get(`/chat/${this.originalOrderCode}`)
                    .then(({data}) => { this.chat = data;});
            },

            flashActivePeer(e) {
                this.activePeer = e;

                if(this.typingTimer) clearTimeout(this.typingTimer);

                this.typingTimer = setTimeout(() => {this.activePeer = false;}, 3000)
            },

            flashPeer(e) {
                this.chat.push({
                    message: e.message,
                    user: e.user,
                    time: this.time(),
                });
            },

            tapParticipants() {
                this.channel
                    .whisper('typing', {
                        name: window.User.name,
                    });
            },

            send() {
                if(this.message.length > 1) {

                    this.activePeer = false;

                    this.chat.push({
                        message: this.message,
                        user: {
                            name: window.User.name,
                            avatar: window.User.avatar,
                        },
                        time: this.time()
                    });

                    axios.post(`/chat/${this.originalOrderCode}`, {
                        message: this.message
                    });

                    this.message = null;
                }
            },

            time() {
                let time = new Date();
                return time.getHours() + ":" + time.getMinutes();
            },

            classes(messageOwnerName) {
                return messageOwnerName == window.User.name ? 'message-from-me' : 'message-from-others';
            },

        }
    }
</script>

<style>
    .chat-btn {
        position: absolute;
        right: 0;
        top: 100px;
    }

    .user-media-list {
        overflow-y: scroll;
        max-height: 600px;
    }

    .message-from-me, .message-from-other {
        padding: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        overflow: hidden;
    }
    .message-from-me {
        background: #fafafa;
    }

    .message-from-others {
        background: #ddd;
    }

</style>
