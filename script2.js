document.addEventListener("DOMContentLoaded", function() {
    const addKeyBtn = document.getElementById("add-key-btn");
    const newKeyInput = document.getElementById("new-key");
    const keyList = document.getElementById("key-list");

    // Function to validate the key format
    function validateKey(key) {
        const keyFormat = /^\.gg\/boostvision-[A-Za-z0-9]+-[A-Za-z0-9]+ \| \d+ \| [A-Za-z]+ \| \d{2}\/\d{2}\/\d{2}$/;
        return key.match(keyFormat);
    }

    // Function to add the new key to the list
    function addKey() {
        const newKey = newKeyInput.value.trim();
        
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
    addKeyBtn.addEventListener("click", addKey);
});
