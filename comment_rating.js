document.getElementById('commentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form values
    const userName = document.getElementById('userName').value;
    const userComment = document.getElementById('userComment').value;
    const userRating = document.getElementById('userRating').value;

    // Create a new comment element
    const commentElement = document.createElement('div');
    commentElement.classList.add('comment');

    // Add name, rating, and comment to the new comment element
    commentElement.innerHTML = `
        <h3>${userName} - Rating: ${userRating}/5</h3>
        <p>${userComment}</p>
    `;

    // Add the new comment element to the comments container
    document.getElementById('commentsContainer').appendChild(commentElement);

    // Clear the form
    document.getElementById('commentForm').reset();
});
