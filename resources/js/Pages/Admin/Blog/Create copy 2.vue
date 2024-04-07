<template>
    <div id="app">
        <ckeditor
            :editor="editor"
            v-model="editorData"
            :config="editorConfig"
        ></ckeditor>
    </div>
    <hr />
    <div v-html="editorData"></div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
// import $ from "jquery";
export default {
    name: "app",
    data() {
        return {
            editor: ClassicEditor,
            editorData: "<p>Content of the editor !!!.</p>",
            editorConfig: {
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|', 'link', 'uploadImage', 'blockQuote', 'codeBlock',
                        '|', 'alignment',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                    ],
                    shouldNotGroupWhenFull: true
                },
                language: "en",
                placeholder: "Start typing here..!!.",
                ckfinder: {
                    uploadUrl:
                        "/api/editor/upload?_token=" +
                        this.$page.props.csrf_token,
                    options: {
                        resourceType: "Images",
                        upload: {
                            fileName: "photo", // Set the name of the uploaded file to 'photo'
                        },
                    },
                },
            },
        };
    },
};
</script>
