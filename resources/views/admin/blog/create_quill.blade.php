<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>اضافه کردن پست</title>
     
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>
    <link     rel="stylesheet"     href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

    <div id="toolbar-container">
                <span class="ql-formats">
                <select class="ql-font"></select>
                <select class="ql-size"></select>
                </span>
                <span class="ql-formats">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-strike"></button>
                </span>
                <span class="ql-formats">
                <select class="ql-color"></select>
                <select class="ql-background"></select>
                </span>
                <span class="ql-formats">
                <button class="ql-script" value="sub"></button>
                <button class="ql-script" value="super"></button>
                </span>
                <span class="ql-formats">
                <button class="ql-header" value="1"></button>
                <button class="ql-header" value="2"></button>
                <button class="ql-blockquote"></button>
                <button class="ql-code-block"></button>
                </span>
                <span class="ql-formats">
                <button class="ql-list" value="ordered"></button>
                <button class="ql-list" value="bullet"></button>
                <button class="ql-indent" value="-1"></button>
                <button class="ql-indent" value="+1"></button>
                </span>
                <span class="ql-formats">
                <button class="ql-direction" value="rtl"></button>
                <select class="ql-align"></select>
                </span>
                <span class="ql-formats">
                <button class="ql-link"></button>
                <button class="ql-image"></button>
                <button class="ql-video"></button>
                <button class="ql-formula"></button>
                </span>
                <span class="ql-formats">
                <button class="ql-clean"></button>
                </span>
            </div>

      <div id="editor">
      </div>


        <button onclick="showContent()" class="btn btn-success">show Content</button>
        <button onclick="getContentAndSend()">Send Content</button>

        <hr>
        <div id="view_output" style="border:1px solid #999; width:1000px; margin: 0 auto">

        </div>

      
    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#editor', {
        modules: {
            syntax: true,
            toolbar: '#toolbar-container',
        },
        placeholder: 'Compose an epic...',
        theme: 'snow',
        });
    </script>

    <script>

            function showContent(){
                // const editorContent  = quill.getText();
                const editorContent  = $('#editor .ql-editor').html();
                const editorContent2  = quill.getSemanticHTML();
                
                console.log('editorContent: ',editorContent)
                 $('#view_output').html(editorContent2)
            }
    
            function getContentAndSend() {
                const editorContent  = $('#editor .ql-editor').html();
                
                // Send the editor content using Axios
                
                axios.post('{{ route('admin.blog.create') }}', { content: editorContent })
                    .then(response => {
                        console.log('Content sent successfully', response.data);
                    })
                    .catch(error => {
                        console.error('Error sending content: ' + error.response);
                    });
            }
    



    </script>

    
</body>
</html>





