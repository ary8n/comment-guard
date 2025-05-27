document.addEventListener("DOMContentLoaded", function () {
    const commentForm = document.querySelector("#commentform");
    const commentField = document.querySelector("#comment");
    
    if (!commentForm || !commentField) return;

    // Hidden input to store validation status
    const hiddenInput = document.createElement("input");
    hiddenInput.type = "hidden";
    hiddenInput.name = "verified_human";
    hiddenInput.value = "0"; // default to not human
    commentForm.appendChild(hiddenInput);

    let typingStarted = false;
    let startTime;
    let pasted = false;

    commentField.addEventListener("paste", function () {
        pasted = true;
    });

    commentField.addEventListener("input", function () {
        if (!typingStarted) {
            startTime = new Date().getTime();
            typingStarted = true;
        }
    });

    commentForm.addEventListener("submit", function (e) {
        const now = new Date().getTime();
        const timeSpent = (now - startTime) / 1000; // in seconds

        if (pasted || timeSpent < 5) {
            // Looks spammy
            alert("Comment blocked: Please type your comment manually.");
            e.preventDefault();
        } else {
            hiddenInput.value = "1"; // valid human behavior
        }
    });
});
