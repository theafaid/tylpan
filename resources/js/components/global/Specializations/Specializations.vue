<template>
    <div>
        <filterable></filterable>
    </div>
</template>


<script>
    import Filterable from '../Filters/Filterable';

    import Specialization from "./Specialization";

    export default {
        components: {
            Filterable, Specialization
        },

        data() {
            return {
                filterable: {
                    url: '/dashboard/api/specializations'
                }
            }
        },

        mounted() {

        }
    }
</script>
