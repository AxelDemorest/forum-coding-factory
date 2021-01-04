<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="wbbtheme.css" rel="stylesheet" />
    <link href="prism/prism.css" rel="stylesheet" />
    <script src="prism/prism.js"></script>
    <title>Document</title>
    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="jquery.wysibb.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
    <script>
        $(function() {
            var wbbOpt = {
                buttons: "bold,italic,underline,|,img,link,|,code,quote,js,",
                allButtons: {
                    code: {
                        hotkey: "ctrl+shift+3", //Add hotkey
                        transform: {
                            '<div class="mycode"><div class="codetop">Code:</div><div class="codemain">{SELTEXT}</div></div>': '[code]{SELTEXT}[/code]'
                        }
                    },
                    myquote: {
                        title: 'Insert myquote',
                        buttonText: 'myquote',
                        transform: {
                            '<div class="myquote">{SELTEXT}</div>': '[myquote]{SELTEXT}[/myquote]'
                        }
                    },
                    js: {
                        title: 'Insert js code',
                        buttonText: 'js',
                        transform: {
                            '<pre><code class="language-javascript">{SELTEXT}</code></pre>': '[code=javascript]{SELTEXT}[/javascript]'
                        }
                    }
                }
            }
            $("#exampleFormControlTextarea1").wysibb(wbbOpt);
        })
    </script>
</head>
<body>

<?php require_once "JBBCode/Parser.php";

$parser = new JBBCode\Parser();
$parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
 
$parser->parse($text);
 
echo $parser->getAsHtml();
?>

    <form>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</body>

</html>