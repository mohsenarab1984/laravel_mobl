<template>
    <div>
        <!-- <textarea v-model="editorData" ></textarea> -->
        <textarea v-model="editorData" class="form-control" id="editor" rows="10" cols="5" style="height: 500px !important;"></textarea>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const editorData = ref("");

onMounted(() => {
    ClassicEditor.create(document.querySelector("textarea"),{
                alignment: {
                    options: ['left', 'center', 'right', 'justify']
                }
            })
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

.ck-editor__editable {
            height: 300px !important;
            
        }
#app>div.ck-editor{
    width: 1000px;
    margin: 10px auto;

}

</style>
