<template>
    <div class="flex-card light-bordered raised" id="travel-form">
        <!-- Modal trigger -->
        <span class="univ-details-modal-trigger-button modal-trigger is-hidden" data-modal="univ-details-modal"></span>
        <!-- /Modal trigger -->
        <university-details :university="universityDetails"></university-details>

        <div  class="card-body">
            <div class="content">
                <h2 class="no-margin text-bold" v-text="tabText ? tabText : 'Countries Details'"></h2>
                <div class="navigation-tabs animated-tabs square-pills circle-pills">
                    <div class="tabs is-centered">
                        <ul>
                            <li @click="tabText='Countries Details'" class="is-active" data-tab="tab-s1"><a><span class="icon"><i class="sl sl-icon-globe"></i></span></a></li>
                            <li v-show="selectedCountries.length" @click="tabText='Universities Details'" data-tab="tab-s2"><a><span class="icon"><i class="sl sl-icon-home"></i></span></a></li>
                            <li v-show="selectedCountries.length" @click="tabText='Specializations Details'" data-tab="tab-s3"><a><span class="icon"><i class="sl sl-icon-graduation"></i></span></a></li>
                            <li v-show="selectedCountries.length && selectedSpecializations.length" @click="tabText='Budget'" data-tab="tab-s4"><a><span class="icon"><i class="sl sl-icon-social-dropbox"></i></span></a></li>
                            <li v-show="selectedCountries.length && selectedSpecializations.length && selectedBudget" @click="tabText='Finalization'" data-tab="tab-s5"><a><span class="icon"><i class="sl sl-icon-check"></i></span></a></li>
                        </ul>
                    </div>
                    <div id="tab-s1" class="navtab-content is-active">
                        <countries-selection
                            :countries="countries"
                            @selected="countriesSelected"
                            @unselected="countriesUnselected">
                        </countries-selection>
                    </div>
                    <div id="tab-s2" class="navtab-content">
                        <universities-selection
                            v-if="this.selectedCountries.length"
                            :countries="countriesIds"
                            @selected="universitiesSelected"
                            @unselected="universitiesUnselected"
                            @showUniversityDetails="showUniversityDetails">
                        </universities-selection>
                    </div>
                    <div id="tab-s3" class="navtab-content">
                        <specialization-selection
                            @selected="specializationsSelected"
                            @unselected="specializationsUnselected"
                        ></specialization-selection>
                    </div>
                    <div id="tab-s4" class="navtab-content">
                        <budget-selection
                            @selected="budgetSelected"
                            @unselected="budgetUnselected"
                        ></budget-selection>
                    </div>
                    <div id="tab-s5" class="navtab-content">
                        <preview-selections
                            :countries="selectedCountries"
                            :universities="selectedUniversities"
                            :specializations="selectedSpecializations"
                            :budget="selectedBudget"
                            :is-loading="isLoading"
                            @confirmed="confirmed"></preview-selections>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CountriesSelection from './CountriesSelection';
    import UniversitiesSelection from './UniversitiesSelection';
    import UniversityDetails from './modals/UniversityDetails';
    import SpecializationSelection from './SpecializationsSelection';
    import BudgetSelection from './BudgetSelection';
    import PreviewSelections from "./PreviewSelections";

    export default {
        components: {
            PreviewSelections,
            CountriesSelection,
            UniversitiesSelection,
            UniversityDetails,
            SpecializationSelection,
            BudgetSelection,
        },

        props: ['countries'],

        data() {
            return {
                tabText: null,
                universityDetails: null,
                isLoading: false,
                selectedCountries: [],
                selectedUniversities: [],
                selectedSpecializations: [],
                selectedBudget: false,

                form: new Form({
                    countriesIds: this.countriesIds,
                    universitiesIds: [],
                    specializations: this.selectedSpecializations
                })
            }
        },

        computed: {
            countriesIds() {
                return this.selectedCountries.map(country => country['id']);
            },
        },

        methods: {

            here() {
                this.toast('success');
            },

            showUniversityDetails(university) {
                this.universityDetails = university;

                if(this.universityDetails) $(".univ-details-modal-trigger-button").trigger('click');
            },

            countriesSelected(countries) {
                this.selectedCountries = countries;
            },

            countriesUnselected(){
                this.selectedCountries.splice(0, this.selectedCountries.length);
            },

            universitiesSelected(data) {
                // data.map(university => university.id);
                this.selectedUniversities = data;
            },

            universitiesUnselected() {
                this.selectedUniversities.splice(0, this.selectedUniversities.length);
            },

            specializationsSelected(data) {
                this.selectedSpecializations = data;
            },

            specializationsUnselected() {
                this.selectedSpecializations.splice(0, this.selectedSpecializations.length);
            },

            budgetSelected(budget) {
                this.selectedBudget = budget;
            },

            budgetUnselected() {
                this.selectedBudget = false;
            },

            confirmed(form) {
                this.isLoading = true;
                this.create(form);
            },

            create(data) {
                axios.post("/orders", data)
                    .then(response => {
                       this.success(response.data.msg)
                    })
                    .catch(error => {
                        this.error()
                    });
            },

            success(msg) {
                setTimeout(() => {
                    window.location = '/orders';
                }, 1000);

                this.toast('success', msg);
            },

            error() {
                this.isLoading = false;
                this.toast('error', 'Something went wrong! Please Review Your Details Once Again.', 'close');
            }
        }
    }
</script>

<style>
    #travel-form {
        overflow-x: auto;
    }
</style>
