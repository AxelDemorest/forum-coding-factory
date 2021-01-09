<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editormd/css/editormd.css" />
    <link rel="stylesheet" href="editormd/css/editormd.preview.css" />
    <title>Document</title>
</head>

<body>
    <div id="test-editor">
        <textarea style="display:none;"></textarea>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="editormd/editormd.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var editor = editormd("test-editor", {
                // width  : "100%",
                // height : "100%",
                path: "editormd/lib/",
                autoFocus: false,
                placeholder: "Votre message...",
                pluginPath: "editormd/plugins/",
                language: "fr",
                width: "100%",
                height: 300,
                lineNumbers: false,
                //autoHeight: true,
                watch: false,
                toolbarAutoFixed: false,
                toolbarIcons: function() {
                    // Or return editormd.toolbarModes[name]; // full, simple, mini
                    // Using "||" set icons align right.
                    return ["undo", "redo", "|", "code", "code-block", "|", "bold", "del", "italic", "|", "list-ul", "list-ol", "hr", "|", "link", "image", "||", "watch"]
                },
                codeFold: true,
                syncScrolling: true,
                dialogLockScreen: false,
                searchReplace: true,
                tex: false,
            });
        });
    </script>
    <script src="editormd/languages/fr.js"></script>
    <script src="editormd/plugins/image-dialog/image-dialog.js"></script>
    <script src="editormd/plugins/code-block-dialog/code-block-dialog.js"></script>
</body>

</html>