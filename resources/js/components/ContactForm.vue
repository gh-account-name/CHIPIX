<template>
    <Message :text="message" ref="notification" :type="messageType" />
    <form class="ps-lg-5" ref="form">
        <InputV name="name" id="name" placeholder="Как к вам обращаться" wrapperClasses="mb-4" :errors="errors.name" />

        <InputV name="phone" id="phone" placeholder="Номер телефона" wrapperClasses="mb-4" :errors="errors.phone" />

        <InputV name="email" id="email" placeholder="Email" wrapperClasses="mb-4" :errors="errors.email" />

        <TextareaV name="text" id="text" placeholder="Сообщение" wrapperClasses="mb-4" :errors="errors.text" />

        <div class="d-flex justify-content-center">
            <ButtonV @click="sendEmail" text="Отправить сообщение" class="btn btn-main-dark" />
        </div>
    </form>
</template>

<script>
import InputV from './InputV.vue';
import TextareaV from './TextareaV.vue';
import Message from './Message.vue';
import ButtonV from './ButtonV.vue';

export default {
    props: {
        csrf_token: String,
    },
    data() {
        return {
            errors: [],
            message: '',
            messageType: null,
            isLoading: false,
            csrfToken: null,
        }
    },
    methods: {
        async sendEmail() {
            const form = this.$refs.form;
            const formData = new FormData(form);
            formData.append('_token', this.csrfToken);

            this.isLoading = true;

            try {
                const response = await window.axios.post('send/mail', formData);

                this.$refs.form.reset();

                this.messageType = 'success';
                this.message = response.data;
                this.$refs.notification.open();

            } catch (error) {
                if (error.response.status == 422) {
                    this.errors = error.response.data;
                    setTimeout(() => {
                        this.errors = [];
                    }, 3000);
                } else if (error.response.status == 429) {
                    this.$refs.form.reset();

                    this.messageType = 'danger';
                    this.message = error.response.data;
                    this.$refs.notification.open();
                } else {
                    this.$refs.form.reset();

                    this.messageType = 'danger';
                    this.message = 'Ошибка, данные не отправлены';
                    this.$refs.notification.open();
                }
                console.error(error);
            }

            this.isLoading = false;
        }
    },
    mounted() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },
    components: { InputV, TextareaV, Message, ButtonV }
}
</script>
