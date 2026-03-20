// JavaScript functionality for interactivity

document.addEventListener('DOMContentLoaded', function() {
    // Example interactivity
    const button = document.getElementById('myButton');
    if (button) {
        button.addEventListener('click', function() {
            alert('Button clicked!');
        });
    }
});