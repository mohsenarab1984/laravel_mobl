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
            editorData: "<p>Content of the editor.</p>",
            editorConfig: {
                toolbar: {
                    items: [
                        "heading",
                        "|",
                        "bold",
                        "italic",
                        "underline",
                        "link",
                        "|",
                        "bulletedList",
                        "numberedList",
                        "|",
                        "indent",
                        "outdent",
                        "|",
                        "alignment",
                        "alignment:left",
                        "alignment:right",
                        "alignment:center",
                        "alignment:justify",
                        "|",
                        "undo",
                        "redo",
                        "|",
                        "codeBlock",
                        "|",
                        "imageUpload",
                        "mediaEmbed",
                    ],
                },
                language: "en",
                placeholder: "Start typing here...",
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
