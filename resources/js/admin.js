import { createApp } from 'vue/dist/vue.esm-bundler';
import CategoriesPage from './pages/CategoriesPage.vue';
import CharacteristicsPage from './pages/CharacteristicsPage.vue';
import ProductsPage from './pages/ProductsPage.vue';

const currentPage = getCurrentPage();

const app = createApp(getPageComponent(currentPage));

app.mount('#pageRoot');

// Функция, которая определяет текущую страницу
function getCurrentPage() {
    const path = window.location.pathname;
    const parts = path.split('/');

    const page = parts[parts.length - 1];

    return page;
}

// Функция, которая возвращает компонент страницы в зависимости от текущей страницы
function getPageComponent(page) {
    switch (page) {
        case 'categories':
            return CategoriesPage;
        case 'characteristics':
            return CharacteristicsPage;
        case 'products':
            return ProductsPage;
        default:
            return null;
    }
}
