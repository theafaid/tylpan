<script>
    export default {
        data() {
            return {
                finished: false,
            }
        },

        watch: {
            finished(value) {
                value ? this.finish() : this.back()
            }
        },

        methods: {
            finish() {
                this.$emit('selected', this.data);
            },

            back() {
                this.$emit('unselected');
            }
        }
    }
</script>
