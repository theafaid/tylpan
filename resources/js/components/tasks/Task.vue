<template>
    <li class="flex-card simple-shadows task-card">
        <article class="message" :class="task.formattedStatus.class">
            <h4 class="message-header">
                <span v-if="task.notice">{{task.notice}}</span>
                <span class="is-pulled-right">
                    {{task.formattedStatus.name}} &nbsp; <i :class="task.formattedStatus.icon"></i>
                </span>
            </h4>
        </article>
        <article class="media">
            <figure class="media-left">
                <p class="image is-48x48">
                    <img class="img-circle" :src="task.founder.profile.formattedAvatar">
                    <span class="avatar-status is-online"></span>
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p v-if="! editing">
                        <span v-text="task.founder.defaultName"></span>
                        <br>
                        {{task.task}}
                    </p>
                    <div v-else>
                        <div class="column">
                            <div class="control">
                                <label>Task</label>
                                <input class="input is-medium" v-model="form.task">
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <label>Notice</label>
                                <input class="input is-medium" v-model="form.notice">
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <button class="button is-primary text-white" @click.prevent="update">Update</button>
                                <button class="button is-primary text-white" @click="editing=false">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <p class="level-right" v-show="! $gate.isUser() && ! me">
                        <a
                            class="button btn-square is-small"
                            :class="[(task.formattedStatus.name == 'progressing' ? 'is-primary' : ''), form.busy ? 'is-loading is-disabled' : '']"
                            @click.prevent="form.status = 'progressing'">
                            <i class="sl sl-icon-reload"></i>
                        </a>
                        <a
                            class="button btn-square is-small"
                            :class="[(task.formattedStatus.name == 'completed' ? 'is-primary' : ''), form.busy ? 'is-loading is-disabled' : '']"
                            @click.prevent="form.status='completed'">
                            <i class="sl sl-icon-check"></i>
                        </a>

                        <a
                            class="button btn-square is-small"
                            :class="[(task.formattedStatus.name == 'failed' ? 'is-primary' : ''), form.busy ? 'is-loading is-disabled' : '']"
                            @click.prevent="form.status='failed'">
                            <i class="sl sl-icon-close"></i>
                        </a>
                        <template>
                            <a v-if="! editing" class="button btn-square is-small" @click.prevent="editing=true">
                                <i class="sl sl-icon-pencil"></i>
                            </a>
                        </template>
                        <a class="button btn-square is-small"><i class="sl sl-icon-trash"></i></a>
                    </p>
                </div>
            </div>
        </article>
    </li>
</template>

<script>
    export default {
        props: ['task', 'me'],

        data() {
            return {
                editing: false,

                form: new Form({
                    task: this.task.task,
                    status: this.task.formattedStatus.name,
                    notice: this.task.notice,
                })
            }
        },

        watch: {
            'form.status'(value) {
                if(value == this.task.status) {
                    this.toast('warning', 'Task already ' + value);
                } else {
                    this.update();
                }
            },
        },

        computed: {
            validForm() {
                return !! (this.form.task && this.form.status && this.form.status != this.task.status) ;
            }
        },

        methods: {
            update() {
                this.form.patch(`${location.pathname}/${this.task.id}`)
                    .then(({data}) => this.updatedSuccessfully(data));
            },

            updatedSuccessfully(data) {
                this.editing = false;
                this.$emit('updated', data);
                this.toast('success', 'Task Updated Successfully');
            },
        }
    }
</script>
