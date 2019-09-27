<template>
    <!-- Modal Markup -->
    <div id="univ-details-modal" class="modal modal-lg">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="modal-content">
                <div class="card" v-if="university">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img
                                :src="university.formattedImage"
                                :title="university.name">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <img :src="university.country.flag" class="img-circle" alt="">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="is-size-4 color-accent">{{university.name}}</p>
                                <p class="is-size-7">{{university.country.name}}</p>
                            </div>
                        </div>

                        <div class="content">
                            <div class="text-bold">
                                {{university.description}}
                            </div>
                            <hr>
                            <div class="text-details">
                                Website: <a :href="university.site_url" v-text="university.name"></a>
                            </div>
                        </div>
                        <div class="has-text-right">
                            <a class="button btn-align accent-btn btn-outlined rounded" target="_blank" :href="'/universities/' + university.slug">
                                More details about {{university.name}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="modal-close is-large is-hidden" aria-label="close"></button>
    </div>
    <!-- /Modal Markup -->
</template>

<script>
    export default {
        props: ['university'],

    }
</script>
