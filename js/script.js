function showPasswordPrompt() {
    document.getElementById("passwordPrompt").style.display = "block";
}

function closePasswordPrompt() {
    document.getElementById("passwordPrompt").style.display = "none";
}

function checkPassword() {
    const enteredPassword = document.getElementById("passwordInput").value;
    const correctPassword = "jolocute";

    if (enteredPassword === correctPassword) {
        const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();
        document.getElementById("passwordPrompt").style.display = "none";
    } else {
        alert("Incorrect password. Please try again.");
    }
}



function openModal(modalId) {
    const myModal = new bootstrap.Modal(document.getElementById(modalId));
    myModal.show();
}