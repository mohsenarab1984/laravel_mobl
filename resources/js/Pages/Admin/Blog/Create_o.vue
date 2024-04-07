<template>
    <div>
        <ckeditor
            :editor="editor"
            v-model="editorData"
            @ready="onEditorReady"
        />
    </div>
</template>

<script setup>
import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

let editor = ClassicEditor;
let editorData = ref("");

function onEditorReady(editor) {
    editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
        return new UploadAdapter(loader);
    };
}

class UploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        alert("upload function");
        // Implement your image/video upload logic here
    }

    abort() {
        alert("abort function");
        // Implement abort logic if needed
    }
}
</script>
