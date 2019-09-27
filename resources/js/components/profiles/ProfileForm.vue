<template>
    <div class="flex-card raised">
        <div class="navigation-tabs outlined-pills rounded-pills animated-tabs">
            <div class="tabs is-centered">
                <ul>
                    <li class="tab-link is-active" data-tab="tab-m1"><a>General Profile Settings</a></li>
                    <li class="tab-link" data-tab="tab-m2"><a>Required Education Settings</a></li>
                    <li class="tab-link" data-tab="tab-m3"><a>Optional Settings</a></li>
                </ul>
            </div>
            <div id="tab-m1" class="navtab-content is-active">
                <div class="card-body">
                    <h2 class="title is-4 text-bold mb-20">General Profile Settings</h2>
                    <p>Here is the main details about you.</p>
                    <hr>
                    <general-settings-form :user="user" :countries="countries"></general-settings-form>
                </div>
            </div>
            <div id="tab-m2" class="navtab-content">
                <h2 class="title is-4 text-bold mb-20">Required Education Settings</h2>
                <p>Here you can tell us about your education level, and some additional data.</p>
                <p>For example, Tell us about what is your skills in education ?.</p>
                <hr>
                <required-education-settings :user="user"></required-education-settings>
            </div>
            <div id="tab-m3" class="navtab-content">
                <optional-settings :user="user"></optional-settings>
            </div>
        </div>
    </div>
</template>

<script>
    import GeneralSettingsForm from './GeneralSettingsForm'
    import RequiredEducationSettings from './RequiredEducationSettingsForm'
    import OptionalSettings from './OptionalSettings'

    export default {
        props: ['user', 'countries'],

        components: {
            GeneralSettingsForm,
            RequiredEducationSettings,
            OptionalSettings,
        }
    }
</script>
