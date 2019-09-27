<template>
    <div class="demo">
        <template >
            <div class="select is-large" v-if="delegates.length">
                <select v-model="form.delegate_id">
                    <option value="">Select a delegate</option>
                    <option
                        v-for="delegate in delegates"
                        :selected="delegate.id === assignedDelegateId"
                        :key="delegate.id"
                        :value="delegate.id"
                        v-text="delegate.fullName">
                    </option>
                </select>
            </div>

            <a
                v-else
                @click.prevent="loadDelegates"
                class="button btn-outlined success-btn">
                <i class="sl sl-icon-reload"></i> Load Delegates in {{country.name}}
            </a>
        </template>

        <template>
            <template v-if="form.delegate_id && delegates.length">
                <a
                    @click.prevent="confirmAssigning"
                    class="button btn-outlined success-btn">
                    <i class="sl sl-icon-check"></i> Assign to this order.
                </a>

                <a
                    @click.prevent="cancel"
                    class="button btn-outlined warning-btn">
                    <i class="sl sl-icon-close"></i> Cancel
                </a>
            </template>
            <template v-else>
                <a
                    v-if="assignedDelegateId"
                    @click.prevent="dismiss"
                    class="button btn-outlined danger-btn">
                    <i class="sl sl-icon-close"></i> Dismiss Delegate
                </a>
            </template>
        </template>
    </div>
</template>

<script>
    export default {

        props: ['country', 'assignedDelegateId', 'orderCode'],

        data() {
            return {
                delegates: [],
                form: new Form({
                   delegate_id: this.assignedDelegateId ? this.assignedDelegateId : '',
                })
            }
        },

        methods: {
            loadDelegates() {
                axios.get(`/dashboard/countries/${this.country.alpha2_code}/delegates`)
                    .then(({data}) => {
                        this.loaded(data);
                    })
                    .catch((response) => this.error());
            },

            loaded(data) {
                this.delegates = data;
                this.delegates.length ? this.delegatesFound() : this.delegatesNotFound();
            },

            delegatesFound() {
                this.toast('success', 'Delegates loaded');
            },

            delegatesNotFound() {
                this.toast('warning', 'There no delegates in ' + this.country.name + ' right now ! Create one ', 'From here', '/dashboard/users/create');
            },

            error() {
                this.toast('error', 'Something went wrong!. try again')
            },

            confirmAssigning() {
                if(this.form.delegate_id ) {
                    if(confirm('Are you sure to assign this delegate to this order ?')) {
                        this.assign();
                    }
                }else {
                    this.toast('warning', 'Delegate is already assigned!');
                }
            },

            assign() {
                this.form.post(`/dashboard/orders/${this.orderCode}/delegate`)
                    .then(({data}) => this.success(data));
            },

            dismiss() {
                if(confirm('Are you sure to dismiss this order delegate ?')) {
                    axios.delete(`/dashboard/orders/${this.orderCode}/delegate`)
                        .then(({data}) => this.success(data));
                }
            },

            success(payload) {
                setTimeout(() => location.reload(), 1500);
                this.cancel();
                this.toast('success', payload.message);
            },

            cancel() {
                this.delegates = [];
            }
        }

    }
</script>
