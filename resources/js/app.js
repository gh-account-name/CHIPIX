import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import TryComp from './components/TryComp.vue';

if (window.location.pathname == '/') {
    createApp(TryComp).mount('#ContactFormSection');
}
