<template>
   <div>
       <template v-if="! $gate.isUser()">
            <div class="columns">
                <div class="column is-6">
                    <button class="button" :class="! me ? 'primary-btn' : ''" @click="loadTasks(false); me=!me">
                        Owner tasks
                    </button>
                    <button class="button" :class="me ? 'primary-btn' : ''" @click.prevent="loadTasks(true); me=!me">
                        My Tasks
                    </button>
                </div>
            </div>
       </template>

       <ul class="user-media-list" v-if="tasks.length" v-chat-scroll>
           <task
               v-for="task in tasks"
               :task="task"
               :key="task.id"
               :me="me"
                @updated="updated"></task>
       </ul>
       <span v-else>
            <article class="message icon-msg info-msg">
                <i class="fa fa-comment-o"></i>
                <div class="message-body">
                    <h4>There is no created tasks till not for this order.</h4>
                </div>
            </article>
       </span>
       <template v-if="! $gate.isUser() && ! me">
           <div class="columns">
               <div class="column is-8">
                   <div class="field">
                       <div class="control">
                           <input
                               v-model="form.task"
                               placeholder="Add a new task"
                               class="input is-medium mt-5"
                               type="text">
                       </div>
                   </div>
               </div>
               <div class="column is-2">
                   <a class="button button-cta rounded" @click.prevent="selectFor('owner')" :class="form.task_for == order_owner_id ? 'primary-btn' : ''">Owner</a>
               </div>
               <div class="column is-2">
                   <template>
                       <a v-if="$gate.isDelegate()" class="button button-cta rounded" @click.prevent="selectFor('admin')" :class="delegate_assignor_id && form.task_for == delegate_assignor_id ? 'primary-btn' : ''">
                           Admin
                       </a>
                       <a v-else="$gate.isAdmin()" class="button button-cta rounded" @click.prevent="selectFor('delegate')" :class="form.task_for == order_delegate_id ? 'primary-btn' : ''">
                           Delegate
                       </a>
                   </template>
               </div>
           </div>
           <div class="columns">
               <div class="column">
                   <a @click.prevent="addTask" :class="form.busy ? 'is-loading is-disabled' : ''" class="button button-cta rounded is-danger">Send Task</a>
               </div>
           </div>
       </template>
   </div>
</template>

<script>
    import Task from './Task';

    export default {
        components: {
            Task,
        },

        data() {
            return {
                me: false,
                tasks: [],
                order_owner_id: null,
                order_delegate_id: null,
                delegate_assignor_id: null,

                form: new Form({
                    task: null,
                    task_for: this.order_owner_id
                }),
            }
        },

        mounted() {
            this.loadTasks(false);
        },

        computed: {
            validForm() {
                return !! (this.form.task && this.form.task_for);
            },
        },

        methods: {
            addTask() {
                if(this.validForm) {
                    this.form.post(location.pathname)
                        .then(({data}) => {
                            this.toast('success', 'Task Sent Successfully');
                            this.tasks.push(data);
                            this.form.task = null;
                        });
                } else {
                    this.toast('warning', 'Please type a task and select for who !');
                }
            },

            loadTasks(me = false) {
                axios.get(location.pathname + (me ? '?me=1' : ''))
                    .then(({data}) => {
                        this.tasks = data.tasks;
                        this.order_owner_id = data.order_owner_id;
                        this.order_delegate_id = data.order_delegate_id;
                        this.delegate_assignor_id = data.delegate_assignor_id;
                    });
            },

            selectFor(type = 'owner') {
                if(type == 'owner') {
                    this.form.task_for = this.order_owner_id;
                } else if(type == 'delegate') {
                    if(this.order_delegate_id && this.$gate.isAdmin()) {
                        this.form.task_for = this.order_delegate_id;
                    }else if(! this.order_delegate_id && this.$gate.isAdmin()) {
                        this.toast('warning', 'Please assign a delegate to this order first!.');
                        this.form.task_for = this.order_owner_id;
                    }else {
                        this.toast('error', 'Seems like you play around this site !');
                    }
                } else if(type == 'admin') {
                    if(this.delegate_assignor_id && this.$gate.isDelegate()) {
                        this.form.task_for = this.delegate_assignor_id;
                    }else if(! this.delegate_assignor_id) {
                        this.toast('warning', 'There is no admin. Maybe removed.');
                    }else {
                        this.toast('error', 'It seems like you are an admin and you play around this site !!');
                    }
                } else {
                    this.form.task_for = this.order_owner_id;
                }
            },

            updated(updatedTask) {
                let index = this.tasks.indexOf(this.tasks.find(task =>  task.id == updatedTask.id));

                Object.assign(this.tasks[index], updatedTask);
            }
        }
    }
</script>
