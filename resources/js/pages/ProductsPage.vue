<template>
    <PageTitle title="Продукты" />

    <div class="container pb-5">
        <Message :text="message" ref="notification" :type="messageType" />

        <Modal ref="addModal" id="addModal" titleText="Добавить товар" openButtonText="Добавить" closeButtonText="Отмена" confirmButtonText="Добавить" @confirm="addProduct">
            <form id="addForm" ref="addForm" enctype="multipart/form-data">
                <InputV name="title" id="title" placeholder="Название" :errors="errors.title" />
                <TextareaV name="description" id="description" placeholder="Описание" wrapperClasses="mt-3" :errors="errors.description" />
                <TextareaV name="additional_info" id="additional_info" placeholder="Дополнительная информация (необязательно)" wrapperClasses="mt-3" :errors="errors.additional_info" />
                <InputV type="file" name="previewImage" id="previewImage" labelText="Превью товара" title="Это изображение будет отображаться на карточке товара" wrapperClasses="mt-3"
                    :errors="errors.previewImage" />
                <InputV type="file" multiple name="images[]" id="images" labelText="Другие изображения товара" wrapperClasses="mt-3" :errors="ImagesErrors" />

                <div class="mt-3 fw-bold">Выберите категорию:</div>
                <span class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
                <CheckboxV v-for="category in categories" type="radio" class="rounded-circle" name="category_id" :value="category.id" :id="category.id" :labelText="category.title"
                    @click="selectCategory(category)" />

                <div v-if="selectedCategory">
                    <div class="mt-3 fw-bold" title="Доступные направления зависят от выбранной категории">Добавить товар в направления:</div>
                    <span class="text-danger" v-if="errors.directions">{{ errors.directions[0] }}</span>
                    <CheckboxV v-for="direction in selectedCategory.directions" :labelText="direction.title" :value="direction.id" name="directions[]" :id="`direction${direction.id}`"
                        wrapperClasses="mt-3" />
                    <div class="mt-3 fw-bold">Заполните характеристики:</div>
                    <InputV v-for="(characteristic, index) in characteristicsValues" :labelText="characteristic.title" :id="characteristic.id" name="charsValues[]"
                        wrapperClasses="mt-3" v-model="characteristic.value" :errors="errors[`characteristicsValues.${index}`]" />
                </div>
            </form>
        </Modal>

        <SortFilter :data="products" :searchKeys="['title', 'id']" :sortKeys="{ title: 'Название' }" :reverseButton="true" class="mt-3 mt-md-5">
            <template v-slot="{ processedData }">
                <ListingTable ref="listingTable" class="mt-5"
                    :columns="[['Изображение', 'previewImage', 'slot'], ['Название', 'title', 'slot'], ['Категория', 'category', 'slot'], ['Направления', 'directions', 'slot']]"
                    :data="processedData" :isLoading="isLoading && isFirstLoading" @edit-item="openEditModal" @delete-item="openDeleteModal">
                    <template #previewImage="{ item }">
                        <td class="col-2 text-center"><img :src="`/storage/${item.previewImage}`" class="img-fluid ListingTable__img" alt="ProductPicture"></td>
                    </template>
                    <template #title="{ item }">
                        <td><a target="_blank" :href="`/product/${item.id}`">{{ item.title }}</a></td>
                    </template>
                    <template #category="{ item }">
                        <td>{{ item.category.title }}</td>
                    </template>
                    <template #directions="{ item }">
                        <td>
                            <p class="mb-1" v-for="direction in item.directions">{{ direction.title }}</p>
                        </td>
                    </template>
                </ListingTable>
            </template>
        </SortFilter>

        <Modal ref="editModal" id="editModal" :titleText='`Редактировать товар "${selectedItem?.title}"`' closeButtonText="Отмена" confirmButtonText="Редактировать" type="warning"
            @confirm="editItem">
            <form id="editForm" ref="editForm">
                <InputV name="title" id="title" placeholder="Название" :value="selectedItem?.title" :errors="errors.title" />
                <TextareaV name="description" id="description" placeholder="Описание" wrapperClasses="mt-3" :value="selectedItem?.description" :errors="errors.description" />
                <TextareaV name="additional_info" id="additional_info" placeholder="Дополнительная информация (необязательно)" wrapperClasses="mt-3"
                    :value="selectedItem?.additional_info" :errors="errors.additional_info" />

                <CheckboxV labelText="Изменить изображения" id="isEditingPicturesCheckbox" name="isEditingPictures" :value="editingPictures" v-model="editingPictures"
                    wrapperClasses="mt-3" />

                <div v-if="editingPictures">
                    <InputV type="file" name="previewImage" id="EditFormPreviewImage" labelText="Заменить превью товара" title="Это изображение заменит текущее превью товара"
                        wrapperClasses="mt-3" :errors="errors.previewImage" />
                    <InputV type="file" multiple name="images[]" id="EditFormImages" labelText="Добавить другие изображения товара" wrapperClasses="mt-3" :errors="ImagesErrors" />

                    <div class="row row-cols-3 mx-0 mt-3" v-if="selectedItem?.images">
                        <div class="col px-4 position-relative" v-for="    image     in     selectedItem.images    ">
                            <button @click="deleteImage(image.id)" type="button" class="btn-close rounded-0 position-absolute end-0 top-0" title="Удалить изображение"></button>
                            <img :src="`/storage/${image.src}`" alt="product picture" class="img-fluid">
                        </div>
                    </div>
                    <div class="text-danger text-center" v-if="errors.deletedImage">{{ errors.deletedImage }}</div>
                </div>

                <CheckboxV labelText="Изменить категорию и направления" id="isEditingCategoriesCheckbox" name="isEditingCategories" :value="editingCategories"
                    v-model="editingCategories" wrapperClasses="mt-3" />

                <div v-if="editingCategories">
                    <div class="mt-3 fw-bold">Выберите категорию:</div>
                    <span class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
                    <CheckboxV v-for="    category     in     categories    " type="radio" class="rounded-circle" name="category_id" :value="category.id"
                        :id="`EditFormCategory${category.id}`" :labelText="category.title" @click="selectCategory(category)"
                        :checked="editingCategories && category.id == selectedCategory.id" />

                    <div v-if="selectedCategory">
                        <div class="mt-3 fw-bold" title="Доступные направления зависят от выбранной категории">Добавить товар в направления:</div>
                        <span class="text-danger" v-if="errors.directions">{{ errors.directions[0] }}</span>
                        <CheckboxV v-for="    direction     in     selectedCategory.directions    " :labelText="direction.title" :value="direction.id" name="directions[]"
                            :id="`EditFormDirection${direction.id}`" wrapperClasses="mt-3" :checked="isInDirection(direction.id)" />
                    </div>
                </div>

                <div v-if="selectedCategory">
                    <div class="mt-3 fw-bold">Изменить характеристики:</div>
                    <InputV v-for="(    characteristic, index    ) in     characteristicsValues    " :labelText="characteristic.title"
                        :id="`EditFormCharacteristic${characteristic.id}`" name="charsValues[]" wrapperClasses="mt-3" v-model="characteristic.value"
                        :errors="errors[`characteristicsValues.${index}`]" />
                </div>
            </form>
        </Modal>

        <Modal ref="deleteModal" id="deleteModal" :titleText='`Подтвердите удаление товара "${selectedItem?.title}"`' closeButtonText="Отмена" confirmButtonText="Удалить" type="danger"
            @confirm="deleteItem" />
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
import TextareaV from '../components/TextareaV.vue';



export default {
    data() {
        return {
            message: '',
            messageType: null,
            errors: [],
            isLoading: false,
            isFirstLoading: true,
            categories: [],
            products: [],
            selectedItem: null,
            editingCategories: false,
            editingPictures: false,
            selectedCategory: null,
            characteristicsValues: [],
        }
    },


    methods: {

        async getProducts() {
            const response = await window.axios.get('get/product');
            this.products = response.data.products;
        },

        async getCategories() {
            const response = await window.axios.get('get/category');
            this.categories = response.data.categories;
        },

        async addProduct() {
            const form = this.$refs.addForm;
            const formData = new FormData(form);
            formData.append('characteristicsValues', JSON.stringify(this.characteristicsValues));

            this.isLoading = true;

            try {
                const response = await window.axios.post('add/product', formData);

                this.$refs.addModal.close();

                this.$refs.addForm.reset();

                this.messageType = 'success';
                this.message = response.data;
                this.$refs.notification.open();

                this.getProducts();
                this.getCategories();

            } catch (error) {
                if (error.response.status == 422) {
                    this.errors = error.response.data;
                    setTimeout(() => {
                        this.errors = [];
                    }, 3000);
                }
                console.error(error);
            }

            this.isLoading = false;

        },

        async editItem() {
            if (this.selectedItem) {
                const form = this.$refs.editForm;
                const formData = new FormData(form);
                formData.append('characteristicsValues', JSON.stringify(this.characteristicsValues));

                this.isLoading = true;

                try {
                    const response = await window.axios.post(`update/product/${this.selectedItem.id}`, formData);

                    this.$refs.editModal.close();

                    this.$refs.editForm.reset();
                    this.selectedItem = null;
                    this.selectedCategory = null;
                    this.editingCategories = false;
                    this.editingPictures = false;

                    this.messageType = 'warning';
                    this.message = response.data;
                    this.$refs.notification.open();

                    this.getProducts();
                    this.getCategories();

                } catch (error) {
                    if (error.response.status == 422) {
                        this.errors = error.response.data;
                        setTimeout(() => {
                            this.errors = [];
                        }, 3000);
                    }
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
                    const response = await window.axios.post(`delete/product/${this.selectedItem.id}`);

                    this.$refs.deleteModal.close();

                    this.selectedItem = null;

                    this.messageType = 'danger';
                    this.message = response.data;
                    this.$refs.notification.open();

                    this.getProducts();

                } catch (error) {
                    console.error(error);
                }

                this.isLoading = false;

            } else {
                console.error('[Deleting item] No item was selected')
            }
        },

        async deleteImage(id) {
            if (id && this.selectedItem) {

                this.isLoading = true;

                try {
                    const response = await window.axios.post(`delete/product/image/${id}`);

                    this.selectedItem.images = this.selectedItem.images.filter(image => image.id != id);

                    this.errors.deletedImage = response.data

                    setTimeout(() => {
                        this.errors.deletedImage = null;
                    }, 3000);

                    this.getProducts();

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
            this.selectCategory(this.categories.find(category => category.id == item.category_id))
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

        isInDirection(directionId) {
            if (this.selectedItem) {
                for (let direction of this.selectedItem.directions) {
                    if (direction.id == directionId) {
                        return true
                    }
                }
            }

            return false
        },

        selectCategory(category) {
            this.selectedCategory = category;
            if (this.selectedItem?.category_id == category.id) {
                this.characteristicsValues = this.selectedItem.characteristics.map(char => ({ id: char.id, title: char.title, value: char.pivot.value }));
            } else {
                this.characteristicsValues = category.characteristics.map(char => ({ id: char.id, title: char.title, value: '' }));
            }

        },

        async firstLoad() {
            this.isLoading = true;
            try {
                await this.getProducts();
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

    computed: {
        ImagesErrors() {
            const imagesErrors = Object.entries(this.errors).filter(([key]) => key.startsWith('images.')).map(([, value]) => value[0]);
            if (imagesErrors.length != 0) {
                return imagesErrors
            }
            return undefined
        }
    },

    mounted() {
        this.firstLoad();
    },


    components: { PageTitle, Modal, InputV, CheckboxV, Message, ListingTable, SortFilter, TextareaV },

};
</script>

<style>
.ListingTable__img {
    max-height: 10rem;
}
</style>
