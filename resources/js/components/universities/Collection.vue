<template>
    <filterable v-bind="filterable">
        <thead slot="thead">
        <tr>
            <th>Name</th>
            <th>Country</th>
            <th>Site Url</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        </thead>
        <tr slot-scope="{item}">
            <td>{{item.name}}</td>
            <td>{{item.country.name}}</td>
            <td>{{item.site_url}}</td>
            <td>
                <a :href="item.formattedImage" target="_blank">View</a>
            </td>
            <td>
                <a
                    :href="'/countries/' + item.country.alpha2_code + '/universities/' + item.slug"
                    class="button is-small btn-align accent-btn raised rounded btn-outlined">
                    <i class="sl sl-icon-eye"></i>
                </a>
                <a
                    :href="'/dashboard/universities/' + item.slug + '/edit'"
                    class="button is-small btn-align primary-btn raised rounded btn-outlined">
                    <i class="sl sl-icon-note"></i>
                </a>
                <a @click="destroy('/dashboard/universities/' + item.slug, item.name)" class="button is-small btn-align danger-btn raised rounded btn-outlined">
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
                    url: '/dashboard/universities',
                    orderables: [
                        {title: 'Name', name: 'name'},
                        {title: 'Site URL', name: 'site_url'},
                        {title: 'Country Name', name: 'country.name'},
                        {title: 'Country Code', name: 'country.alpha2_code'},
                    ],

                    filterGroups: [
                        {
                            name: 'University',
                            filters: [
                                {title: 'Name', name: 'name', type: 'string'},
                                {title: 'Site URL', name: 'site_url', type: 'string'},
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
