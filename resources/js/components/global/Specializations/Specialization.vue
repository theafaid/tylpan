<template>
    <tr>
        <td v-text="specialization.id"></td>
        <td v-text="specialization.name"></td>
        <td v-text="11"></td>
        <td>
            <button
                class="button btn-align is-small raised has-text-centered"
                @click.prevent="toggleActive"
                :class="activationStatue.class">
                <i :class="activationStatue.icon"></i> {{activationStatue.text}}
            </button>
        </td>
        <td>
            <button class="button is-small btn-align accent-btn raised rounded btn-outlined">Hire now</button>
            <button class="button is-small btn-align accent-btn raised rounded btn-outlined">Hire now</button>
            <button class="button is-small btn-align accent-btn raised rounded btn-outlined">Hire now</button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['specialization'],

        data() {
            return {
                active: this.specialization.active,
            }
        },

        computed: {
            activationStatue() {
                return {
                    text: this.active  ? 'Deactivate'  : 'Activate',
                    icon: this.active  ? 'fa fa-close' : 'fa fa-true',
                    class: this.active ? 'danger-btn'  : 'success-btn',
                };
            }
        },

        methods: {
            toggleActive() {
                axios.post(`${location.pathname}/${this.specialization.id}/activation`)
                    .then(response => {
                        this.active = ! this.active;
                    });
            }
        }
    }
</script>
