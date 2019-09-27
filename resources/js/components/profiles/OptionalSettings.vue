<template>
    <form @submit.prevent="submit">
        <h2 class="text text-bolder mb-15">Personality</h2>
        <div class="flex-card light-borderedlight-raised">
            <div class="card-body">
                <div class="content">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>Social Status</label>
                                    <input
                                            v-model="form.social_status"
                                        class="input is-medium mt-5"
                                        type="text">
                                    <span class="icon is-small is-left input-icon">
                                        <i class="sl sl-icon-graph"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>Health Status</label>
                                    <input
                                        v-model="form.health_status"
                                        class="input is-medium mt-5"
                                        type="text">
                                    <span class="icon is-small is-left input-icon">
                                        <i class="sl sl-icon-heart"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label class="mb-10">Your Picture</label> <br>
                                    <input
                                        id="avatar"
                                        data-input-accept-types="image/*"
                                        type="hidden"
                                        role="uploadcare-uploader">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-4">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>Your Facebook Link</label>
                                    <input
                                        v-model="facebookUrl"
                                        class="input is-medium mt-5"
                                        type="text">
                                    <span class="icon is-small is-left input-icon">
                                        <i class="sl sl-icon-link"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>Your Twitter Link</label>
                                    <input
                                        v-model="twitterUrl"
                                        class="input is-medium mt-5"
                                        type="text">
                                    <span class="icon is-small is-left input-icon">
                                        <i class="sl sl-icon-link"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>Your Instagram Link</label>
                                    <input
                                        v-model="instagramUrl"
                                        class="input is-medium mt-5"
                                        type="text">
                                    <span class="icon is-small is-left input-icon">
                                        <i class="sl sl-icon-link"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-30">
                        <button
                            class="button btn-align no-lh raised primary-btn"
                            :class="form.busy ? 'is-loading is-disabled' : ''">
                            <i class="sl sl-icon-check"></i> Update
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <h2 class="text text-bolder mb-15">Your Certificates
            <button class="is-pulled-right button danger-btn" @click.prevent="addingCertificate=true" v-if="! addingCertificate">Add Certificate <i class="sl sl-icon-plus"></i></button>
        </h2>
        <div class="flex-card light-borderedlight-raised">
            <div class="card-body">
                <div class="content">
                    <div class="flex-card light-bordered hover-raised">
                        <div class="card-body">
                            <div class="solid-list" v-if="form.certifications.length">
                                <div
                                    v-for="(certification, index) in form.certifications"
                                    class="solid-list-item">
                                    <div class="list-bullet is-danger" @click="removeFile(index)">
                                        <i class="sl sl-icon-close"></i>
                                    </div>
                                    <div class="list-text mr-20">
                                        <a :href="certification.link" v-text="certification.name" target="_blank"></a>
                                    </div>

                                </div>
                            </div>
                            <p v-else>You haven't uploaded any certification till now.</p>
                        </div>
                    </div>
                    <div class="columns" v-show="addingCertificate">
                        <div class="column is-5">
                            <div class="control">
                                <input
                                    v-model="file.name"
                                    :class="{ 'is-danger': form.errors.has('first_name') }"
                                    class="input is-medium"
                                    type="text"
                                    placeholder="Certificate/File name">
                            </div>
                            <has-error :form="form" field="education_level" class="danger-text"></has-error>
                        </div>
                        <div class="column is-5">
                            <div class="control">
                                <input
                                    v-model="file.link"
                                    id="fileContent"
                                    type="hidden"
                                    role="uploadcare-uploader">
                            </div>
                            <has-error :form="form" field="education_level" class="danger-text"></has-error>
                        </div>
                        <div class="column is-2">
                            <a class="button primary-btn" @click.prevent="addFile">
                                Add
                            </a>
                        </div>
                    </div>

                    <div class="mt-30">
                        <button
                            class="button btn-align no-lh raised primary-btn"
                            :class="form.busy ? 'is-loading is-disabled' : ''">
                            <i class="sl sl-icon-check"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h2 class="text text-bolder mb-15">Other Education</h2>
        <div class="flex-card light-borderedlight-raised">
            <div class="card-body">
                <div class="content">
                    <div class="columns">
                        <div class="column is-2">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>Secondary School Grade</label>
                                    <input
                                        v-model="form.secondary_school_grade"
                                        class="input is-medium mt-5"
                                        min="50"
                                        max="100"
                                        type="number">
                                    <span class="icon is-small is-left input-icon">
                                            %
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="column is-5">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>Secondary School Graduated Date</label>
                                    <input
                                        v-model="form.secondary_school_graduated_date"
                                        class="input is-medium mt-5"
                                        type="date">
                                    <span class="icon is-small is-left input-icon">
                                        <i class="sl sl-icon-clock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="column is-5">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>College Graduated Date</label>
                                    <input
                                        v-model="form.college_graduated_date"
                                        class="input is-medium mt-5"
                                        type="date">
                                    <span class="icon is-small is-left input-icon">
                                        <i class="sl sl-icon-clock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-30">
                        <button
                            class="button btn-align no-lh raised primary-btn"
                            :class="form.busy ? 'is-loading is-disabled' : ''">
                            <i class="sl sl-icon-check"></i> Update
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <h2 class="text text-bolder mb-15">Speaking Languages and Skills</h2>
        <div class="flex-card light-borderedlight-raised">
            <div class="card-body">
                <div class="content">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="field mb-20">
                                <div class="control has-icons-left">
                                    <label>Add Language</label>
                                    <input
                                        v-model="language"
                                        class="input is-medium mt-5"
                                        name="speaking_languages"
                                        type="text">
                                    <span class="icon is-small is-left input-icon">
                                        <i class="sl sl-icon-book-open"></i>
                                    </span>
                                    <a @click.prevent="addLang"
                                       class="button btn-square is-small input-button">
                                        <i class="sl sl-icon-check"></i>
                                    </a>
                                </div>

                                <div class="solid-list">
                                    <div class="solid-list-item" v-for="(language, index) in form.speaking_languages" :key="index">
                                        <div class="list-bullet" @click="removeLang(index)">
                                            <i class="sl sl-icon-close"></i>
                                        </div>
                                        <div class="list-text mr-10" v-text="language"></div>
                                    </div>
                                </div>

                            </div>
                            <has-error :form="form" field="speaking_languages" class="danger-text"></has-error>
                        </div>
                        <div class="column is-8">
                            <div class="field mb-20">
                                <div class="control">
                                    <label>Skills and more about you</label>
                                    <div class="control">
                                        <textarea
                                            :class="{ 'is-danger': form.errors.has('additional_details') }"
                                            v-model="form.additional_details"
                                            name="additional_details"
                                            class="textarea"
                                            rows="15"
                                            placeholder="Tell us more details about you and your skills."></textarea>
                                    </div>
                                </div>
                                <has-error :form="form" field="additional_details" class="danger-text"></has-error>
                            </div>
                        </div>
                    </div>
                    <div class="mt-30">
                        <button
                            class="button btn-align no-lh raised primary-btn"
                            :class="form.busy ? 'is-loading is-disabled' : ''">
                            <i class="sl sl-icon-check"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                addingCertificate: false,
                facebookUrl: this.user.profile.social_links ? this.user.profile.social_links.facebook : null,
                twitterUrl: this.user.profile.social_links ? this.user.profile.social_links.twitter : null,
                instagramUrl: this.user.profile.social_links ? this.user.profile.social_links.instagram : null,
                language: null,

                file: {
                    name: null,
                    link: null
                },

                form: new Form({
                    // Related to education
                    certifications: this.user.profile.certifications ? this.user.profile.certifications : [],
                    secondary_school_grade: this.user.profile.secondary_school_grade,
                    secondary_school_graduated_date: this.user.profile.secondary_school_graduated_date,
                    college_graduated_date: this.user.profile.college_graduated_date,
                    // Related to Personality
                    avatar: null,
                    social_links: [],
                    social_status: this.user.profile.social_status,
                    health_status: this.user.profile.health_status,
                    // Related to skills and others
                    speaking_languages : this.user.profile.speaking_languages,
                    additional_details :this.user.profile.additional_details,
                })
            }
        },

        computed: {
            socialLinks() {
                return {
                    facebook: this.facebookUrl,
                    twitter: this.twitterUrl,
                    instagram: this.instagramUrl
                }
            },

            hasFile() {
                return !! (this.file.name && this.file.link);
            }
        },

        methods: {

            submit() {
                this.form.social_links = this.socialLinks;
                this.form.avatar = $("#avatar").val() ? $("#avatar").val() : this.user.profile.avatar;

                this.form.post(`${location.pathname}/optional-settings`)
                    .then(({data}) => this.success(data))
                    .catch(error => this.error())
            },

            addLang() {
                if(this.language) {
                    this.form.speaking_languages.push(this.language);
                    this.language = null;
                    this.toast('success', 'New Language Added');
                }
            },

            removeLang(index) {
                this.form.speaking_languages.splice(index, 1);
            },

            addFile() {
                this.file.link = $("#fileContent").val();
                if(this.hasFile) {
                    this.form.certifications.push(Object.assign({}, this.file));
                    this.resetFile();
                } else {
                    this.toast('warning', 'Please provide file name and upload it')
                }
            },

            resetFile(){
                $(".uploadcare--widget__button_type_remove").trigger('click');
                this.file.name = null;
                this.file.link = null;
            },

            removeFile(index){
                this.form.certifications.splice(index , 1);
            },

            success(data) {
                this.$eventBus.$emit('updated', data);
                this.resetFile();
                this.toast('success', 'Profile Updated Successfully');
            },

            error() {
                this.toast('error', 'Please Review Your Data Once Again.!');
            }
        }
    }
</script>

<style>
    .input-button {
        position: absolute;
        right: 0;
        top: 25px;
    }
</style>
