// Modal Handling
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// handles user registration using AJAX
function handleRegister(event) {
  event.preventDefault();
  
  var username = document.getElementById('regUsername').value;
  var password = document.getElementById('regPassword').value;
  
  var formData = new FormData();
  formData.append('regUsername', username);
  formData.append('regPassword', password);
  
  // create ajax request
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'registerUser.php');
  xhr.onload = function() {
    var response = JSON.parse(xhr.responseText);
    var messageDiv = document.getElementById('registerMessage');
    
    if (response.success) {
      messageDiv.style.color = 'brown';
      messageDiv.innerHTML = response.message;
      
      document.getElementById('regUsername').value = '';
      document.getElementById('regPassword').value = '';
    } else {
      messageDiv.style.color = 'red';
      messageDiv.innerHTML = response.message;
    }
  };
  xhr.send(formData);
  
  return false;
}