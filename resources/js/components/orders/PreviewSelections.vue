<template>
    <div class="columns">
        <div class="column is-12">
            <h2><strong>I want to travel to: </strong></h2>
            <ul class="user-list">
                <li
                    v-for="(country, index) in countries" :key="index">
                    <div class="user-list-avatar">
                        <img :src="country.flag" :title="country.name">
                    </div>
                    <div class="user-list-info">
                        <div class="name">{{country.name}}</div>
                        <div class="position" v-if="(countries.length > 1) && (index+1 != countries.length)">
                            <br> OR
                        </div>
                    </div>
                </li>
            </ul>

            <hr>

            <template>
                <h2 v-if="! universities.length"><strong>And we will choose a university for you.</strong></h2>
                <div v-else>
                    <h2><strong>I have selected these universities: </strong></h2>
                    <ul class="user-list">
                        <li
                            v-for="(university, index) in universities" :key="index">
                            <div class="user-list-info">
                                <div class="name">{{university.name}} | {{university.country.name}}</div>
                                <div class="position" v-if="(universities.length > 1) && (index+1 != universities.length)">
                                    <br>OR
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </template>

            <h2><strong>I have selected these specializations:</strong></h2>
            <ul class="user-list">
                <li
                    v-for="(specialization, index) in specializations" :key="index">
                    <div class="user-list-info">
                        <div class="name">{{specialization}}</div>
                        <div class="position" v-if="(specializations.length > 1) && (index+1 != specializations.length)">
                            <br>OR
                        </div>
                    </div>
                </li>
            </ul>

            <h2><strong>My Maximum budget is {{budget}} $</strong></h2>

            <div class="level-right mt-20">
                <p class="level-item">
                    <a @click="confirm" class="button button-cta btn-outlined primary-btn rounded" v-if="! isLoading">Confirm</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import InfoBlock from "./InfoBlock";
    export default {
        components: {InfoBlock},

        props: ['countries', 'universities', 'budget', 'specializations', 'isLoading'],

        data() {
            return {
                form: null,
            }
        },

        methods: {
            confirm() {
                this.loading = true;
                this.createForm();
                this.broadcast();
            },

            createForm() {
                this.form = {
                    countries: this.getIds(this.countries),
                    universities: this.getIds(this.universities),
                    specializations: this.specializations,
                    budget: this.budget,
                };
            },

            getIds(data) {
                if(! data.length) return null;

                return data.map(item => item['id']);
            },

            broadcast() {
                this.$emit('confirmed', this.form);
            }
        }
    }
</script>
