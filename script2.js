document.addEventListener("DOMContentLoaded", function() {
    // Reference to the button and the input field
    const addKeyBtn = document.getElementById("add-key-btn");
    const newKeyInput = document.getElementById("new-key");
    const keyList = document.getElementById("key-list");

    // Function to validate the key format
    function validateKey(key) {
        // Regular expression to check if key format is correct
        const keyFormat = /^\.gg\/boostvision-[A-Za-z0-9]+-[A-Za-z0-9]+ \| \d+ \| [A-Za-z]+ \| \d{2}\/\d{2}\/\d{2}$/;
        return key.match(keyFormat);
    }

    // Function to add the new key to the list
    function addKey() {
        const newKey = newKeyInput.value.trim();

        // Log the key to ensure we get the input value
        console.log("Key entered:", newKey);

        if (newKey === "") {
            alert("Please enter a key.");
            return;
        }

        if (validateKey(newKey)) {
            // Create a new paragraph element to display the key
            const newKeyElement = document.createElement("p");
            newKeyElement.textContent = newKey;

            // Append the new key to the key list
            keyList.appendChild(newKeyElement);

            // Clear the input field
            newKeyInput.value = "";
        } else {
            alert("Invalid key format. Please enter a key in the format: .gg/boostvision-XXXX-XXXX | User ID | Lifetime | Date (DD/MM/YY)");
        }
    }

    // Add event listener to the "Add Key" button
    addKeyBtn.addEventListener("click", function() {
        console.log("Add Key button clicked!");  // Log when the button is clicked
        addKey();  // Call the addKey function to add the key
    });
});
