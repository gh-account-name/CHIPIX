<template>
    <div :class="['inputWrapper', wrapperClasses]">
        <label v-if="labelText" :class="['form-label', labelClasses]" :for="$attrs.id">{{ labelText }}</label>

        <input v-bind="$attrs" :class="[errors ? 'is-invalid' : '', 'form-control', 'input-main']" :value="modelValue || $attrs.value"
            @input="$emit('update:modelValue', $event.target.value)">

        <div v-if="errors" class="invalid-feedback" v-for="error in errors">
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
        modelValue: [String, Number],
    },
    emits: ['update:modelValue'],
}
</script>
