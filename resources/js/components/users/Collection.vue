<template>
    <filterable v-bind="filterable">
        <thead slot="thead">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tr slot-scope="{item}">
                <td>{{item.first_name}}</td>
                <td>{{item.last_name}}</td>
                <td>{{item.role}}</td>
                <td>{{item.email}}</td>
                <td>
                    <a
                        :href="'/profile/' + item.id"
                        class="button is-small btn-align accent-btn raised rounded btn-outlined">
                        <i class="sl sl-icon-eye"></i>
                    </a>
<!--                    <a-->
<!--                        :href="'/dashboard/users/' + item.id + '/edit'"-->
<!--                        class="button is-small btn-align primary-btn raised rounded btn-outlined">-->
<!--                        <i class="sl sl-icon-note"></i>-->
<!--                    </a>-->
                    <a @click="destroy('/dashboard/users/' + item.id, item.first_name)" class="button is-small btn-align danger-btn raised rounded btn-outlined">
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
                    url: '/dashboard/users',
                    orderables: [
                        {title: 'First Name', name: 'first_name'},
                        {title: 'Last Name', name: 'last_name'},
                        {title: 'Role', name: 'role'},
                        {title: 'Member Since', name: 'created_at',}
                    ],

                    filterGroups: [
                        {
                            name: 'User',
                            filters: [
                                {title: 'First Name', name: 'first_name', type: 'string'},
                                {title: 'Last Name', name: 'last_name', type: 'string'},
                                {title: 'Email', name: 'email', type: 'string'},
                                {title: 'Role', name: 'role', type: 'string'},
                                {title: 'Member Since', name: 'created_at', type: 'datetime'}
                            ]
                        },

                        {
                            name: 'Country',
                            filters: [
                                {title: 'Name', name: 'country.name', type: 'string'},
                                {title: 'Code', name: 'country.alpha2_code', type: 'string'},
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
