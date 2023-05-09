<template>
    <div class="sectionTitle bg-main-dark py-3 my-5">
        <h2 class="text-main-white text-center fw-normal m-0">{{ title }}</h2>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        }
    }
}
</script>
