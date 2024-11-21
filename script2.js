// Show the text box when the "Add New Key" button is clicked
document.getElementById('add-key-btn').addEventListener('click', function() {
  // Display the form and hide the button
  document.getElementById('add-key-form').style.display = 'block';
  document.getElementById('add-key-btn').style.display = 'none'; // Hide the button
});

// Function to save and display the new key
function saveKey() {
  // Get the value entered by the user
  var newKey = document.getElementById('new-key').value.trim();
  
  // Validate the key format (simple regex to check the general format)
  var keyFormat = /^\.gg\/boostvision-[A-Za-z0-9]+-[A-Za-z0-9]+ \| \d+ \| [A-Za-z]+ \| \d{2}\/\d{2}\/\d{2}$/;
  
  if (newKey.match(keyFormat)) {
      // Create a new paragraph with the entered key
      var newKeyElement = document.createElement('p');
      newKeyElement.textContent = newKey;

      // Append the new key to the key list section
      document.getElementById('key-list').appendChild(newKeyElement);

      // Clear the input field
      document.getElementById('new-key').value = '';
      
      // Hide the form and show the button again
      document.getElementById('add-key-form').style.display = 'none';
      document.getElementById('add-key-btn').style.display = 'block';
  } else {
      alert('Please enter a valid key in the format: .gg/boostvision-XXXX-XXXX | User ID | Lifetime | Date (DD/MM/YY)');
  }
}

// Function to cancel adding a key and hide the form
function cancelAddKey() {
  // Clear the input field and hide the form
  document.getElementById('new-key').value = '';
  document.getElementById('add-key-form').style.display = 'none';
  document.getElementById('add-key-btn').style.display = 'block';
}
