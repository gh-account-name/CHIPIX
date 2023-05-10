<template>
    <PageTitle title="Категории" />

    <div class="container">
        <Message :text="message" ref="notification" :type="messageType" />

        <Modal ref="addModal" id="addModal" titleText="Добавить категорию" openButtonText="Добавить" closeButtonText="Отмена" confirmButtonText="Добавить" @confirm="addCategory">
            <form id="addForm" ref="addForm">
                <InputV name="title" id="title" placeholder="Название" :errors="errors.title" />
                <div class="mt-3 fw-bold">Добавить категорию в:</div>
                <span class="text-danger" v-if="errors.directions">{{ errors.directions[0] }}</span>
                <CheckboxV v-for="direction in directions" :labelText="direction.title" :value="direction.id" name="directions[]" :id="`direction${direction.id}`"
                    wrapperClasses="mt-3" />
            </form>
        </Modal>

        <ListingTable ref="listingTable" class="mt-5" :columns="[['Название', 'title'], ['Направления', 'directions.title']]" :data="categories" @edit-item="openEditModal"
            @delete-item="openDeleteModal" />

        <Modal ref="editModal" id="editModal" :titleText='`Редактировать категорию "${selectedItem?.title}"`' closeButtonText="Отмена" confirmButtonText="Редактировать" type="warning"
            @confirm="editItem">
            <form id="editForm" ref="editForm">
                <InputV name="title" id="title" placeholder="Название" :value="selectedItem?.title" :errors="errors.title" />

                <CheckboxV labelText="Изменить направления" id="isEditingCheckbox" name="isEditingDirections" :value="editingDirections" :isCheckedModel="editingDirections"
                    @update:isCheckedModel="newValue => editingDirections = newValue" wrapperClasses="mt-3" />

                <div v-if="editingDirections">
                    <div class="mt-3 fw-bold">Добавить категорию в:</div>
                    <span class="text-danger" v-if="errors.directions">{{ errors.directions[0] }}</span>
                    <CheckboxV v-for="direction in directions" :labelText="direction.title" :value="direction.id" name="directions[]" :id="`editedDirection${direction.id}`"
                        wrapperClasses="mt-3" :checked="isInDirection(direction, selectedItem?.id)" />
                </div>
            </form>
        </Modal>

        <Modal ref="deleteModal" id="deleteModal" :titleText='`Подтвердите удаление категории "${selectedItem?.title}"`' closeButtonText="Отмена" confirmButtonText="Удалить"
            type="danger" @confirm="deleteItem" />
    </div>
</template>

<script>
import PageTitle from '../components/PageTitle.vue';
import Modal from '../components/Modal.vue';
import InputV from '../components/InputV.vue';
import CheckboxV from '../components/CheckboxV.vue';
import TryComp from '../components/TryComp.vue';
import Message from '../components/Message.vue';
import ListingTable from '../components/ListingTable.vue';


export default {
    data() {
        return {
            message: '',
            messageType: null,
            errors: [],
            isLoading: false,
            categories: [],
            directions: [],
            selectedItem: null,
            editingDirections: false,
        }
    },


    methods: {
        async getCategories() {
            const response = await window.axios.get('get/category');
            this.categories = response.data.categories;
        },

        async getDirections() {
            const response = await window.axios.get('get/direction');
            this.directions = response.data.directions;
        },

        async addCategory() {
            const form = this.$refs.addForm;
            const formData = new FormData(form);

            this.isLoading = true;

            try {
                const response = await window.axios.post('add/category', formData);

                this.$refs.addModal.close();

                this.$refs.addForm.reset();

                this.messageType = 'success';
                this.message = response.data;
                this.$refs.notification.open();
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
                    const response = await window.axios.post(`update/category/${this.selectedItem.id}`, formData);

                    this.$refs.editModal.close();

                    this.$refs.editForm.reset();
                    this.selectedItem = null;
                    this.editingDirections = false;

                    this.messageType = 'warning';
                    this.message = response.data;
                    this.$refs.notification.open();

                    this.getCategories();
                    this.getDirections();

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
                    const response = await window.axios.post(`delete/category/${this.selectedItem.id}`);

                    this.$refs.deleteModal.close();

                    this.selectedItem = null;

                    this.messageType = 'danger';
                    this.message = response.data;
                    this.$refs.notification.open();

                    this.getCategories();

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

        isInDirection(direction, categoryId) {
            for (let category of direction.categories) {
                if (category.id == categoryId) {
                    return true
                }
            }
            return false
        },

    },


    mounted() {
        this.getCategories();
        this.getDirections();
    },


    components: { PageTitle, Modal, InputV, CheckboxV, TryComp, Message, ListingTable },

};
</script>
