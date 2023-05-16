<template>
    <!-- Button trigger modal -->
    <button v-if="openButtonText" type="button" class="btn btn-main-dark" data-bs-toggle="modal" :data-bs-target="`#${id}`">
        {{ openButtonText }}
    </button>

    <!-- Modal -->
    <div class="modal fade Modal__modal" :id="id" :ref="id" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h1 :class="[type && type != 'warning' ? `text-${type}` : '', 'modal-title fs-5']">{{ titleText }}</h1>
                    <button type="button" class="btn-close rounded-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" v-if="$slots.default">
                    <slot></slot>
                </div>
                <div :class="['modal-footer', !$slots.default ? 'border-0' : '']" v-if="closeButtonText || confirmButtonText">
                    <button v-if="closeButtonText" type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">{{ closeButtonText }}</button>
                    <!-- <button v-if="confirmButtonText" ref="confirmButton" type="button" class="btn btn-main-dark" @click="confirm">{{ confirmButtonText }}</button> -->
                    <ButtonV :text="confirmButtonText" v-if="confirmButtonText" ref="confirmButton" type="button" :class="[type ? `btn-${type} rounded-0` : 'btn-main-dark', 'btn']"
                        @click="confirm" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ButtonV from './ButtonV.vue';

export default {
    data() {
        return {
            modal: null,
        }
    },
    props: {
        titleText: {
            type: String,
            default: 'Заголовок',
        },
        id: {
            type: String,
            default: 'Modal',
        },
        type: {
            type: String,
            validator(value) {
                return ['success', 'warning', 'danger'].includes(value)
            }
        },
        openButtonText: String,
        closeButtonText: String,
        confirmButtonText: String,
    },
    emits: ['confirm'],
    methods: {
        open() {
            this.modal.show();
        },
        close() {
            this.modal.hide();
        },
        // вызов функции при нажатии на кнопку подтверждения
        confirm() {
            this.$emit('confirm');
        }

    },
    components: { ButtonV },
    mounted() {
        this.modal = new bootstrap.Modal(this.$refs[this.id]);
    }
}
</script>

<style>
.Modal__modal .btn-close:focus {
    box-shadow: 0 0 0 2px rgba(66, 70, 73, 1);
}
</style>
