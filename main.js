document
  .getElementById("contact-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(this); // Get the form data

    var xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object
    xhr.open("POST", "https://umiddev.000webhostapp.com/contact.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Request successful
          var jsonResponse = JSON.parse(xhr.responseText); // Parse the JSON response
          var responseMessage = jsonResponse.message; // Get the response message
          // Get the response from the PHP script as JSON
          document.getElementById("response").textContent = responseMessage; // Update the content of the element with id="response"
        } else {
          // Request failed
          document.getElementById("response").textContent =
            "There was an error attempting to send your information.";
        }
      }
    };
    xhr.send(formData); // Send the form data to the PHP script
  });

function redirectToPage() {
  // Redirect to the desired page
  window.location.href = "https://umid.dev/"; // Replace with your desired URL
}
