<template>
    <div class="columns">
        <div class="column is-12">
            <info-block :finished="finished">
                <span class="text-bold"> Second, Choose one or more University.</span>
                <br>
                Arrange it according to your priority.
            </info-block>
            <div>
                <div class="content">
                    <template v-if="! finished">
                        <h2 class="title mb-20 text-bold">Universities</h2>
                        <table v-if="items.length">
                            <tr>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Details</th>
                                <th>Select ?</th>
                            </tr>
                            <tr
                                v-for="item in items"
                                :key="item.id">
                                <td>
                                    <span class="text-bold" v-text="item.name"></span>
                                </td>
                                <td>
                                    <img :src="item.country.flag" width="50" height="50" />
                                </td>
                                <td>
                                    <a class="button button-cta btn-outlined primary-btn rounded is-small" @click="viewDetails(item)">
                                        <i class="text-bold fa fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a
                                        @click.prevent="select(item)"
                                        :class="item.selected ? 'primary-btn' : 'default-btn'"
                                        class="button btn-square rounded"><i class="sl sl-icon-check"></i></a>
                                </td>
                            </tr>
                        </table>
                    </template>
                    <h2 class="title mb-20 text-bold" v-if="selectedItems.length">Selected Universities: </h2>
                    <div v-if="! selectedItems.length" class="solid-list">
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check"></i>
                            </div>
                            <div class="list-text">We will choose a university for you.</div>
                        </div>
                    </div>
                    <div class="solid-list">
                        <div
                            v-for="item in selectedItems"
                            :key="item.id"
                            class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check"></i>
                            </div>
                            <div class="list-text" v-text="item.name"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="level-right mt-20" v-if="this.selectedItems.length && ! finished">
                <p class="level-item">
                    <a class="button button-cta btn-outlined primary-btn rounded" @click="finished=true">
                       Finish
                    </a>
                </p>
            </div>

            <div class="level-right mt-20" v-if="! this.selectedItems.length && ! skipped">
                <p class="level-item">
                    <a class="button button-cta btn-outlined danger-btn rounded" @click="markAsSkipped">
                        Skip & Let us choose a item for you.
                    </a>
                </p>
            </div>

            <div class="level-right mt-20" v-if="finished || skipped">
                <p class="level-item">
                    <a class="button button-cta btn-outlined danger-btn rounded" @click="cancel">
                        Cancel
                    </a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import Selectable from './mixins/Selectable';
    import InfoBlock from "./InfoBlock";

    export default {
        components: {InfoBlock},
        props: ['countries', 'selected'],

        mixins: [Selectable],

        mounted() {
            this.fetch(`/universities?countries=${this.countries}`)
        },

        methods: {
            viewDetails(item) {
                this.$emit('showUniversityDetails', item);
            }
        }
    }
</script>
