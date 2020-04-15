<html>
  <head>
<?php
if(isset($externalCss)) {
?>
    <link rel="stylesheet" href={{ $externalCss }}>
<?php
}
?>
  </head>
  <body>
    <div class="link-page">
      <div class="action-message">
        Send them this personalized link to help them on their new home journey.
      </div>

      <div class="link-copy-group">
        <input class="link-field" value="" readonly></input>
      </div>

      <div class="link-share-group">
        <div class="link-share">
          <a class="copy-link-action"><i class="copy-link-action-icon"></i>copy link</a>
        </div>

        <div class="link-share">
          <a class="link-share-fb" href="" target="_blank"><i class="share-icon-fb"></i>share</a>
        </div>

        <div class="link-share">
          <a class="link-share-twitter" href="" target="_blank"><i class="share-icon-twitter"></i>tweet</a>
        </div>

        <div class="link-share">
          <a class="link-share-email" target="_blank" href=""><i class="share-icon-email"></i>email</a>
        </div>
      </div>
    </div>
  </body>

  <script>
    function copy() {
      let copyText = document.querySelector(".link-page .link-field");
      copyText.select();
      document.execCommand("copy");
    }

    document.querySelector(".link-page .link-field").addEventListener("click", copy);
    document.querySelector(".link-page .copy-link-action").addEventListener("click", copy);
  </script>
</html>
