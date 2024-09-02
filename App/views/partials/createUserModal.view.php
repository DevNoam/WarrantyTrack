<!-- accountModal.html -->
<div id="accountModal" class="modal">
  <div class="modal-background"></div>
  <div class="modal-content box">
      <h3 class="title is-4">Create Account</h3>
      <form id="createAccountForm">
        <div class="field">
          <label class="label">Personal name</label>
          <div class="control">
            <input required class="input" type="text" id="personalName" name="personalName" placeholder="Enter name">
          </div>
        </div>

        <div class="field">
          <label class="label">User role</label>
          <div class="select is-link is-fullwidth">
            <select required class="" name="role" id="role">
              <option value="Admin">Admin</option>
              <option value="Employee">Employee</option>
              <option value="Technician">Technician</option>
              <option value="Supplier">Supplier</option>
            </select>
        </div>
        </div>

        <div class="field">
          <label class="label">Username</label>
          <div class="control">
            <input required class="input" type="text" id="username" name="username" placeholder="Enter username">
          </div>
        </div>

        <div class="field">
          <label class="label">Password</label>
          <div class="control">
            <input required class="input" type="password" id="password" name="password" placeholder="Enter password">
          </div>
        </div>

        <div class="field">
          <div class="control">
            <p class="is-danger is-large is-hidden" id="error">ErrorPlaceHolder</p>
          </div>
        </div>  

        <div class="field">
          <div class="control">
            <button type="submit" class="button is-success" id="submit">Create</button>
          </div>
        </div>
      </form>
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>

<!-- Embed CSS Styles -->
<style>
  /* Position the modal on the left side of the screen */
  .modal-content {
    position: absolute;
    top: auto;
    right: 0;
    width: 30%;
    height: 100%;
  }

  /* Ensure the modal background covers the full screen */
  .modal-background {
    background-color: rgba(10, 10, 10, 0.6);
  }
  /* Responsive adjustments for mobile */
  @media (max-width: 768px) {
    .modal-content {
      width: 90%;
      height: 100%;
      position: relative;
      margin: 0 auto;
      box-shadow: none;
    }

    .box {
      padding: 1rem;
    }

    .modal-close {
      top: 10px;
      right: 10px;
    }
  }
</style>

<!-- Embed jQuery Script -->
<script>
  $(document).ready(function () {
    // Close the modal when the background or close button is clicked
    $('.modal-close, .modal-background').on('click', function () {
      $('#accountModal').removeClass('is-active');
    });

    // Handle form submission
    $('#createAccountForm').on('submit', function (e) {
      e.preventDefault();

      const username = $('#username').val();
      const password = $('#password').val();
      const personalName = $('#personalName').val();
      const role = $('#role').val();

      $('#submit').addClass('is-loading').
      attr('disabled', 'disabled');

      // Send data to backend API
      $.ajax({
          url: '/API/createuser', // Update this with your API endpoint
          type: 'POST',
          data: { username: username, personalName: personalName, role: role, password: password },
          success: function (response) {
              // Destroy the form
              $('#createAccountForm').trigger('reset');
              $('#accountModal').removeClass('is-active');
              location.reload();
            },
            error: function (jqXHR) {
              // Re-enable the submit button and remove the loading state
              $('#submit').removeClass('is-loading').removeAttr('disabled');
              
              // Show error message if user exists or another error occurred
              $('#error').removeClass('is-hidden');
              if(jqXHR.status === 409) {
                $('#error').text("Username already exists");
              }else 
              if(jqXHR.status === 500) {
                $('#error').text("Internal server error");
              }
          }
      });
      });
      });
</script>