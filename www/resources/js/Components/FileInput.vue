<script setup lang="ts">
import { onMounted, ref } from 'vue';

const model = defineModel<File | null>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });

const handleInput = (event: Event) => {
    const target = event.target as HTMLInputElement;
    model.value = target.files ? target.files[0] : null;
};
</script>

<template>
    <input
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        type="file"
        @input="handleInput"
        ref="input"
    />
</template>
