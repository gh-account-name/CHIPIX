<template>
    <PageTitle title="Характеристики" />

    <div class="container">
        <Message :text="message" ref="notification" :type="messageType" />

        <Modal ref="addModal" id="addModal" titleText="Добавить характеристику" openButtonText="Добавить" closeButtonText="Отмена" confirmButtonText="Добавить" @confirm="addCategory">
            <form id="addForm" ref="addForm">
                <InputV name="title" id="title" placeholder="Название" :errors="errors.title" />
                <div class="mt-3 fw-bold">Присутствует у следующих категорий товаров:</div>
                <span class="text-danger" v-if="errors.categories">{{ errors.categories[0] }}</span>
                <CheckboxV v-for="category in categories" :labelText="category.title" :value="category.id" name="categories[]" :id="`category${category.id}`" wrapperClasses="mt-3" />
            </form>
        </Modal>

        <SortFilter :data="characteristics" :searchKeys="['title', 'id']" :sortKeys="{ title: 'Название' }" :reverseButton="true" class="mt-3 mt-md-5">
            <template v-slot="{ processedData }">
                <ListingTable ref="listingTable" class="mt-5" :columns="[['Название', 'title'], ['В категориях', 'categories.title']]" :data="processedData"
                    :isLoading="isLoading && isFirstLoading" @edit-item="openEditModal" @delete-item="openDeleteModal" />
            </template>
        </SortFilter>

        <Modal ref="editModal" id="editModal" :titleText='`Редактировать характеристику "${selectedItem?.title}"`' closeButtonText="Отмена" confirmButtonText="Редактировать"
            type="warning" @confirm="editItem">
            <form id="editForm" ref="editForm">
                <InputV name="title" id="title" placeholder="Название" :value="selectedItem?.title" :errors="errors.title" />

                <CheckboxV labelText="Изменить категории" id="isEditingCheckbox" name="isEditingCategories" :value="editingCategories" v-model="editingCategories"
                    wrapperClasses="mt-3" />

                <div v-if="editingCategories">
                    <div class="mt-3 fw-bold">Присутствует у следующих категорий товаров:</div>
                    <span class="text-danger" v-if="errors.categories">{{ errors.categories[0] }}</span>
                    <CheckboxV v-for="category in categories" :labelText="category.title" :value="category.id" name="categories[]" :id="`editedCategory${category.id}`"
                        wrapperClasses="mt-3" :checked="isInCategory(category, selectedItem?.id)" />
                </div>
            </form>
        </Modal>

        <Modal ref="deleteModal" id="deleteModal" :titleText='`Подтвердите удаление характеристики "${selectedItem?.title}"`' closeButtonText="Отмена" confirmButtonText="Удалить"
            type="danger" @confirm="deleteItem" />
    </div>
</template>

<script>
import PageTitle from '../components/PageTitle.vue';
import Modal from '../components/Modal.vue';
import InputV from '../components/InputV.vue';
import CheckboxV from '../components/CheckboxV.vue';
import Message from '../components/Message.vue';
import ListingTable from '../components/ListingTable.vue';
import SortFilter from '../components/SortFilter.vue';


export default {
    data() {
        return {
            message: '',
            messageType: null,
            errors: [],
            isLoading: false,
            isFirstLoading: true,
            characteristics: [],
            categories: [],
            selectedItem: null,
            editingCategories: false,
        }
    },


    methods: {

        async getCharacteristics() {
            const response = await window.axios.get('get/characteristic');
            this.characteristics = response.data.characteristics;
        },

        async getCategories() {
            const response = await window.axios.get('get/category');
            this.categories = response.data.categories;
        },

        async addCategory() {
            const form = this.$refs.addForm;
            const formData = new FormData(form);

            this.isLoading = true;

            try {
                const response = await window.axios.post('add/characteristic', formData);

                this.$refs.addModal.close();

                this.$refs.addForm.reset();

                this.messageType = 'success';
                this.message = response.data;
                this.$refs.notification.open();

                this.getCharacteristics();
                this.getCategories();

            } catch (error) {
                this.errors = error.response.data;
                setTimeout(() => {
                    this.errors = [];
                }, 3000);
                console.error(error);
            }

            this.isLoading = false;

        },

        async editItem() {
            if (this.selectedItem) {
                const form = this.$refs.editForm;
                const formData = new FormData(form);

                this.isLoading = true;

                try {
                    const response = await window.axios.post(`update/characteristic/${this.selectedItem.id}`, formData);

                    this.$refs.editModal.close();

                    this.$refs.editForm.reset();
                    this.selectedItem = null;
                    this.editingCategories = false;

                    this.messageType = 'warning';
                    this.message = response.data;
                    this.$refs.notification.open();

                    this.getCharacteristics();
                    this.getCategories();

                } catch (error) {
                    this.errors = error.response.data;
                    setTimeout(() => {
                        this.errors = [];
                    }, 3000);
                    console.error(error);
                }

                this.isLoading = false;

            } else {
                console.error('[Editing item] No item was selected')
            }
        },

        async deleteItem() {
            if (this.selectedItem) {

                this.isLoading = true;

                try {
                    const response = await window.axios.post(`delete/characteristic/${this.selectedItem.id}`);

                    this.$refs.deleteModal.close();

                    this.selectedItem = null;

                    this.messageType = 'danger';
                    this.message = response.data;
                    this.$refs.notification.open();

                    this.getCharacteristics();

                } catch (error) {
                    console.error(error);
                }

                this.isLoading = false;

            } else {
                console.error('[Deleting item] No item was selected')
            }
        },

        openEditModal(item) {
            this.selectedItem = item;
            this.$refs.editModal.open();
        },

        openDeleteModal(item) {
            this.selectedItem = item;
            this.$refs.deleteModal.open();
        },

        isInCategory(category, characteristicId) {
            for (let characteristic of category.characteristics) {
                if (characteristic.id == characteristicId) {
                    return true
                }
            }
            return false
        },

        async firstLoad() {
            this.isLoading = true;
            try {
                await this.getCharacteristics();
                await this.getCategories();
            } catch (error) {
                console.error(error);
                this.messageType = 'danger';
                this.message = '<b>Не все данные были загружены, проверьте наличие ошибок в консоли</b>';
                this.$refs.notification.open();
            }
            this.isLoading = false;
            this.isFirstLoading = false;
        }

    },


    mounted() {
        this.firstLoad();
    },


    components: { PageTitle, Modal, InputV, CheckboxV, Message, ListingTable, SortFilter },

};
</script>
