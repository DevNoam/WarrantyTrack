<?php
use Framework\Session;

$successMessage = Session::getFlashMessage('success_message');
if ($successMessage !== null) : ?>
    <div class="has-text-centered has-text-weight-bold is-size-5 has-text-success">
    <?= $successMessage ?>
  </div>
<?php endif;

$errorMessage = Session::getFlashMessage('error_message');
if ($errorMessage !== null) : ?>
  <div class="has-text-centered	has-text-weight-bold is-size-5 has-text-danger">
    <?= $errorMessage ?>
  </div>
<?php endif; ?>