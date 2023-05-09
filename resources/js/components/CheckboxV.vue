<template>
    <div :class="['inputWrapper', wrapperClasses]">
        <input type="checkbox" v-bind="$attrs" class="form-check-input me-1 input-main rounded-0" :checked="isCheckedModel || $attrs.checked"
            @change="$emit('update:isCheckedModel', $event.target.checked)">

        <label v-if="labelText" :class="[errors ? 'is-invalid' : '', 'form-label m-0', labelClasses]" :for="$attrs.id">{{ labelText }}</label>

        <div v-if="errors" class="invalid-feedback m-0" v-for=" error   in   errors ">
            {{ error }}
        </div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        errors: Object,
        wrapperClasses: String,
        labelText: String,
        labelClasses: String,
        isCheckedModel: Boolean,
    },
    emits: ['update:isCheckedModel']
}
</script>
