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
    <form class="referee-form" action="referee-data" method="post" target="_self">
      <input class="referee-form-first-name" name="firstName" type="text" placeholder="First Name" required>
      <input class="referee-form-last-name" name="lastName" type="text" placeholder="Last Name" required>
      <input class="referee-form-email" name="email" type="email" placeholder="Email" required>
      <input name="id" type="hidden" value="{{ $id }}">
      <button class="referee-form-submit" type="submit">Submit</button>
    </form>
  </body>
</html>
