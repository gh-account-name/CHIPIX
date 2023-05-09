<template>
    <div class="modal fade" id="MessageModal" ref="MessageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div :class="`modal-body alert alert-${type} m-0 text-center`">
                    {{ text }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            modal: null,
        }
    },
    props: {
        text: String,
        type: {
            type: String,
            validator(value) {
                return ['success', 'warning', 'danger'].includes(value)
            }
        },
    },
    methods: {
        open() {
            this.modal.show();
        },
        close() {
            this.modal.hide();
        },

    },
    mounted() {
        this.modal = new bootstrap.Modal(this.$refs['MessageModal']);
    }
}
</script>
