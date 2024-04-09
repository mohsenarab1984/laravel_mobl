<template>
    <div>
      <div id="toolbar-container" ref="toolbarContainer">
        <!-- Add toolbar options here -->
        <button class="ql-bold"></button>
        <button class="ql-italic"></button>
        <button class="ql-underline"></button>
        <button class="ql-strike"></button>
        <select class="ql-font"></select>
        <select class="ql-size"></select>
        <select class="ql-color"></select>
        <select class="ql-background"></select>
        <select class="ql-align">
    <option selected></option>
    <option value="center">Center</option>
    <option value="right">Right</option>
    <option value="justify">Justify</option>
    <option value="rtl">Right-to-Left</option>
</select>
        <button class="ql-script" value="sub"></button>
        <button class="ql-script" value="super"></button>
        <button class="ql-header" value="1"></button>
        <button class="ql-header" value="2"></button>
        <button class="ql-blockquote"></button>
        <button class="ql-code-block"></button>
        <button class="ql-list" value="ordered"></button>
        <button class="ql-list" value="bullet"></button>
        <button class="ql-indent" value="-1"></button>
        <button class="ql-indent" value="+1"></button>
        <button class="ql-direction" value="rtl"></button>
        <button class="ql-link"></button>
        <button class="ql-image"></button>
        
        <button class="ql-video"></button>
      </div>
      <div id="editor" ref="editor"></div>
  
      <button @click="showContent" class="btn btn-success">Show Content</button>
      <button @click="getContentAndSend">Send Content</button>
  
      <hr>
      <div id="view_output" style="border: 1px solid #999; width: 1000px; margin: 0 auto"></div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import Quill from 'quill';
  
  const toolbarContainer = ref(null);
  const editor = ref(null);
  let quill;
  
  const showContent = () => {
    const editorContent = quill.root.innerHTML;
    console.log('Editor Content:', editorContent);
    document.getElementById('view_output').innerHTML = editorContent;
  };
  
  const getContentAndSend = () => {
    const editorContent = quill.root.innerHTML;
  
    // Send the editor content using Axios
    axios.post('/api', { content: editorContent })
      .then(response => {
        console.log('Content sent successfully', response.data);
      })
      .catch(error => {
        console.error('Error sending content: ' + error.response);
      });
  };
  
  onMounted(() => {
    quill = new Quill(editor.value, {
      theme: 'snow',
      modules: {
        toolbar: toolbarContainer.value
      }
    });
  });
  </script>
  
  <style>
  @import 'https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css';
  /* Add this CSS to style the Quill toolbar */
  .ql-toolbar {
    border: 1px solid #ccc;
    border-radius: 4px;
    display: flex;
    flex-wrap: wrap;
    padding: 8px;
    background-color: #f9f9f9;
  }
  
  .ql-toolbar button,
  .ql-toolbar select {
    margin: 0 4px;
    padding: 4px 8px;
    border: none;
    border-radius: 4px;
    background-color: #fff;
    cursor: pointer;
  }
  
  .ql-toolbar button:hover,
  .ql-toolbar select:hover {
    background-color: #f0f0f0;
  }
  
  .ql-toolbar button.active {
    background-color: #e0e0e0;
  }
  
  .ql-toolbar select {
    min-width: 80px;
  }
  </style>
  