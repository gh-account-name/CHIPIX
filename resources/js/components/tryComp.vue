<template>
    <div class="tableWrapper">
        <table class="table table-hover">
            <thead class="bg-main-dark text-main-white">
                <tr>
                    <th class="col-1" scope="col">#</th>

                    <th v-for="column in columns" :key="column[0]">{{ column[0] }}</th>

                    <th class="col-3">Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in data" :key="item.id">
                    <th class="col-1" scope="row">{{ index + 1 }}</th>

                    <template v-for="column in columns" :key="column[0]">
                        <td v-if="column[1].includes('.')">
                            <p class="mb-1" v-for="val in extractValues(item, column[1])">{{ val }}</p>
                        </td>
                        <td v-else>{{ item[column[1]] }}</td>
                    </template>


                    <td class="col-3">
                        <button class="btn btn-warning rounded-0 fs-14 me-lg-3 me-xl-5 mb-lg-0 mb-2" @click="editItem(item)">Редактировать</button>
                        <button class="btn btn-danger rounded-0 fs-14" @click="deleteItem(item)">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center fw-bold w-100 fs-3" v-if="data.length == 0">Нет данных</div>
    </div>
</template>

<script>
import Modal from './Modal.vue';

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
        extractValues(obj, key) {
            const keys = key.split('.');
            let value = obj;

            for (const nestedKey of keys) {
                if (Array.isArray(value)) {
                    const nestedValues = value.map((item) => item[nestedKey]);
                    value = [].concat(...nestedValues);
                } else {
                    value = value[nestedKey];
                }
            }

            return value || [];
        }
    },
    components: { Modal }
};
</script>
