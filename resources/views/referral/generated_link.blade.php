<html>
  <head>
<?php
if(isset($externalCss)) {
?>
    <link rel="stylesheet" href={{ $externalCss }}>
<?php
}
?>

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

      <div class="link-copy-group">
        <input class="link-field" value="{{ $link }}" readonly></input>
        <button class="copy-link-action"><i class="copy-link-action-icon"></i>copy link</button>
      </div>

      <div class="link-share-group">
        <div class="link-share">
            <a class="link-share-fb" href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{ $linkEncoded }}&display=popup&ref=plugin&src=share_button" target="_blank"><i class="share-icon-fb"></i>share</a>
        </div>
        <div class="link-share">
            <a class="link-share-twitter" href="https://twitter.com/intent/tweet?tw_p=tweetbutton&url={{ $linkEncoded }}" target="_blank"><i class="share-icon-twitter"></i>tweet</a>
        </div>
        <div class="link-share">
            <a class="link-share-messenger" href="fb-messenger://share/?link={{ $linkEncoded }}&app_id=123456789"><i class="share-icon-messenger"></i>message</a>
        </div>
        <div class="link-share">
            <a class="link-share-email" href="mailto:?subject={{ $emailSubject }}&body={{ $emailBody }}"><i class="share-icon-email"></i>email</a>
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
