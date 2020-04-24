<html>
  <head>
<?php
if(isset($cssUrl)) {
?>
    <link rel="stylesheet" href="{{ $cssUrl }}">
<?php
}
?>
  </head>
  <body>
    <div class="link-page">
      <div class="action-message">
        Send them this personalized link to help them on their new home journey.
      </div>

      <div class="link-copy-group input-group">
        <label for="link-field">Your Share Link:</label>
        <input id="link-field" class="link-field" value="{{ $link }}" readonly></input>
      </div>

      <div class="link-share-group">
        <div class="link-share">
          <a class="copy-link-action"><i class="copy-link-action-icon"></i>copy link</a>
        </div>

        <div class="link-share">
            <a class="link-share-fb" href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{ $linkEncoded }}&display=popup&ref=plugin&src=share_button" target="_blank"><i class="share-icon-fb"></i>share</a>
        </div>

        <div class="link-share">
            <a class="link-share-twitter" href="https://twitter.com/intent/tweet?tw_p=tweetbutton&url={{ $linkEncoded }}" target="_blank"><i class="share-icon-twitter"></i>tweet</a>
        </div>

        <div class="link-share">
            <a class="link-share-email" target="_blank" href="mailto:?body={{ $emailBody }}"><i class="share-icon-email"></i>email</a>
        </div>
      </div>
    </div>
  </body>

  <script>
    function onCopy() {
      let copyField = document.querySelector(".link-page .link-field");
      copyField.select();
      document.execCommand("copy");

      copyField.classList.add("link-field-copied");
    }

    document.querySelector(".link-page .link-field").addEventListener("click", onCopy);
    document.querySelector(".link-page .copy-link-action").addEventListener("click", onCopy);
  </script>
</html>
