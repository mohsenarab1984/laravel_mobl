<template>
    <div>
      <div id="toolbar-container" ref="toolbarContainer">
        <!-- Add toolbar options here -->
        <!-- Existing toolbar buttons -->
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
        <!-- Custom image upload button -->
        <button class="ql-image-upload">Upload </button>
        <!-- Custom image toolbar -->
        <div id="image-toolbar" style="display: none;">
          W: <input type="text" id="image-width" style="width: 60px;height: 20px;">
          H: <input type="text" id="image-height" style="width: 60px;height: 20px;">
          Alt: <input type="text" id="image-alt" style="width: 60px;height: 20px;">
        </div>
      </div>
      <div id="editor" ref="editor"></div>
  
      <button @click="showContent" class="btn btn-success">Show Content</button>
      <button @click="getContentAndSend">Send Content</button>
      <button @click="getSelection_Quill">get  selection</button>
  
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
  

  function getSelection_Quill(){

       const range = quill.getSelection();
       console.log('range:',range)
       const text = quill.getText(range.index, range.length);
       const selectedContent = quill.getContents(range.index, range.length);
       console.log('User has highlighted: ', text,selectedContent.ops[0],selectedContent.ops[0]['insert']['image']);
       console.log('getSemanticHTML: ',quill.getSemanticHTML(range.index, range.length))

       var el = quill.getSemanticHTML(range.index, range.length);

       var input_new = document.createElement('img');
       input_new.setAttribute('style', 'width:60px; height:20px');

       if(selectedContent.ops[0]['insert']['image']){

           input_new.setAttribute('url', selectedContent.ops[0]['insert']['image']);

           quill.formatText(range.index, 1, 'style', 'width:100px; height:100px');
           quill.insertEmbed(range.index, 'image', selectedContent.ops[0]['insert']['image']);
       }


       
       console.log(input_new)



  }

  onMounted(() => {
    quill = new Quill(editor.value, {
      theme: 'snow',
      modules: {
        toolbar: toolbarContainer.value
      }
    });
  
    // Add functionality for custom image upload button
    const imageUploadButton = document.querySelector('.ql-image-upload');
    imageUploadButton.addEventListener('click', () => {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');
      /////
      const range = quill.getSelection();
      console.log('range:',range)
      const text = quill.getText(range.index, range.length);
       console.log('User has highlighted: ', text);
      ///////
      input.onchange = () => {
                const file = input.files[0];
                const formData = new FormData();
                formData.append('upload', file);

                axios.post('/api/editor/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    console.log('Response data in image upload:', response.data);
                    const imageUrl = response.data.url;
                    const range = quill.getSelection();
                   // alert('range: '+range+', range.index: '+range?.index)
                  
                    quill.insertEmbed(range ? range.index : 0, 'image', imageUrl);
                })
                .catch(error => {
                    console.error('Error uploading image:', error);
                });
      };
      input.click();
    });
  
    // Customize image toolbar with width, height, alt text fields
   // Customize image toolbar with width, height, alt text fields
   quill.getModule('toolbar').addHandler('image', () => {
    const toolbar = document.querySelector('#image-toolbar');
    toolbar.style.display = 'block';

    toolbar.innerHTML = ''; // Clear existing content

    const widthInput = document.createElement('input');
    widthInput.setAttribute('type', 'number');
    widthInput.setAttribute('id', 'image-width');
    widthInput.setAttribute('style', 'width:60px; height:20px');
    widthInput.setAttribute('placeholder', 'Width');
    toolbar.appendChild(widthInput);

    const heightInput = document.createElement('input');
    heightInput.setAttribute('type', 'number');
    heightInput.setAttribute('id', 'image-height');
    heightInput.setAttribute('style', 'width:60px; height:20px');
    heightInput.setAttribute('placeholder', 'Height');
    toolbar.appendChild(heightInput);

    const altInput = document.createElement('input');
    altInput.setAttribute('type', 'text');
    altInput.setAttribute('id', 'image-alt');
    altInput.setAttribute('style', 'width:60px; height:20px');
    altInput.setAttribute('placeholder', 'Alt');
    toolbar.appendChild(altInput);

    const setAttributesButton = document.createElement('button');
    setAttributesButton.innerHTML = 'Set Attributes';
    setAttributesButton.addEventListener('click', () => {
        const width = document.querySelector('#image-width').value;
        const height = document.querySelector('#image-height').value;
        const alt = document.querySelector('#image-alt').value;

       // alert('dfdfd')
        console.log('sdsdsdd')



         // Get the selected range
// Get the selected range
const selectedRange = quill.getSelection();

// if (selectedRange) {
//     // Get the Delta representation of the selected part
//     const selectedDelta = quill.getContents(selectedRange.index, selectedRange.length);
    
//     if (selectedDelta.ops.length > 0) {
//         // Convert Delta representation to HTML string
//         const selectedHtmlString = quill.clipboard.convert(selectedDelta);
        
//         console.log(selectedHtmlString); // Output the selected HTML content
        
//         // You can now use selectedHtmlString for further processing
//     } else {
//         console.log('No content selected');
//     }
// } else {
//     console.log('No selection found');
// }




        // const selectedImage = quill.root.querySelector('.ql-editor img.ql-image-selected');
        const selectedImage = quill.root.querySelector('.ql-editor img');

        if (selectedImage) {
            selectedImage.setAttribute('width', width);
            selectedImage.setAttribute('height', height);
            selectedImage.setAttribute('alt', alt);

            // Update the image style directly for immediate visual feedback
            if (selectedImage.style) {
                selectedImage.style.width = width + 'px';
                selectedImage.style.height = height + 'px';
            }else{
                alert('selectedImage.style did not exist')
            }
            alert('selectedImage !')
        }else{
            alert('selectedImage did not exist')
        }

        toolbar.style.display = 'none';
    });

    toolbar.appendChild(setAttributesButton);
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

  #image-toolbar {
  display: none;
}

#image-toolbar input {
  margin: 5px;
  padding: 5px;
  width: 80px; /* Adjust the width as needed */
  border: 1px solid #ccc;
  border-radius: 4px;
}

  </style>
  