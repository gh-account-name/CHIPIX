<template>
    <button :disabled="isLoading" class="ButtonV">
        <span :class="{ 'opacity-0': isLoading }">{{ text }}</span>
        <div v-if="isLoading" class="ButtonV__loading-overlay">
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            Загрузка...
        </div>
    </button>
</template>

<script>
export default {
    props: {
        text: String,
    },
    // Управление состоянием "загружается/не загружается" осуществляется через корневой компонент т.е. на самом верху
    computed: {
        isLoading() {
            return this.$root.isLoading;
        }
    }
}
</script>

<style>
.ButtonV__loading-overlay {
    font-size: 80%;
    transform: translateY(-50%);
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.ButtonV {
    position: relative;
}
</style>
