<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="prism/prism.css" rel="stylesheet" />
    <link rel="stylesheet" href="editor.md/css/editormd.min.css" />
    <title>Document</title>
</head>

<body>
    <div id="editor">
        <textarea>coucou</textarea>
    </div>
    <!--    <pre><code class="language-javascript">let myImage = document.querySelector('img');

myImage.addEventListener('click', function() {
    let mySrc = myImage.getAttribute('src');
    if (mySrc === 'images/firefox-icon.png') {
      myImage.setAttribute('src', 'images/firefox2.png');
    } else {
      myImage.setAttribute('src', 'images/firefox-icon.png');
    }
});</code></pre> -->
    <script src="editor.md/jquery.min.js"></script>
    <script src="editor.md/editormd.js"></script>
    <script type="text/javascript">
        $(function() {
            var editor = editormd("editor", {
                // width: "100%",
                // height: "100%",
                // markdown: "xxxx",     // dynamic set Markdown text
                path: "editor.md/lib/", // Autoload modules mode, codemirror, marked... dependents libs path
                toolbarIcons: function() {
                    // Or return editormd.toolbarModes[name]; // full, simple, mini
                    // Using "||" set icons align right.
                    return ["undo", "redo", "|", "bold", "del", "italic", "hr", "|", "code-block", "code", "|", "quote", "ucwords", "link", "|", "list-ul", "list-ol", "|", "emoji", "||", "watch"]
                },
            });
        });
    </script>
    <script src="prism/prism.js"></script>
    <script src="editor.md/languages/en.js"></script>
</body>

</html>