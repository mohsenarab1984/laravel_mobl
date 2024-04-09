<template>
    <div>
      <div id="toolbar-container" ref="toolbarContainer"></div>
      <div id="editor" ref="editor"></div>
  
      <button @click="showContent" class="btn btn-success">Show Content</button>
      <button @click="getContentAndSend">Send Content</button>
  
      <hr>
      <div id="view_output" style="border: 1px solid #999; width: 1000px; margin: 0 auto"></div>
    </div>
  </template>

 
  
  <script setup>

  import { ref,onMounted } from 'vue';
  import axios from 'axios';
  
  const toolbarContainer = ref(null);
  const editor = ref(null);
  
  onMounted(() => {
    const quill = new Quill(editor.value, {
      modules: {
        syntax: true,
        toolbar: toolbarContainer.value,
      },
      placeholder: 'Compose an epic...',
      theme: 'snow',
    });
  
    window.quill = quill; // Make quill accessible globally for demo purposes
  });
  
  const showContent = () => {
    const editorContent = window.quill.getSemanticHTML();
    console.log('Editor Content:', editorContent);
    document.getElementById('view_output').innerHTML = editorContent;
  };
  
  const getContentAndSend = () => {
    const editorContent = window.quill.root.innerHTML;
    
    // Send the editor content using Axios
    axios.post('/api', { content: editorContent })
      .then(response => {
        console.log('Content sent successfully', response.data);
      })
      .catch(error => {
        console.error('Error sending content: ' + error.response);
      });
  };
  </script>
  
  <style>
  @import 'https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css';
  </style>
  