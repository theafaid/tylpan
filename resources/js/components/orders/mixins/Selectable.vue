<script>
    export default {
        data() {
            return {
                items: [],
                finished: false,
                skipped: false,
                oldSelected: [],
            }
        },

        computed: {
            selectedItems() {
                return this.items.filter(item => item.selected == true).sort((a, b) => {
                    return a.selected_at - b.selected_at;
                });
            }
        },

        watch: {
            'finished'(value) {
                value == true ? this.finish() : this.back();
            }
        },

        methods: {

            fetch(url) {
                this.oldSelected = this.selected && this.selected.length ? this.selected : [];
                axios.get(url).then(({data}) => this.handleData(data));
            },

            handleData(data) {
                for(var key in data) {
                    data[key]['selected'] = this.oldSelected.length ? this.checkSelectedBefore(data[key]['slug']) : false;
                    data[key]['selected_at'] = new Date()
                }

                this.items = data;
            },

            checkSelectedBefore(slug) {
              for(var key in this.oldSelected) {
                  if(this.oldSelected[key]['slug'] == slug) return true;
              }

              return false;
            },

            select(item) {
                item.selected = ! item.selected;
                item.selected_at = new Date();
            },

            markAsSkipped() {
                this.finished = true;
                this.skipped = true;
            },

            cancel() {
                this.finished = false;
                this.skipped = false;
            },

            finish() {
                this.$emit('selected', this.selectedItems);
            },

            back() {
                this.$emit('unselected');
            },
        }
    }
</script>

