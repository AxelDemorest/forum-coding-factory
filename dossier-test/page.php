<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../highlightjs/styles/Ocean.css">
  <script src="../highlightjs/highlight.pack.js"></script>
  <script>
    hljs.initHighlightingOnLoad();
  </script>
  <title>Document</title>
</head>

<body>
<pre><code class="hljs language-js">  $(document).ready(function() {
  $(".nav-item").hover(
  function() {
  $(this).children(".border-li").css("width", "40px");
  },
  function() {
  $(this).children(".border-li").css("width", "20px");
  }
  );
  });</code></pre>


</body>

</html>