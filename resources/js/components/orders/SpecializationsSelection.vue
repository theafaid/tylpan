<template>
    <div class="columns">
        <div class="column is-12">

            <info-block :finished="finished">
                <span class="text-bold">Now, It's time to tell us what specialization you want there.</span>
                <br>
                Provide one or more specialization and arrange it according to your priority.
            </info-block>

            <div v-if="data.length">
                <h2 class="title mb-20 text-bold">Specializations: </h2>
                <div class="solid-list">
                    <div
                        v-for="(item, index) in data"
                        :key="index"
                        class="solid-list-item">
                        <div class="list-bullet" @click="remove(index)" v-if="! finished">
                            <i class="sl sl-icon-close"></i>
                        </div>
                        <div class="list-text">
                            {{index+1 + ') ' + item}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="column" v-if="! finished">
                <div class="control">
                    <input v-model="item" class="input is-medium" type="text" placeholder="Like Electrical Engineering, Pharmacy, Management" @keyup.enter="add">
                </div>
            </div>

            <div class="level-right mt-20" v-if="this.data.length">
                <p class="level-item">
                    <a
                        :class="finished ? 'danger-btn' : 'primary-btn'"
                        class="button button-cta btn-outlined primary-btn rounded"
                        @click="finished=! finished">
                        {{finished ? 'Cancel' : 'Finish'}}
                    </a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import Finishable from './mixins/Finishable';
    import InfoBlock from './InfoBlock';

    export default {
        props: ['selected'],

        components: {
            InfoBlock: InfoBlock
        },

        mixins: [Finishable],

        data() {
            return {
                item : null,
                data: this.selected && this.selected.length ? this.selected : [],
                finished: false
            }
        },

        methods: {
            add() {
                this.data.push(this.item);
                this.item = null;
            },

            remove(index) {
                this.data.splice(index, 1);
            }
        }
    }
</script>
