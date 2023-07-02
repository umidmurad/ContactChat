document
  .getElementById("contact-form")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    var formData = new FormData(this); // Get the form data

    var xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object
    xhr.open("POST", "https://umiddev.000webhostapp.com/contact.php", true); // Replace with the actual URL of your PHP script
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Request successful
          var response = xhr.responseText; // Get the response from the PHP script
          alert(response); // Display the response message
        } else {
          // Request failed
          alert("There was an error attempting to send your information.");
        }
      }
    };
    xhr.send(formData); // Send the form data to the PHP script
  });
