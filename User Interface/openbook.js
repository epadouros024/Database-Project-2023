function openBookModal(title, author, pages) {
    var modal = document.getElementById('bookModal');
    modal.style.display = "block";

    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalAuthor').innerText = author;
    document.getElementById('modalPages').innerText = pages;
}

window.onclick = function(event) {
    var modal = document.getElementById('bookModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
