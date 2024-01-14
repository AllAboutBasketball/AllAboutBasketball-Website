<footer class="footer pt-5">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">Services</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">Contact</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">About</a>
              </li>
            </ul>
            </div>
        </div>
      </div>
</footer>
    </main>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script src="assets/js/smooth-scrollbar.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/custom.js"></script>

    
    

    

    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
      <?php 
        if(isset($_SESSION['message'])){?>
      alertify.set('notifier','position', 'top-right');
      alertify.success('<?= $_SESSION['message']?>');
        <?php 
          unset($_SESSION['message']);
        } 
        ?>
    </script>

    <!-- DISABLED SPECIAL CHARACTER -->
    <script>
      function disableSpecialCharacters(input) {
  input.value = input.value.replace(/[!@#$%^&*()]/g, '');
}
    </script>
    
    <!--------- ADD ATTENDANCE ------------->
      <script>
      // Get the current date
      var now = new Date();

      // Format the current date as a string in the format "YYYY-MM-DD"
      var year = now.getFullYear();
      var month = String(now.getMonth() + 1).padStart(2, '0');
      var day = String(now.getDate()).padStart(2, '0');
      var formattedDate = `${year}-${month}-${day}`;

      // Set the value of the input field to the formatted date
      document.getElementById("set-time").value = formattedDate;
  </script>


    <!------------------ HIRING DATE // ADD EMPLOYEE ----------------------->
    <script>
  // Get the current date and time
  var now = new Date();

  // Format the current date and time as a string in the format "YYYY-MM-DDTHH:MM"
  var year = now.getFullYear();
  var month = String(now.getMonth() + 1).padStart(2, '0');
  var day = String(now.getDate()).padStart(2, '0');
  var hours = String(now.getHours()).padStart(2, '0');
  var minutes = String(now.getMinutes()).padStart(2, '0');
  var formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

  // Set the value of the input field to the formatted date and time
  document.getElementById("set-date").value = formattedDateTime;
</script>

<!------------------------SUPPPLIER DATE ------------------------->
<script>
    // Function to update the input field with the current date and time
    function updateDateTime() {
        var now = new Date();

        // Format the current date and time as a string in the format "YYYY-MM-DDTHH:MM"
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0');
        var day = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Set the value of the input field to the formatted date and time
        document.getElementById("product-supplied").value = formattedDateTime;
    }

    // Update the input field initially
    updateDateTime();

    // Update the input field every second to reflect the current date and time
    setInterval(updateDateTime, 1000);
</script>

<script>
    function checkInput(input) {
        if (input.value.length > 6) {
            input.value = input.value.slice(0, 6);
        }
    }
</script>

<script>
    function checkPhone(input) {
        input.value = input.value.replace(/\D/g, '').slice(0, 11);
    }
</script>

<!--------------------------------------ATTENDANCE-TIME--------------------------------->
<script>
  // Get the current time
  var currentTime = new Date();

  // Set the logout time to 5:00 PM
  var logoutTime = new Date();
  logoutTime.setHours(17, 0, 0); // Set hours, minutes, and seconds to 17:00:00 (5:00 PM)

  // Format the time as "HH:mm"
  var formattedTime = currentTime.getHours().toString().padStart(2, '0') + ':' +
                      currentTime.getMinutes().toString().padStart(2, '0');

  // Set the value of the input fields
  document.getElementById('sign_in_time').value = formattedTime;
  document.getElementById('sign_out_time').value = logoutTime.getHours().toString().padStart(2, '0') + ':' +
                                                   logoutTime.getMinutes().toString().padStart(2, '0');
</script>


<!-- <script>
  // Function to calculate log-out time
  function calculateLogoutTime() {
    var signInTime = document.getElementById("sign_in_time").value;
    var logoutTimeElement = document.getElementById("sign_out_time");

    if (signInTime) {
      var signInDateTime = new Date(`2000-01-01T${signInTime}`);
      signInDateTime.setHours(signInDateTime.getHours() + 8);
      var hours = String(signInDateTime.getHours()).padStart(2, '0');
      var minutes = String(signInDateTime.getMinutes()).padStart(2, '0');
      var logoutTime = hours + ":" + minutes;
      logoutTimeElement.value = logoutTime;
    } else {
      logoutTimeElement.value = "";
    }
  }

  // Attach event listener to log-in time input
  document.getElementById("sign_in_time").addEventListener("input", calculateLogoutTime);
</script> -->

<!--------------------------------------LEAVE APPLICATION --------------------------------->

<script>
    // Get the input elements
    const daysInput = document.getElementById('days');
    const startDateInput = document.getElementById('app-date');
    const endDateInput = document.getElementById('app-end-date');

    // Add event listener for input changes
    daysInput.addEventListener('input', updateEndDate);
    startDateInput.addEventListener('input', updateEndDate);

    // Function to calculate and update the end date
    function updateEndDate() {
        const days = parseInt(daysInput.value, 10);
        const startDate = new Date(startDateInput.value);

        if (Number.isNaN(days) || !startDate.getTime()) {
            endDateInput.value = ''; // Clear the end date if input is invalid
            return;
        }

        const endDate = new Date(startDate.getTime() + days * 24 * 60 * 60 * 1000);
        endDateInput.value = endDate.toISOString().slice(0, 10);
    }

    // Clear end date if days, start date, or end date is empty
    function clearEndDate() {
        if (daysInput.value === '' || startDateInput.value === '' || endDateInput.value === '') {
            endDateInput.value = '';
        }
    }

    daysInput.addEventListener('input', clearEndDate);
    startDateInput.addEventListener('input', clearEndDate);
    endDateInput.addEventListener('input', clearEndDate);
</script>

<!--------------------------------------STOCK --------------------------------->
<script>
    // Get the current date and time
    var currentDate = new Date();
    
    // Get the current year, month, day, hours, and minutes
    var year = currentDate.getFullYear();
    var month = String(currentDate.getMonth() + 1).padStart(2, '0');
    var day = String(currentDate.getDate()).padStart(2, '0');
    var hours = String(currentDate.getHours()).padStart(2, '0');
    var minutes = String(currentDate.getMinutes()).padStart(2, '0');
    
    // Format the date and time in the required format (YYYY-MM-DDTHH:mm)
    var formattedDate = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
    
    // Set the value of the input field
    document.getElementById('stock').value = formattedDate;
</script>

<script>
    function limitDigits(input, maxLength) {
        if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
        }
    }
</script>
<script>
    function getData() {
  var x = document.getElementById("inventory").value;
    //   alert(x);
      $.ajax({
          url: "code.php",  // URL of the PHP script
          type: "POST",  // HTTP method
          data: {  // Data to send to the server
            'id': x,
            'get_inventory_btn': true
          },
          dataType:"json",
          success: function(response) {
              console.log(response['name']);
              document.getElementById("name").value = response['name'];
              document.getElementById("qty").value = response['qty'];
              document.getElementById("size").value = response['size'];
          }
        });
    }
    
</script>


</body> 
</html>