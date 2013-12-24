<?PHP
echo "<form method='POST'>".wp_nonce_field('sirportly','sirportly_form_submit')."
<input type='hidden'>
  <dl>
    <dt><label for='form69-name'>Name</label><dt>
    <dd><input type='text' name='customer_name' id='customer_name' /></dd>

    <dt><label for='form69-email'>E-Mail Address</label><dt>
    <dd><input type='text' name='email' id='email' /></dd>

    <dt><label for='form69-subject'>Subject</label><dt>
    <dd><input type='text' name='subject' id='subject' /></dd>

    <dt><label for='form69-message'>Message</label><dt>
    <dd><textarea name='content' id='content'></textarea></dd>

  </dl>
  <p class='submit'><input type='submit' name='send' value='Send Message' /></p>
</form>";