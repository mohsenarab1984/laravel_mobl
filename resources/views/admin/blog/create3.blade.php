<template>
    <div>
      <ckeditor :editor="editor" v-model="editorData"></ckeditor>
    </div>
  </template>
  
  <script>
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
  import CKEditor from '@ckeditor/ckeditor5-vue'
  
  export default {
    components: {
      ckeditor: CKEditor.component
    },
    data() {
      return {
        editor: ClassicEditor,
        editorData: '<p>Initial editor content</p>',
      }
    },
    mounted() {
      ClassicEditor.create(document.querySelector('#editor'), {
        ckfinder: {
          uploadUrl: "/api/editor/upload?_token=" + this.$page.props.csrf_token,
          options: {
            resourceType: "Images",
            upload: {
              fileName: "photo",
            },
          },
        },
      }).then(editor => {
        this.editor = editor
      }).catch(error => {
        console.error(error)
      })
    },
    beforeDestroy() {
      if (this.editor) {
        this.editor.destroy()
      }
    }
  }
  </script>
  