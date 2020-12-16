<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="prism/prism.css" rel="stylesheet" />
  <script src="prism/prism.js"></script>

  <title>Document</title>
  <!--   <style>
    /* Mon code si aucune classe n'est attribuée */

    code:not([class*="language-"]),
    pre:not([class*="language-"]) {
      color: #f8f8f2;
      background: none;
      text-shadow: 0 1px rgba(0, 0, 0, 0.3);
      font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
      font-size: 1em;
      text-align: left;
      white-space: pre;
      word-spacing: normal;
      word-break: normal;
      word-wrap: normal;
      line-height: 1.5;
      -moz-tab-size: 4;
      -o-tab-size: 4;
      tab-size: 4;
      -webkit-hyphens: none;
      -moz-hyphens: none;
      -ms-hyphens: none;
      hyphens: none;
    }

    /* Code blocks */

    pre:not([class*="language-"]) {
      padding: 1em;
      margin: .5em 0;
      overflow: auto;
      border-radius: 0.3em;
    }

    :not(pre)>code:not([class*="language-"]),
    pre:not([class*="language-"]) {
      /* background: #272822; */
      background: red;
    }

    /* Inline code */

    :not(pre)>code:not([class*="language-"]) {
      padding: .1em;
      border-radius: .3em;
      white-space: normal;
    }
  </style> -->
</head>


<body>

  <?php require 'Parsedown.php';

  $parsedown = new Parsedown();

  $text = file_get_contents("test.txt");

  echo $parsedown->text($text);

  ?>
  <!-- <pre><code class="language-javascript">let myImage = document.querySelector('img');

myImage.addEventListener('click', function() {
    let mySrc = myImage.getAttribute('src');
    if (mySrc === 'images/firefox-icon.png') {
      myImage.setAttribute('src', 'images/firefox2.png');
    } else {
      myImage.setAttribute('src', 'images/firefox-icon.png');
    }
});</code></pre> -->
  <script>
    let codeBlockList = document.querySelectorAll("code");

    codeBlockList.forEach(function(codeBlock) {
      if(codeBlock.classList.length == 0) {
        codeBlock.classList.add("language-markup");
      }
    });
  </script>
</body>

</html>