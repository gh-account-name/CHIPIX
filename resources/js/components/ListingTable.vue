<template>
    <div class="tableWrapper table-responsive">
        <table class="table table-hover table-responsive ListingTable__table">
            <thead class="bg-main-dark text-main-white">
                <tr>
                    <th class="ListingTable__row-number" scope="col">#</th>

                    <th v-for="column in columns" :key="column[0]">{{ column[0] }}</th>

                    <th class="col-3">Действия</th>
                </tr>
            </thead>
            <tbody>
                <!-- Скелетики 💀💀 -->
                <tr v-if="isLoading" v-for="index in 3">
                    <th class="ListingTable__row-number placeholder-glow" scope="row"><span class="placeholder col-12"></span></th>

                    <template v-for="column in columns" :key="column[0]">
                        <td class="placeholder-glow"><span class="placeholder col-12"></span></td>
                    </template>

                    <td class="col-3 placeholder-glow">
                        <button class="btn placeholder rounded-0 fs-14 me-lg-3 me-xl-5 mb-lg-0 mb-2"><span class="opacity-0">Редактировать</span></button>
                        <button class="btn placeholder rounded-0 fs-14"><span class="opacity-0">Удалить</span></button>
                    </td>
                </tr>

                <tr v-else v-for="(item, index) in data" :key="item.id">
                    <th class="ListingTable__row-number" scope="row">{{ index + 1 }}</th>

                    <template v-for="column in columns" :key="column[0]">
                        <slot v-if="column[2] == 'slot'" :name="column[1]" :item="item"></slot>

                        <td v-else>{{ item[column[1]] }}</td>
                    </template>

                    <td class="col-3">
                        <button class="btn btn-warning rounded-0 fs-14 me-lg-3 me-xl-5 mb-lg-0 mb-2" @click="editItem(item)">Редактировать</button>
                        <button class="btn btn-danger rounded-0 fs-14" @click="deleteItem(item)">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center fw-bold w-100 fs-3" v-if="data.length == 0 && !isLoading">Нет данных</div>
    </div>
</template>

<script>
export default {
    props: {
        columns: {
            type: Array,
            required: true,
        },
        data: {
            type: Array,
            required: true,
        },
        isLoading: {
            type: Boolean,
            default: false,
        }
    },

    methods: {
        editItem(item) {
            // вызов функции редактирования элемента
            this.$emit("edit-item", item);
        },

        deleteItem(item) {
            // вызов функции удаления элемента
            this.$emit("delete-item", item);
        },
    },

};
</script>

<style>
.ListingTable__table .placeholder {
    vertical-align: top;
}

.ListingTable__table button.placeholder {
    background-color: currentColor !important;
    pointer-events: none;
}

.ListingTable__row-number {
    width: 1%;
}
</style>
