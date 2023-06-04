<template>
    <div :class="['d-flex justify-content-between flex-wrap', $attrs.class]">
        <div v-if="searchKeys" class="col-12 mt-3 mt-md-0 col-md-3">
            <InputV placeholder="Поиск..." v-model="searchValue"></InputV>
        </div>
        <div v-if="sortKeys" class="col-12 mt-3 mt-md-0 col-md-3">
            <select class="form-select input-main" v-model="sortKey">
                <option value="">Не сортировать</option>
                <option v-if="data.length != 0" v-for="key in Object.keys(sortKeys)" :key="key" :value="key">{{ sortKeys[key] }}</option>
            </select>
        </div>
        <div v-if="filterKeys" class="col-12 mt-3 mt-md-0 col-md-3">
            <select class="form-select input-main" v-model="filterKey">
                <option value="">Не фильтровать</option>
                <option v-if="data.length != 0" v-for="item in filterKeys.options" :key="`filter${item.id}`" :value="item.id">{{ item.title }}</option>
            </select>
        </div>
        <div v-if="reverseButton" class="col-12 mt-3 mt-md-0 col-md-2">
            <CheckboxV labelText="В обратном порядке" id="isReversedCheckbox" v-model="isReversed" />
        </div>
    </div>
    <slot :processedData="returnData">
    </slot>
</template>

<script>
import CheckboxV from './CheckboxV.vue';
import InputV from './InputV.vue';

export default {
    props: {
        data: {
            type: Object,
            required: true,
        },
        sortKeys: Object,
        filterKeys: Object,
        searchKeys: Object,
        reverseButton: {
            type: Boolean,
            default: false,
        }
    },


    data() {
        return {
            searchValue: "",
            sortKey: "",
            filterKey: "",
            isReversed: false,
        };
    },


    computed: {
        searchInData() {
            if (this.searchValue) {
                return [...this.data].filter((item) => this.searchKeys.map(key => item[key]).some(value => String(value).toLowerCase().includes(this.searchValue.toLowerCase())));
            }
            return [...this.data]
        },

        sortData() {
            if (this.sortKey) {
                const sortedData = [...this.searchInData].sort((a, b) => {
                    const valueA = a[this.sortKey];
                    const valueB = b[this.sortKey];
                    if (valueA < valueB) {
                        return -1;
                    }
                    if (valueA > valueB) {
                        return 1;
                    }
                    return 0;
                });
                return sortedData
            }
            return [...this.searchInData]
        },

        filterData() {
            if (this.filterKey) {
                const filteredData = [...this.sortData].filter(item => {
                    const evalString = 'item.' + this.filterKeys.path;
                    const evalValue = eval(evalString);
                    if (Array.isArray(evalValue)) {
                        for (let EVitem of evalValue) {
                            if (EVitem.id == this.filterKey) {
                                return true
                            }
                        }
                    } else {
                        return evalValue.id == this.filterKey
                    }
                });
                return filteredData
            }
            return [...this.sortData]
        },

        returnData() {
            if (this.isReversed) {
                return [...this.filterData].reverse();
            }
            return [...this.filterData]
        }
    },


    components: { InputV, CheckboxV }
};
</script>
