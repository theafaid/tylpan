<template>
    <filterable v-bind="filterable">
        <thead slot="thead">
        <tr>
            <th>Name</th>
            <th>Code</th>
            <th>Region</th>
            <th>Allow travel from ?</th>
            <th>Allow travel to ?</th>
            <th>Action</th>
        </tr>
        </thead>
        <tr slot-scope="{item}">
            <td>{{item.name}}</td>
            <td>{{item.alpha2_code}}</td>
            <td>{{item.region}}</td>
            <td>{{!! item.travel_from}}</td>
            <td>{{!! item.travel_to}}</td>
            <td>
                <a
                    :href="'/dashboard/countries/' + item.alpha2_code"
                    class="button is-small btn-align accent-btn raised rounded btn-outlined">
                    <i class="sl sl-icon-eye"></i>
                </a>
                <a
                    :href="'/dashboard/countries/' + item.alpha2_code + '/edit'"
                    class="button is-small btn-align primary-btn raised rounded btn-outlined">
                    <i class="sl sl-icon-note"></i>
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
                    url: '/dashboard/countries',
                    newButton: false,
                    orderables: [
                        {title: 'Name', name: 'name'},
                        {title: 'Code', name: 'alpha2_code'},
                        {title: 'Region', name: 'region'},
                        {title: 'Allow Travel From', name: 'travel_from',},
                        {title: 'Allow Travel To', name: 'travel_to',}
                    ],

                    filterGroups: [
                        {
                            name: 'Country',
                            filters: [
                                {title: 'Name', name: 'name', type: 'string'},
                                {title: 'Code', name: 'alpha2_code', type: 'string'},
                                {title: 'Region', name: 'region', type: 'string'},
                                {title: 'Allow Travel From', name: 'travel_from', type: 'boolean'},
                                {title: 'Allow Travel To', name: 'travel_to', type: 'boolean'}
                            ]
                        },

                        {
                            name: 'User',
                            filters: [
                                {title: 'All Users Count', name: 'users.count', type: 'counter'},
                                {title: 'Delegates Count', name: 'delegates.count', type: 'counter'},
                            ]
                        }
                    ],
                },
            }
        },
    }
</script>
