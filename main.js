var message = document.getElementById("text").value;
//When user clicks the button, get message and append it to the text variable
document.getElementById("button").addEventListener("click", function () {
  var message = document.getElementById("message").value;
  var textElement = document.getElementById("text");
  textElement.innerHTML += "<br>" + message;
  document.getElementById("message").value = "";
});
