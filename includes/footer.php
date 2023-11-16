    <script src= "assets/js/jquery-3.6.1.min.js"></script>
    <!-- <script src= "assets/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src= "assets/js/custom.js"></script>
    <script src= "assets/js/owl.carousel.min.js"></script>


    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>

      alertify.set('notifier','position', 'top-right');
      <?php 
        if(isset($_SESSION['message']))
        {    
          ?>           
            alertify.success('<?= $_SESSION['message']?>');
          <?php 
          unset($_SESSION['message']);
        } 
        ?>
    </script>


<script>
  $(document).ready(function() {
    // Event handler for the select change
    $('#sizeSelect').change(function() {
      var selectedSize = $(this).val(); // Get the value of the selected option

      // Enable or disable buttons based on the selected size
      if (selectedSize === 'ALL AVAILABLE') {
        $('.modal-button').prop('disabled', false); // Enable all buttons
      } else {
        $('.modal-button').prop('disabled', true); // Disable all buttons except the selected size button
        $('#' + selectedSize.toLowerCase() + 'Btn').prop('disabled', false); // Enable the selected size button
      }
    });

    // Event handler for the button clicks
    $('.modal-button').click(function() {
      var selectedSize = $(this).val(); // Get the value of the clicked button

      // Remove the active class from all buttons
      $('.modal-button').removeClass('active');

      // Add the active class to the clicked button
      $(this).addClass('active');

      // Set the selected value in the hidden input field
      $('#selectedSize').val(selectedSize);
    });
  });
</script>

<script type="text/javascript">
    function sendEmail() {
        var name = $("#name");
        var email = $("#email");
        var contact = $("#contact");
        var address = $("#address");
        var inquiries = $("#inquiries");
        var message = $("#message");

        if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(contact) && isNotEmpty(address) && isNotEmpty(inquiries) &&
            isNotEmpty(message)) {
            $.ajax({
                url: 'sendEmail.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    name: name.val(),
                    email: email.val(),
                    contact: contact.val(),
                    address: address.val(),
                    inquiries: inquiries.val(),
                    message: message.val()
                },
                success: function (response) {
                    $('#report-form')[0].reset();
                    $('.sent-notification').text("Message Sent Successfully!.");
                }
            });
        }
    }

    function isNotEmpty(caller) {
        if (caller.val() == "") {
            caller.css('border', '1px solid red');
            return false;
        } else {
            caller.css('border', '');
            return true;
        }
    }
</script>

<script>
    function validateNameInput(input) {
        // Regular expression to match special characters and numbers
        var regex = /[!@#$%^&*()_+\d]/g;
        
        if (regex.test(input.value)) {
            // Invalid input, add "is-invalid" class to display error message
            input.classList.add("is-invalid");
        } else {
            // Valid input, remove "is-invalid" class
            input.classList.remove("is-invalid");
        }
    }
</script>

<script>
    function validateKeyPress(event) {
        var key = event.key;
        var charCode = event.charCode || event.keyCode;
        
        // Check if the key is a special character or a number
        if (/[!@#$%^&*()_+\d]/.test(key) || charCode < 32 || charCode > 126) {
            event.preventDefault();
            return false;
        }
    }
</script>

<script>
function limitInputRegister(input, maxLength) {
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
}
</script>

<!------------------------------ CART  ------------------------------------------------->
<script>
function validateCheckbox() {
  var checkboxes = document.getElementsByClassName('checkbox-item');
  var checked = false;

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      checked = true;
      break;
    }
  }

  if (!checked) {
    alert("You have not selected any items for checkout");
    return false;
  }
    var selectedItems = [];
    $(".checkbox-item:checked").each(function() {
      selectedItems.push($(this).val());
        $.ajax({
                url: 'code.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    cart_id: $(this).val(),
                },
                success: function (response) {
                }
            });
    });

    if (selectedItems.length > 0) {
      // Process the selected items
      console.log("Selected Items: ", selectedItems);
      // You can perform further actions with the selected items here
      localStorage.setItem("carts", selectedItems);
      window.location.href = 'checkout.php';
    } else {
      console.log("No items selected.");
    }
  return true;
}
</script>
  </body>
</html>