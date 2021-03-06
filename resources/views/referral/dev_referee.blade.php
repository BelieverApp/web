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
    <div class="referee-page">
      <div class="instructions">
        To complete your referral registration, fill out the form below. One of our area managers will be in touch to schedule your complimentary new home consultation.
      </div>

      <form class="referee-form" action="referee-data" method="post" target="_self">

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

<!--
        <div class="section">
          additional sections here
        </div>
-->

        <div class="section last">
          <div class="input-group">
            <label for="referee-product">Which community are you interested in?</label>
            <div class="select">
              <select id="referee-product" name="product" required>
                <option value="" selected disabled>Select a community</option>
              </select>
            </div>
          </div>

          <div class="input-group">
            <button class="referee-form-submit" type="submit"><i class="referee-form-submit-icon"></i>Submit</button>
          </div>
        </div>

      </form>
    </div>
  </body>
</html>
