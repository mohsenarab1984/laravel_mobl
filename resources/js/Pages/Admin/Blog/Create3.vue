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

export default {
    name: "app",
    data() {
        return {
            editor: ClassicEditor,
            editorData: "<p>Content of the editor.</p>",
            editorConfig: {
                // The configuration of the editor.
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
                        "|",
                        "undo",
                        "redo",
                    ],
                },
                language: "en",
                placeholder: "Start typing here...",
                ckfinder: {
                    uploadUrl: "/api/editor/upload",
                },
            },
        };
    },
};
</script>
