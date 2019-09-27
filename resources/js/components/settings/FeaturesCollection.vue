<template>
    <filterable v-bind="filterable">
        <thead slot="thead">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        </thead>
        <tr slot-scope="{item}">
            <td>{{item.title}}</td>
            <td>{{item.description}}</td>
            <td>
                <a v-if="item.image" :href="item.image" target="_blank">View</a>
                <template v-else>No Image</template>
            </td>
            <td>
                <a @click="destroy('/dashboard/features/' + item.id, item.title)" class="button is-small btn-align danger-btn raised rounded btn-outlined">
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
                    url: '/dashboard/features',
                    orderables: [
                        {title: 'Title', name: 'title'},
                    ],

                    filterGroups: [
                        {
                            name: 'Feature',
                            filters: [
                                {title: 'Title', name: 'title', type: 'string'},
                                {title: 'Description', name: 'description', type: 'string'},
                            ]
                        },
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
