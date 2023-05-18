import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import ContactForm from './components/ContactForm.vue';

if (window.location.pathname == '/') {
    createApp(ContactForm).mount('#ContactFormSection');
}
