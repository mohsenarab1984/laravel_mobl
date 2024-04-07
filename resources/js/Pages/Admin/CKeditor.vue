<template>
    <div>
        <textarea v-model="editorData"></textarea>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const editorData = ref("");

onMounted(() => {
    ClassicEditor.create(document.querySelector("textarea"))
        .then((editor) => {
            editor.model.document.on("change:data", () => {
                editorData.value = editor.getData();
            });
        })
        .catch((error) => {
            console.error(error.stack);
        });
});
</script>

<style>
textarea {
    height: 500px;
    width: 100%;
}
</style>
