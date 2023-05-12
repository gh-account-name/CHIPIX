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
        <div v-if="reverseButton" class="col-12 mt-3 mt-md-0 col-md-3">
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

        returnData() {
            if (this.isReversed) {
                return [...this.sortData].reverse();
            }
            return [...this.sortData]
        }
    },


    components: { InputV, CheckboxV }
};
</script>
