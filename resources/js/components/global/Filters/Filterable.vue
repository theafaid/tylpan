<template>
<div class="filterable">
    <div class="columns">
       <div class="column is-4">
           <div class="control">
               <span>Match</span>
               <select v-model="query.filter_match" style="width: 25%">
                   <option value="and">All</option>
                   <option value="or">Any</option>
               </select>
               <span>of the following filters: </span>
           </div>
       </div>
       <div class="column is-3"></div>
       <div class="column is-5">
           <a
               class="button is-info"
               @click.prevent="addFilter">
               Add Filter
           </a>
           <a
               class="button is-primary"
               @click.prevent="applyFilter">
               <span>Apply Filters</span>
           </a>
           <a
               class="button is-primary"
               @click.prevent="exportToCsv('data.csv', collection.data)">
               <span>Export CSV</span>
           </a>
           <a v-if="newButton" :href="createPoint" class="button is-primary">
               <span>Add new</span>
           </a>
       </div>
   </div>
    <div class="columns" v-for="(f, i) in filterCandidates">
        <div class="column is-2">
            <select class="select" @change="selectColumn(f, i, $event)">
                <option value="">Select a filter</option>
                <optgroup v-for="group in filterGroups" :label="group.name">
                    <option
                        v-for="x in group.filters"
                        :value="JSON.stringify(x)"
                        :selected="f.column && x.name === f.column.name">
                        {{x.title}}
                    </option>
                </optgroup>
            </select>
        </div>
        <div class="column is-2">
            <div v-if="f.column">
                <select class="select" @change="selectOperator(f, i, $event)">
                    <option value="">Select an operator</option>
                    <option
                        v-for="y in fetchOperators(f)"
                        :value="JSON.stringify(y)"
                        :selected="f.operator && y.name == f.operator.name">
                        {{y.title}}
                    </option>
                </select>
            </div>
        </div>
        <template v-if="f.column && f.operator">
            <div class="column is-6" v-if="f.operator.component === 'single'">
                <select v-if="f.operator.parent.includes('boolean')" class="select" v-model="f.query_1">
                    <option value="1" selected>True</option>
                    <option value="0">False</option>
                </select>
                <input v-else class="input is-medium" v-model="f.query_1">
            </div>
            <template v-if="f.operator.component === 'double'">
                <div class="column is-3">
                    <input class="input is-medium" v-model="f.query_1">
                </div>
                <div class="column is-3">
                    <input class="input is-medium" v-model="f.query_2">
                </div>
            </template>
            <template v-if="f.operator.component === 'datetime_1'">
                <div class="column is-4">
                    <input class="input is-medium" v-model="f.query_1">
                </div>
                <div class="column is-2">
                    <select class="select" v-model="f.query_2">
                        <option value="hours">hours</option>
                        <option value="days">days</option>
                        <option value="months">months</option>
                        <option value="years">years</option>
                    </select>
                </div>
            </template>
            <template v-if="f.operator.component === 'datetime_2'">
                <div class="column is-6">
                    <select class="select" v-model="f.query_1">
                        <option value="yesterday">yesterday</option>
                        <option value="today">today</option>
                        <option value="tomorrow">tomorrow</option>
                        <option value="last_month">last month</option>
                        <option value="this_month">this month</option>
                        <option value="next_month">next month</option>
                        <option value="last_year">last year</option>
                        <option value="this_year">this year</option>
                        <option value="next_year">next year</option>
                    </select>
                </div>
            </template>
        </template>

        <div class="column is-2">
            <a
                v-if="f"
                class="button"
                @click.prevent="removeFilter(f, i)">
                Remove
            </a>
            <a
                v-if="appliedFilters.length > 0"
                class="button"
                @click.prevent="resetFilter">
                Reset
            </a>
        </div>
    </div>
    <div class="columns">
       <div class="column is-12">
           <table class="table is-striped">
                <slot name="thead"></slot>
               <tbody>
                   <slot
                       v-if="collection.data.length"
                       v-for="item in collection.data" :item="item"></slot>
               </tbody>
           </table>
       </div>
   </div>
    <div class="columns">
        <div class="column is-4">
            Order By
            <select
                :disabled="loading"
                @input="updateOrderColumn">
                <option
                    v-for="column in orderables"
                    :value="column.name"
                    :selected="column && column.name == query.order_column">
                    {{column.title}}
                </option>
            </select>
        </div>
        <div class="column is-5">
            Shaw {{collection.from}} - {{collection.to}} of {{collection.total}} entries.
            <select
                v-model="query.limit"
                :disabled="loading"
                @change="updateLimit">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="all">All</option>
            </select>
        </div>
        <div class="column is-2">
            <button
                class="button is-secondary"
                :disabled="!collection.prev_page_url || loading"
                @click="prevPage">&laquo; Prev</button>
            <button
                class="button is-secondary"
                :disabled="!collection.next_page_url || loading"
                @click="nextPage">Next &raquo;</button>
        </div>
        <div class="column is-1">
            <button
                @click.prevent="updateOrderDirection"
                class="button btn-square rounded is-small">
                <i class="sl" :class="query.order_direction === 'asc' ? 'sl-icon-arrow-up' : 'sl-icon-arrow-down'"></i>
            </button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        url: String,
        filterGroups: Array,
        orderables: Array,
        newButton: {
            type: Boolean,
            default: true,
        },
    },

    data() {
        return {
            loading: true,
            appliedFilters: [],
            filterCandidates: [],
            query: {
                order_column: null,
                order_direction: 'desc',
                filter_match: 'and',
                limit: 10,
                page: 1,
            },

            collection: {
                data: [],
            }
        }
    },

    mounted() {
        this.$eventBus.$on('changed', () => {this.resetFilter()});
        this.fetch();
        this.addFilter();
    },

    computed: {
        fetchOperators() {
            return (f) => {
                return this.availableOperators().filter((operator) => {
                    if(f.column && operator.parent.includes(f.column.type)) {
                        return operator;
                    }
                });
            }
        },

        createPoint() {
            return location.pathname + '/create';
        }
    },

    methods: {
        getFilters() {
            const f = {};

            this.appliedFilters.forEach((filter, i) => {
                f[`f[${i}][column]`] = filter.column.name;
                f[`f[${i}][operator]`] = filter.operator.name;
                f[`f[${i}][query_1]`] = filter.query_1;
                f[`f[${i}][query_2]`] = filter.query_2;
            });

            return f;
        },

        fetch() {
            this.loading = true;

            const filters = this.getFilters();

            const params = {
                ...this.query,
                ...filters
            };

            axios.get(this.url, {params: params})
                .then((response) => {
                    this.collection = response.data.collection;
                    this.query.page = response.data.collection.current_page;
                })
                .catch(error => {
                    alert(error.response.data.message);
                })
                .finally(() => this.loading=false);
        },

        updateOrderColumn(e) {
            const value = e.target.value;

            this.query.order_column = value;

            this.applyChange();
        },

        updateOrderDirection() {
            this.query.order_direction = this.query.order_direction == 'asc' ? 'desc' : 'asc';

            this.applyChange();
        },


        applyChange() {
            this.fetch();
        },

        addFilter() {
            this.filterCandidates.push({
                column: '',
                operator: '',
                query_1: null,
                query_2: "",
            })
        },

        resetFilter() {
            this.appliedFilters.splice(0);
            this.filterCandidates.splice(0);
            this.addFilter();
            this.query.page = 1;
            this.applyChange();
        },

        applyFilter() {
            this.appliedFilters = JSON.parse(JSON.stringify(this.filterCandidates));

            this.query.page = 1;

            this.applyChange();
        },

        removeFilter(f, i, e) {
            this.filterCandidates.splice(i, 1);
        },

        selectColumn(f, i, e) {
          let value = e.target.value;

          if(value.length === 0) {
              this.filterCandidates[i].column = value;
              return ;
          }

          let obj = JSON.parse(value);
          this.filterCandidates[i].column = obj;

          switch(obj.type) {
              case 'numeric':
                  this.filterCandidates[i].operator = this.availableOperators[4];
                  this.filterCandidates[i].query_1  = null;
                  this.filterCandidates[i].query_2  = null;
                  break;
              case 'string':
                  this.filterCandidates[i].operator = this.availableOperators[6];
                  this.filterCandidates[i].query_1  = null;
                  this.filterCandidates[i].query_2  = null;
                  break;
              case 'datetime':
                  this.filterCandidates[i].operator = this.availableOperators[9];
                  this.filterCandidates[i].query_1  = 28;
                  this.filterCandidates[i].query_2  = 'days';
                  break;
              case 'counter':
                  this.filterCandidates[i].operator = this.availableOperators[14];
                  this.filterCandidates[i].query_1  = null;
                  this.filterCandidates[i].query_2  = null;
                  break;
          }
        },

        selectOperator(f, i, e) {
            let value = e.target.value;

            if(value.length === 0) {
                this.filterCandidates[i].operator = value;
                return;
            }

            let obj = JSON.parse(value);
            this.filterCandidates[i].operator = obj;
            this.filterCandidates[i].query_1 = null;
            this.filterCandidates[i].query_2 = null;

            switch(obj.name) {
                case 'in_the_past':
                case 'in_the_next':
                    this.filterCandidates[i].query_1 = 28;
                    this.filterCandidates[i].query_2 = 'days';
                    break;
                case 'in_the_period':
                    this.filterCandidates[i].query_1 = 'today';
                    break;
            }

        },

        updateLimit() {
            this.query.page = 1;
            this.applyChange();
        },

        prevPage() {
            if(this.collection.prev_page_url) {
                this.query.page = Number(this.query.page) - 1 ;
                this.applyChange();
            }
        },

        nextPage() {
            if(this.collection.next_page_url) {
                this.query.page = Number(this.query.page) + 1 ;
                this.applyChange();
            }
        },

        availableOperators() {
            return [
                {title: 'equal to', name: 'equal_to', parent: ['numeric', 'string'], component: 'single'},
                {title: 'not equal to', name: 'not_equal_to', parent: ['numeric', 'string'], component: 'single'},

                {title: 'less than', name: 'less_than', parent: ['numeric'], component: 'single'},
                {title: 'greater_than', name: 'greater_than', parent: ['numeric'], component: 'single'},

                {title: 'between', name: 'equal_to', parent: ['numeric'], component: 'double'},
                {title: 'not between', name: 'not_between', parent: ['numeric'], component: 'double'},

                {title: 'contains', name: 'contains', parent: ['string'], component: 'single'},
                {title: 'starts with', name: 'starts_with', parent: ['string'], component: 'single'},
                {title: 'ends with', name: 'ends_with', parent: ['string'], component: 'single'},

                {title: 'in the past', name: 'in_the_past', parent: ['datetime'], component: 'datetime_1'},
                {title: 'in the next', name: 'in_the_next', parent: ['datetime'], component: 'datetime_1'},
                {title: 'in the period', name: 'in_the_period', parent: ['datetime'], component: 'datetime_2'},


                {title: 'equal to count', name: 'equal_to_count', parent: ['counter'], component: 'single'},
                {title: 'not equal to count', name: 'not_equal_to_count', parent: ['counter'], component: 'single'},
                {title: 'less than count', name: 'less_than_count', parent: ['counter'], component: 'single'},
                {title: 'greater than count', name: 'greater_than_count', parent: ['counter'], component: 'single'},

                {title: 'equal to', name: 'equal_to', parent: ['boolean'], component: 'single'},
                {title: 'not equal to', name: 'not_equal_to', parent: ['boolean'], component: 'single'},
            ]
        },

        exportToCsv(filename, rows) {
            var processRow = function (row) {
                var finalVal = '';
                for (var j = 0; j < row.length; j++) {
                    var innerValue = row[j] === null ? '' : row[j].toString();
                    if (row[j] instanceof Date) {
                        innerValue = row[j].toLocaleString();
                    };
                    var result = innerValue.replace(/"/g, '""');
                    if (result.search(/("|,|\n)/g) >= 0)
                        result = '"' + result + '"';
                    if (j > 0)
                        finalVal += ',';
                    finalVal += result;
                }
                return finalVal + '\n';
            };

            var csvFile = '';
            for (var i = 0; i < rows.length; i++) {
                csvFile += processRow(rows[i]);
            }

            var blob = new Blob([csvFile], { type: 'text/csv;charset=utf-8;' });
            if (navigator.msSaveBlob) { // IE 10+
                navigator.msSaveBlob(blob, filename);
            } else {
                var link = document.createElement("a");
                if (link.download !== undefined) { // feature detection
                    // Browsers that support HTML5 download attribute
                    var url = URL.createObjectURL(blob);
                    link.setAttribute("href", url);
                    link.setAttribute("download", filename);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }
        }

    }

}
</script>

<style>
    .filterable {
        background: #F0F0F0;
        padding: 20px;
        border: 2px solid #ddd;
        border-radius: 10px;
    }
</style>
