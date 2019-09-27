<template>
    <div class="columns">
        <div class="column is-12">

            <info-block :finished="finished">
                <span class="text-bold">We know that you are tired now. But the good news is this is the last step :)</span>
                <br>
                Tell us what is your maximum budget. Just write the number below and we will use it to perform a good selections for you
                according to your budget.
                <br>
                If you think that you are rich then but 99999 below and we will understand :D.
            </info-block>

            <div>
                <h2 class="title mb-20 text-bold">My Maximum Budget is: {{data}} $</h2>
            </div>

            <div class="column" v-if="! finished">
                <div class="control">
                    <input v-model="localData" class="input is-medium" type="number" placeholder="99999">
                </div>
            </div>

            <div class="level-right mt-20" v-if="this.data">
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

        mixins: [Finishable],
        components: {
            InfoBlock: InfoBlock
        },

        data() {
            return {
                data: this.selected ? this.selected : 1500,
                localData: this.selected ? this.selected : 1500,
            }
        },

        watch: {
            localData(value) {
                if(value < 1500) {
                    this.data = 1500;
                } else if(value > 99999) {
                    this.data = 99999;
                }else{
                    this.data = value;
                }
            }
        },

    }
</script>
