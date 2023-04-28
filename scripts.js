document.addEventListener("DOMContentLoaded", function() {
    // Hamburger menu toggle
    const hamburgerIcon = document.querySelector("hamburger-icon");
    const hamburgerMenu = document.getElementById("hamburger-menu");
//erstellt ein Event, wenn der Nutzer auf das Hamburger Icon klickt
    hamburgerIcon.addEventListener("click", () => {
        hamburgerMenu.classList.toggle("hidden");
    });
    
    //elements der filter form
    const filterForm = document.getElementById("filter-form");
    const authorInput = document.getElementById("author");
    const salesInput = document.getElementById("sales");
    const bookList = document.getElementById("book-list");

    // test values
    const books = [
        { id: 1, title: "Book 1", author: "Author A", year: 2000, sales: 1000 },
        { id: 2, title: "Book 2", author: "Author B", year: 2010, sales: 2000 },
        { id: 3, title: "Book 3", author: "Author A", year: 2020, sales: 500 },
    ];
    // stellt die Bücher dar und filtert sie nach den Eingaben des Nutzers

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
        //stellt die Bücher dar
        bookList.innerHTML = filteredBooks.map(book => `
            <div class="book">
                <h3>${book.title}</h3>
                <p>Author: ${book.author}</p>
                <p>Year: ${book.year}</p>
                <p>Sales: ${book.sales}</p>
            </div>
        `).join("");
    }
    //erstellt ein Event, wenn der Nutzer die Eingaben abschickt
    //und ruft die Funktion renderBooks auf
    filterForm.addEventListener("submit", (e) => {
        e.preventDefault();
        renderBooks();
    });

    renderBooks();
});
