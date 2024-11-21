// Function to copy text to clipboard using the modern Clipboard API
function copyToClipboard(text) {
  // Use the modern Clipboard API
  navigator.clipboard
    .writeText(text)
    .then(() => {
      // Optional: Display a confirmation or tooltip that the text has been copied
      alert("Link copied to clipboard!");
    })
    .catch((err) => {
      console.error("Error copying text: ", err);
    });
}

// Add event listeners to each button
const buttons = document.querySelectorAll(".link-button");

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    const textToCopy = button.getAttribute("data-clipboard-text");
    copyToClipboard(textToCopy);
  });
});

// Select the audio player and track play state
const audioPlayer = document.getElementById("audio-player");
let isPlaying = false;

// Function to toggle play and pause
function togglePlay() {
  if (isPlaying) {
    audioPlayer.pause();
  } else {
    audioPlayer.play();
  }
  isPlaying = !isPlaying;
}

// Event listener to update the play state when audio is paused or played
audioPlayer.onplay = () => (isPlaying = true);
audioPlayer.onpause = () => (isPlaying = false);

// Toggle mute and allow user to adjust volume
function toggleMute() {
  audioPlayer.muted = !audioPlayer.muted;
  if (audioPlayer.muted) {
    audioPlayer.volume = 0;
  } else {
    // Set a default volume level when unmuted
    audioPlayer.volume = 0.5;
  }
}

// Function to fetch quotes from the JSON file and display them
async function loadQuotes() {
  try {
    const response = await fetch("quotes.json"); // Fetch JSON file
    const quotes = await response.json(); // Parse the JSON content

    // Function to randomly pick a quote and set it to the flip box
    function setRandomQuote() {
      const randomIndex = Math.floor(Math.random() * quotes.length);
      const randomQuote = quotes[randomIndex];

      // Update the front and back quote elements
      document.getElementById("quote-front").textContent = randomQuote.front;
      document.getElementById("quote-back").textContent = randomQuote.back;
    }

    // Set an initial random quote
    setRandomQuote();

    // Update quotes periodically (every 5 seconds, for example)
    setInterval(setRandomQuote, 1000); // 5000 ms = 5 seconds
  } catch (error) {
    console.error("Error loading quotes:", error);
  }
}

// Call the function to load and display quotes when the page loads
document.addEventListener("DOMContentLoaded", loadQuotes);



