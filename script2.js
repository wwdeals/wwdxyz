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

            // Save the key in local storage
            saveKeysToLocalStorage();

            // Clear the input field
            newKeyInput.value = "";
        } else {
            alert("Invalid key format. Please enter a key in the format: .gg/boostvision-XXXX-XXXX | User ID | Lifetime | Date (DD/MM/YY)");
        }
    }

    // Function to save keys to local storage
    function saveKeysToLocalStorage() {
        const keys = [];
        const keyElements = keyList.getElementsByTagName("p");

        // Loop through all the key elements and store them in the keys array
        for (let i = 0; i < keyElements.length; i++) {
            keys.push(keyElements[i].textContent);
        }

        // Save the keys array to local storage
        localStorage.setItem("keys", JSON.stringify(keys));
    }

    // Function to load keys from local storage
    function loadKeysFromLocalStorage() {
        const storedKeys = JSON.parse(localStorage.getItem("keys"));

        // If there are stored keys, display them
        if (storedKeys && storedKeys.length > 0) {
            storedKeys.forEach(key => {
                const keyElement = document.createElement("p");
                keyElement.textContent = key;
                keyList.appendChild(keyElement);
            });
        }
    }

    // Add event listener to the "Add Key" button
    addKeyBtn.addEventListener("click", function() {
        addKey();
    });

    // Load keys from local storage when the page loads
    loadKeysFromLocalStorage();
});
