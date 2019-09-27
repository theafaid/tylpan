<template>
    <form @submit.prevent="submit" @keydown="form.onKeydown($event)">

        <template v-if="! securityUpdating">
            <div class="columns mt-20">
                <div class="column is-4">
                    <div class="field mb-20">
                        <div class="control has-icons-left">
                            <label>First Name</label>
                            <input
                                v-model="form.first_name"
                                :class="{ 'is-danger': form.errors.has('first_name') }"
                                class="input is-medium mt-5"
                                type="text"
                                name="first_name">
                            <span class="icon is-small is-left input-icon">
                            <i class="sl sl-icon-user"></i>
                        </span>
                        </div>
                    </div>
                    <has-error :form="form" field="first_name" class="danger-text"></has-error>
                </div>
                <div class="column is-4">
                    <div class="field mb-20">
                        <div class="control has-icons-left">
                            <label>Middle Name</label>
                            <input
                                v-model="form.middle_name"
                                :class="{ 'is-danger': form.errors.has('middle_name') }"
                                class="input is-medium mt-5"
                                type="text"
                                name="middle_name">
                            <span class="icon is-small is-left input-icon">
                            <i class="sl sl-icon-user"></i>
                        </span>
                        </div>
                    </div>
                    <has-error :form="form" field="middle_name" class="danger-text"></has-error>
                </div>
                <div class="column is-4">
                    <div class="field mb-20">
                        <div class="control has-icons-left">
                            <label>Last Name</label>
                            <input
                                v-model="form.last_name"
                                :class="{ 'is-danger': form.errors.has('last_name') }"
                                class="input is-medium mt-5"
                                type="text"
                                name="last_name">
                            <span class="icon is-small is-left input-icon">
                            <i class="sl sl-icon-user"></i>
                        </span>
                        </div>
                    </div>
                    <has-error :form="form" field="last_name" class="danger-text"></has-error>
                </div>
            </div>
            <div class="columns">
                    <div class="column is-6">
                        <div class="field mb-20">
                            <div class="control has-icons-left">
                                <label>Email Address</label>
                                <input
                                    disabled
                                    :value="user.email"
                                    class="input is-medium mt-5"
                                    type="text">
                                <span class="icon is-small is-left input-icon">
                            <i class="sl sl-icon-envelope-open"></i>
                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="field mb-20">
                            <div class="control has-icons-left">
                                <label>Phone Number</label>
                                <input
                                    v-model="form.phone_number"
                                    :class="{ 'is-danger': form.errors.has('phone_number') }"
                                    min="1"
                                    class="input is-medium mt-5"
                                    type="number"
                                    name="phone_number">
                                <span class="icon is-small is-left input-icon">
                             {{callingCode}}
                        </span>
                            </div>
                        </div>
                        <has-error :form="form" field="phone_number" class="danger-text"></has-error>
                    </div>
                </div>
            <div class="columns">
                <div class="column is-6">
                    <div class="field mb-20">
                        <label class="mb-2">Country</label>
                        <div class="control has-icons-left">
                            <div class="select is-medium">
                                <select
                                    :class="{ 'is-danger': form.errors.has('country_id') }"
                                    v-model="form.country_id"
                                    name="country_id">
                                    <option
                                        v-for="country in countries"
                                        :value="country.id"
                                        :key="country.id"
                                        v-text="country.name">
                                    </option>
                                </select>
                            </div>
                            <div class="icon is-left">
                                <i class="fa fa-globe"></i>
                            </div>
                        </div>
                    </div>
                    <has-error :form="form" field="country_id" class="danger-text"></has-error>
                </div>
                <div class="column is-2">
                    <div class="field mb-20">
                        <div class="control has-icons-left">
                            <label>Age</label>
                            <input
                                v-model="form.age"
                                :class="{ 'is-danger': form.errors.has('age') }"
                                class="input is-medium mt-5"
                                type="number"
                                min="15"
                                name="age">
                            <span class="icon is-small is-left input-icon">
                        <i class="sl sl-icon-star"></i>
                    </span>
                        </div>
                    </div>
                    <has-error :form="form" field="age" class="danger-text"></has-error>
                </div>
                <div class="column is-2">
                    <div class="field mb-20">
                        <label class="mb-2">Gender</label>
                        <div class="control has-icons-left">
                            <div class="select is-medium">
                                <select
                                    :class="{ 'is-danger': form.errors.has('country_id') }"
                                    v-model="form.gender"
                                    name="gender">
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="icon is-left">
                                <i class="sl sl-icon-people"></i>
                            </div>
                        </div>
                    </div>
                    <has-error :form="form" field="gender" class="danger-text"></has-error>
                </div>
            </div>
        </template>
        <div class="columns" v-if="securityUpdating">
            <div class="column is-6">
                <div class="field mb-20">
                    <div class="control has-icons-left">
                        <label>New Password</label>
                        <input
                            v-model="form.password"
                            :class="{ 'is-danger': form.errors.has('password') }"
                            class="input is-medium mt-5"
                            type="text"
                            name="password">
                        <span class="icon is-small is-left input-icon">
                        <i class="sl sl-icon-lock"></i>
                    </span>
                    </div>
                </div>
                <has-error :form="form" field="password" class="danger-text"></has-error>
            </div>
            <div class="column is-6">
                <div class="field mb-20">
                    <div class="control has-icons-left">
                        <label>Confirm New Password</label>
                        <input
                            v-model="form.password_confirmation"
                            :class="{ 'is-danger': form.errors.has('password_confirmation') }"
                            class="input is-medium mt-5"
                            type="text"
                            name="password_confirmation">
                        <span class="icon is-small is-left input-icon">
                        <i class="sl sl-icon-lock"></i>
                    </span>
                    </div>
                </div>
                <has-error :form="form" field="password_confirmation" class="danger-text"></has-error>
            </div>
        </div>

        <div class="mt-30">
            <button
                v-if="! securityUpdating"
                class="button btn-align no-lh raised primary-btn"
                :class="form.busy ? 'is-loading is-disabled' : ''">
                <i class="sl sl-icon-check"></i> Update General Settings Data
            </button>
            <template>
                <span
                    v-if="! securityUpdating"
                    @click="securityUpdating = true"
                    class="button btn-align no-lh raised danger-btn">
                    <i class="sl sl-icon-lock"></i> Update Password
                </span>
                <button
                    v-if="securityUpdating && hasNewPassword"
                    class="button btn-align no-lh raised primary-btn"
                    :class="form.busy ? 'is-loading is-disabled' : ''">
                    <i class="sl sl-icon-check"></i> Update
                </button>
                <span
                    v-if="securityUpdating"
                    @click="securityUpdating = false"
                    class="button btn-align no-lh raised warning-btn">
                    <i class="sl sl-icon-close"></i> Cancel
                </span>
            </template>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['user', 'countries'],

        data() {
            return {
                selectedCountry: this.user.country,
                securityUpdating: false,

                form: new Form({
                    first_name: this.user.first_name,
                    middle_name: this.user.middle_name,
                    last_name: this.user.last_name,
                    email: this.user.email,
                    password: null,
                    password_confirmation: null,
                    country_id: this.user.country_id,
                    gender: this.user.profile.gender ? this.user.profile.gender : '',
                    age: this.user.profile.age,
                    phone_number: this.user.profile.phone_number
                })
            }
        },

        watch: {
            'form.country_id'(id) {
                this.selectedCountry = this.countries.find(country => country.id == id);
            }
        },

        computed: {
            callingCode() {
                return JSON.parse(this.selectedCountry.calling_codes)[0];
            },

            hasNewPassword() {
                return !! (this.form.password && this.form.password_confirmation);
            }
        },

        methods: {
            submit() {
                this.form.post(location.pathname + '/general-settings')
                    .then(({data}) => {
                        this.success(data);
                    })
                    .catch(error => {
                        this.error();
                    })
            },

            success(data) {
                this.$eventBus.$emit('updated', data);
                this.securityUpdating = false;
                this.toast('success', 'Your profile has been updated successfully');
            },

            error() {
                this.toast('error', 'Invalid Inserted Data');
            }
        }
    }
</script>

<style>
    .input-icon {
        background: #ddd !important;
        color: #fff !important;
        position: absolute !important;
        top: 27px !important;
        padding: 10px !important;
        border-bottom: 13px solid #ddd !important;
        width: 37px !important;
    }
</style>
