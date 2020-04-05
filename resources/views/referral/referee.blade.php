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
    <div class="referee-page">
      <form class="referee-form" action="referee-data" method="post" target="_self">
        <input name="id" type="hidden" value="{{ $id }}">
        <input name="externalCss" type="hidden" value="{{ $externalCss ?? null }}">

        <div class="section referee-name">
          <div class="input-group">
            <label for="referee-first-name">First Name</label>
            <input class="referee-form-first-name" name="firstName" id="referee-first-name" type="text" placeholder="First Name" required>
          </div>
          <div class="input-group">
            <label for="referee-last-name">Last Name</label>
            <input class="referee-form-last-name" name="lastName" id="referee-last-name" type="text" placeholder="Last Name" required>
          </div>
        </div>

        <div class="section referee-contact">
          <div class="input-group">
            <label for="referee-email">Email</label>
            <input class="referee-form-email" name="email" id="referee-email" type="email" placeholder="Email" required>
          </div>
          <div class="input-group">
            <label for="referee-phone">Phone</label>
            <input class="referee-form-phone" name="phone" id="referee-phone" type="tel" placeholder="123-123-1234" required>
          </div>
        </div>

        @if (count($products) > 0)
          <div class="section input-group">
            <label for="referee-product">Which community are you interested in?</label>
            <select id="referee-product" name="product" required>
              <option value="" selected disabled>Select a community</option>

              @foreach ($products as $product)
                <option value="{{ $product }}">{{ $product }}</option>
              @endforeach
            </select>
          </div>
        @endif

<!--
        <div class="section">
          additional sections like so
        </div>
-->

        <button class="referee-form-submit" type="submit">Submit</button>
      </form>
    </div>
  </body>
</html>
