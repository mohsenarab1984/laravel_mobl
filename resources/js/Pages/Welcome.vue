<template>
    <div>Welcome {{ name }}</div>
</template>
<script setup>
const props = defineProps({
    name: String,
});
import { ref } from "vue";
</script>
