<template>
    <form @submit.prevent="submit" @keydown="form.onKeydown($event)">
        <div class="columns">
            <div class="column is-12">
                <label>Education Level</label>
                <div class="field">
                    <div class="control">
                        <div class="select">
                            <select
                                :class="{ 'is-danger': form.errors.has('education_level') }"
                                v-model="form.education_level"
                                name="education_level">
                                <option value="high_school">High School</option>
                                <option value="some_college">Some College</option>
                                <option value="bachelor">Bachelor</option>
                                <option value="master">Master</option>
                                <option value="doctoral">Doctoral</option>
                            </select>
                        </div>
                    </div>
                </div>
                <has-error :form="form" field="education_level" class="danger-text"></has-error>
            </div>
        </div>
        <div class="columns">
            <div class="column is-12">
                <div class="control">
                    <label>Education Brief</label>
                    <div class="control">
                        <textarea
                            :class="{ 'is-danger': form.errors.has('education_brief') }"
                            v-model="form.education_brief"
                            name="education_brief"
                            class="textarea"
                            rows="15"
                            placeholder="Tell us more about your education with any language :)."></textarea>
                    </div>
                </div>
                <has-error :form="form" field="education_brief" class="danger-text"></has-error>
            </div>
        </div>

        <div class="mt-30">
            <button
                class="button btn-align no-lh raised primary-btn"
                :class="form.busy ? 'is-loading is-disabled' : ''">
                <i class="sl sl-icon-check"></i> Update Education Settings Data
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                form: new Form({
                    education_level: this.user.profile.education_level,
                    education_brief: this.user.profile.education_brief,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(location.pathname + '/required-education-settings')
                    .then(({data}) => {
                        this.success(data)
                    })
                    .catch(error => {this.error()})
            },

            success(data) {
                this.$eventBus.$emit('updated', data);
                this.toast('success', 'Education data updated successfully');
            },

            error() {
                this.toast('error', 'Invalid Inserted Data');
            }
        }
    }
</script>
