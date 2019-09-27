<template>
    <div class="columns">
        <div class="column is-12">
            <info-block :finished="finished">
                <span class="text-bold"> First of all, You have to choose one or more country from our available countries.</span>
                <br>
                If you didn't see your country, then all you have to do is contact us and we hope it will be available
                in the future as.
            </info-block>

            <div class="" v-if="selectedCountries.length">
                <div class="content">
                    <h2 class="mb-20 text-bold">Selected Countries</h2>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Flag</th>
                            <th v-if="! finished">Remove</th>
                        </tr>
                        <tr
                            v-for="country in selectedCountries"
                            :key="country.id">
                            <td>
                                <span class="text-bold" v-text="country.name"></span>
                            </td>
                            <td>
                                <img :src="country.flag" class="image shadowed-country" width="50" height="50un"/>
                            </td>
                            <td v-if="! finished">
                                <a class="button button-cta btn-outlined danger-btn rounded" @click.prevent="remove(country.id)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <nav class="level nav-level" v-if="! finished">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
                        <div class="field has-addons">
                            <div class="select">
                                <select
                                    v-model="selectedCountry">
                                    <option value="">Select Country to travel</option>
                                    <option
                                        v-for="country in countries"
                                        :value="country.id"
                                        :key="country.id"
                                        v-text="country.name">
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right side -->
                <div class="level-right mt-20">
                    <p class="level-item"><a class="button btn-align accent-btn raised" @click="add">Add Country</a></p>
                </div>
            </nav>
            <div class="level-right mt-20" v-if="this.selectedCountries.length">
                <p class="level-item">
                    <a class="button button-cta btn-outlined primary-btn rounded" @click="finished=! finished">
                        {{finished ? 'Cancel' : 'Finish'}}
                    </a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import InfoBlock from "./InfoBlock";
    export default {
        components: {InfoBlock},
        props: ['countries', 'selected'],

        data() {
            return {
                finished: false,
                selectedCountry: '',
                selectedCountries: this.selected ? this.selected : [],
            }
        },

        watch:  {
            'finished'(value) {
                value == true ? this.finish() : this.back()
            }
        },

        methods: {
            add() {
                if(! this.selectedCountry) return;

                let selectedCountry = this.countries.find(country => country.id == this.selectedCountry);

                if(typeof (this.selectedCountries.find(country => country.id == selectedCountry.id)) === 'undefined') {
                    this.selectedCountries.push(selectedCountry);
                }

                this.selectedCountry = '';
            },

            remove(countryId) {
                this.selectedCountries.splice(
                    this.selectedCountries.indexOf(this.selectedCountries.find(country => country.id == countryId)), 1
                )
            },

            finish() {
                if (this.selectedCountries.length) {
                    this.$emit('selected', this.selectedCountries.slice(0));
                }
            },

            back() {
                this.$emit('unselected');
            }
        }
    }
</script>

<style>
    .shadowed-country {
        box-shadow:  2px 2px 10px 2px #969696;
    }
</style>
