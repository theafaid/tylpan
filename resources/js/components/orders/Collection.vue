<template>
    <filterable v-bind="filterable">
        <thead slot="thead">
        <tr>
            <th>Code</th>
            <th>Owner</th>
            <th>Delegate</th>
            <th>Status</th>
            <th>From</th>
            <th>Budget</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tr slot-scope="{item}">
            <td>{{item.formattedCode}}</td>
            <td>
                <a :href="'/profile/' + item.owner.id">{{item.owner.defaultName}}</a>
            </td>
            <td>
                <a v-if="item.delegate" :href="'/profile/' + item.delegate.id">{{item.delegate.defaultName}}</a>
                <span v-else class="b-badge is-danger">Not Assigned</span>
            </td>
            <td>
                <span class="b-badge" :class="item.formattedStatus.class">
                    <i :class="item.formattedStatus.icon"></i>
                    {{item.formattedStatus.name}}
                </span>
            </td>
            <td>
                <a
                    :href="'/dashboard/countries/' + item.owner.country.alpha2_code">
                    {{item.owner.country.name}}
                </a>
            </td>
            <td>{{item.formattedBudget}}</td>
            <td>{{item.created_at}}</td>
            <td>{{item.updated_at}}</td>
            <td>
                <a
                    :href="'/orders/' + item.code"
                    class="button is-small btn-align accent-btn raised rounded btn-outlined">
                    <i class="sl sl-icon-eye"></i>
                </a>
                <a
                    :href="'/dashboard/orders/' + item.code + '/edit'"
                    class="button is-small btn-align primary-btn raised rounded btn-outlined">
                    <i class="sl sl-icon-note"></i>
                </a>
                <a @click="destroy('/dashboard/orders/' + item.code, 'Order ' + item.formattedCode)" class="button is-small btn-align danger-btn raised rounded btn-outlined">
                    <i class="sl sl-icon-trash"></i>
                </a>
            </td>
        </tr>
    </filterable>
</template>

<script>
    import Filterable from '../global/Filters/Filterable'

    export default {
        components: {
            Filterable,
        },

        data() {
            return {
                filterable: {
                    url: '/dashboard/orders',
                    orderables: [
                        {title: 'Created At', name: 'created_at'},
                        {title: 'Updated At', name: 'updated_at'},
                        {title: 'Status', name: 'status'},
                        {title: 'Budget', name: 'budget'},
                    ],

                    filterGroups: [
                        {
                            name: 'Order',
                            filters: [
                                {title: 'Code', name: 'code', type: 'string'},
                                {title: 'Status', name: 'status', type: 'string'},
                                {title: 'Budget', name: 'budget', type: 'numeric'},
                                {title: 'Created At', name: 'created_at', type: 'datetime'},
                                {title: 'Update At', name: 'created_at', type: 'datetime'},
                                {title: 'Countries Count', name: 'countries.count', type: 'counter'},
                                {title: 'Universities Count', name: 'universities.count', type: 'counter'},
                                {title: 'Tasks Count', name: 'tasks.count', type: 'counter'},
                            ]
                        },

                        {
                            name: 'Owner',
                            filters: [
                                {title: 'First Name', name: 'owner.fist_name', type: 'string'},
                                {title: 'Last Name', name: 'owner.last_name', type: 'string'},
                                {title: 'Email', name: 'owner.email', type: 'string'},
                                {title: 'Role', name: 'owner.role', type: 'string'},
                                {title: 'Phone Number', name: 'owner.phone_number', type: 'string'},
                                {title: 'Country', name: 'owner.country.name', type: 'string'},
                            ]
                        },

                        {
                            name: 'Delegate',
                            filters: [
                                {title: 'First Name', name: 'delegate..fist_name', type: 'string'},
                                {title: 'Last Name', name: 'delegate..last_name', type: 'string'},
                                {title: 'Email', name: 'delegate..email', type: 'string'},
                                {title: 'Role', name: 'delegate..role', type: 'string'},
                                {title: 'Phone Number', name: 'delegate..phone_number', type: 'string'},
                            ]
                        }
                    ],
                },
            }
        },

        methods: {
            destroy(url, text) {
                if(confirm(`Are you sure to delete ${text ? ' ' + text + '?' : '?'}`)) {
                    axios.delete(url)
                        .then(response => this.$eventBus.$emit('changed'))
                        .catch(error => alert(error.response.message));

                }
            }
        }
    }
</script>
