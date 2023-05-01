import { createApp } from 'vue/dist/vue.esm-bundler';
import TryComp from './components/tryComp.vue';

createApp({
    data() {
        return {
            count: 12,
        };
    },
    components: { 'TryComp': TryComp },
    template: `<TryComp />`,
}).mount('#app');
