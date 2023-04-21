document.addEventListener("DOMContentLoaded", function() {
    // Hamburger menu toggle
    const hamburgerIcon = document.querySelector("hamburger-icon");
    const hamburgerMenu = document.getElementById("hamburger-menu");

    hamburgerIcon.addEventListener("click", () => {
        hamburgerMenu.classList.toggle("hidden");
    });
    
    // Book filter functionality
    const filterForm = document.getElementById("filter-form");
    const authorInput = document.getElementById("author");
    const yearInput = document.getElementById("year");
    const salesInput = document.getElementById("sales");
    const bookList = document.getElementById("book-list");

    // Dummy data for demonstration purposes
    const books = [
        { id: 1, title: "Book 1", author: "Author A", year: 2000, sales: 1000 },
        { id: 2, title: "Book 2", author: "Author B", year: 2010, sales: 2000 },
        { id: 3, title: "Book 3", author: "Author A", year: 2020, sales: 500 },
    ];

    function renderBooks() {
        const authorFilter = authorInput.value.toLowerCase();
        const yearFilter = yearInput.value;
        const salesFilter = salesInput.value;

        const filteredBooks = books.filter(book => {
            if (authorFilter && !book.author.toLowerCase().includes(authorFilter)) {
                return false;
            }
            if (yearFilter && book.year !== parseInt(yearFilter)) {
                return false;
            }
            if (salesFilter && book.sales !== parseInt(salesFilter)) {
                return false;
            }
            return true;
        });

        bookList.innerHTML = filteredBooks.map(book => `
            <div class="book">
                <h3>${book.title}</h3>
                <p>Author: ${book.author}</p>
                <p>Year: ${book.year}</p>
                <p>Sales: ${book.sales}</p>
            </div>
        `).join("");
    }

    filterForm.addEventListener("submit", (e) => {
        e.preventDefault();
        renderBooks();
    });

    renderBooks();
});
