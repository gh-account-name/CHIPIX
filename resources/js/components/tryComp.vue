<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modalId: {
            type: String,
            required: true,
        },
        title: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            modal: null,
        }
    },
    methods: {
        openModal() {
            // const modal = document.getElementById(this.modalId);
            // if (modal) {
            //     const modalInstance = new bootstrap.Modal(modal);
            //     modalInstance.show();
            // }
            this.modal.show();
        },
        closeModal() {
            // const modal = document.getElementById(this.modalId);
            // if (modal) {
            //     const modalInstance = bootstrap.Modal.getInstance(modal);
            //     modalInstance.hide();
            // }
            this.modal.hide();
        },
    },
    mounted() {
        this.modal = new bootstrap.Modal(document.getElementById(this.modalId));
    }
};
</script>
