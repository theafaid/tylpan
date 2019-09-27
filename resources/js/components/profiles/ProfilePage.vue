<template>
    <div>
        <!-- Hero image -->
        <div id="main-hero" class="hero-body">
            <div class="container has-text-centered">
                <div class="columns has-text-centered-mobile">
                    <div class="column">
                        <p class="components-cta">
                            <span class="button is-large ribbon is-bold rounded" :class="localUser.profile.hasCompleted ? 'is-success' : 'is-danger'">
                                {{localUser.profile.hasCompleted ? 'Your Profile Is Ready. You Can Create Traveling Order now.' : 'Your Profile Is Not Ready!'}}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="columns is-vcentered">
                    <div class="column is-4 is-offset-1 has-text-left">
                        <h1 class="title components-title is-2 text-bold">
                            <img class="rounded-avatar" :src="localUser.profile.formattedAvatar"><hr>
                            {{localUser.fullName}}
                        </h1>
                        <h2 class="subtitle is-4 components-subtitle">
                            Member since {{localUser.created_at}}
                        </h2>
                    </div>
                    <div class="column is-offset-1 has-text-centered is-hidden-mobile">
                        <img :src="localUser.country.flag" class="image country-flag">
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hero image -->

        <section class="section is-medium section-feature-grey">
            <div class="container">
                <!-- Title -->
                <div class="section-title-wrapper mt-80">
                    <h2 class="title dark-text text-bold main-title is-2 has-text-centered">
                        Hey {{localUser.defaultName}},
                    </h2>
                    <h3 class="subtitle has-text-centered is-4">
                        This is some rules you have to read it before sending your profile data :)
                    </h3>
                </div>
                <!-- /Title -->
                <div class="columns">
                    <div class="column is-6 is-offset-3">
                        <div class="content">
                            <ul>
                                <li>Your can write in english or any other language you want.</li>
                                <li>Your profile is save and only us and you can see it.</li>
                                <li>You cannot submit and order before completing all your profile required information.</li>
                                <li>Make sure you entered a true, valid values.</li>
                                <li>First We will review your profile before viewing your traveling information.</li>
                                <li>Again {{localUser.defaultName}}, Your profile is very important and it will help us to work more and more faster.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section section-feature-grey is-medium">
            <div class="columns is-vcentered">

                <div class="column is-8 is-offset-2">
                    <!-- Tabs block -->
                    <profile-form :user="localUser" :countries="countries"></profile-form>
                    <!-- /Tabs block -->
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import ProfileForm from './ProfileForm';

    export default {
        props: ['user', 'countries'],

        data() {
            return {
                localUser: this.user
            }
        },

        components: {
            ProfileForm,
        },

        mounted() {
            this.$eventBus.$on('updated', user => this.localUser = user);
        },
    }
</script>
