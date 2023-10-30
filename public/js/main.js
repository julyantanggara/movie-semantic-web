const darkMode = () => {
    const darkModeToggle = document.getElementById('darkModeToggle'),
        headerText = document.getElementById('headerText'),
        dot = document.querySelector('.dot'),
        html = document.querySelector('html');

    darkModeToggle.addEventListener('change', () => {
        if (darkModeToggle.checked) {
            html.classList.remove('dark');
            dot.style.transform = 'translateX(-100%)';
            headerText.classList.remove('gradient-text-dark');
            headerText.classList.add('gradient-text-light');
        } else {
            html.classList.add('dark');
            dot.style.transform = 'translateX(0)';
            headerText.classList.add('gradient-text-dark');
            headerText.classList.remove('gradient-text-light');
        }
    });
}

var navElement = document.getElementById("stickyNav");

window.addEventListener("scroll", function () {
    if (window.scrollY > 0) {
        navElement.classList.add("bg-mainColor");
    } else {
        navElement.classList.remove("bg-mainColor");
    }
});

const circle = document.getElementById('circle');

document.addEventListener('mousemove', (e) => {
    const height = circle.offsetHeight,
        width = circle.offsetWidth;

    setTimeout(() => {
        circle.style.left = `${e.pageX - width / 3}px`;
        circle.style.top = `${e.pageY - height / 3}px`;
    }, 200);
});

// navbar
const showSearch = () => {
    const searchField = document.getElementById('searchField'),
        searchInput = document.getElementById('searchInput');

    if (searchField.classList.contains('hidden')) {
        requestAnimationFrame(() => {
            searchField.classList.remove('hidden');
            searchInput.focus();
            requestAnimationFrame(() => {
                searchField.classList.add('opacity-100');
            });
        });
    } else {
        requestAnimationFrame(() => {
            searchField.classList.remove('opacity-100');
            requestAnimationFrame(() => {
                searchField.classList.add('hidden');
            });
        });
    }
}

const searchInput = document.querySelector('#searchField input'),
    selectInput = document.querySelector('#searchField select');

document.addEventListener('click', (event) => {
    if (event.target !== searchInput) {
        searchField.classList.add('hidden');
        searchField.classList.remove('opacity-100');
    }
});

// DROPDOWN
const dropdown1 = document.getElementById('GenreFilterDropdown');
const dropdown2 = document.getElementById('CountryFilterDropdown');
const dropdown3 = document.getElementById('YearFilterDropdown');
const dropdown4 = document.getElementById('RatingFilterDropdown');

const showDropdown = (dropdownId, iconId) => {
    const icon = document.getElementById(iconId);
    const dropdown = document.getElementById(dropdownId);

    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
        dropdown.classList.remove('hidden');
    } else {
        dropdown.classList.remove('hidden');
        dropdown.classList.add('hidden');
    }
};

const showGenreDropdown = () => {
    showDropdown('GenreFilterDropdown', 'GenreDropdownIcon');
    dropdown2.classList.add('hidden');
    dropdown3.classList.add('hidden');
    dropdown4.classList.add('hidden');
};

const showCountryDropdown = () => {
    showDropdown('CountryFilterDropdown', 'CountryDropdownIcon');
    dropdown1.classList.add('hidden');
    dropdown3.classList.add('hidden');
    dropdown4.classList.add('hidden');
};

const showYearDropdown = () => {
    showDropdown('YearFilterDropdown', 'YearDropdownIcon');
    dropdown1.classList.add('hidden');
    dropdown2.classList.add('hidden');
    dropdown4.classList.add('hidden');
};

const showRatingDropdown = () => {
    showDropdown('RatingFilterDropdown', 'RatingDropdownIcon');
    dropdown1.classList.add('hidden');
    dropdown2.classList.add('hidden');
    dropdown3.classList.add('hidden');
};

// POPULAR
const scrollButtonLeft = document.getElementById("scrollLeft");
const scrollButtonRight = document.getElementById("scrollRight");
const scrollContainer = document.querySelector(".overflow-x-scroll");

scrollButtonLeft.addEventListener("click", function () {
    scrollContainer.scrollLeft -= 600;
});

scrollButtonRight.addEventListener("click", function () {
    scrollContainer.scrollLeft += 600;
});

scrollContainer.addEventListener("scroll", function () {
    if (scrollContainer.scrollLeft === 0) {
        scrollButtonLeft.classList.add("hidden");
    } else {
        scrollButtonLeft.classList.remove("hidden");
    }

    if (scrollContainer.scrollLeft === scrollContainer.scrollWidth - scrollContainer.clientWidth) {
        scrollButtonRight.classList.add("hidden");
    } else {
        scrollButtonRight.classList.remove("hidden");
    }
});

// ACTION
const scrollButtonLeft2 = document.getElementById("scrollLeft2");
const scrollButtonRight2 = document.getElementById("scrollRight2");
const scrollContainer2 = document.querySelector(".overflow-x-scroll2");

scrollButtonLeft2.addEventListener("click", function () {
    scrollContainer2.scrollLeft -= 600;
});

scrollButtonRight2.addEventListener("click", function () {
    scrollContainer2.scrollLeft += 600;
});

scrollContainer2.addEventListener("scroll", function () {
    if (scrollContainer2.scrollLeft === 0) {
        scrollButtonLeft2.classList.add("hidden");
    } else {
        scrollButtonLeft2.classList.remove("hidden");
    }

    if (scrollContainer2.scrollLeft === scrollContainer2.scrollWidth - scrollContainer2.clientWidth) {
        scrollButtonRight2.classList.add("hidden");
    } else {
        scrollButtonRight2.classList.remove("hidden");
    }
});

// HORROR
const scrollButtonLeft3 = document.getElementById("scrollLeft3");
const scrollButtonRight3 = document.getElementById("scrollRight3");
const scrollContainer3 = document.querySelector(".overflow-x-scroll3");

scrollButtonLeft3.addEventListener("click", function () {
    scrollContainer3.scrollLeft -= 600;
});

scrollButtonRight3.addEventListener("click", function () {
    scrollContainer3.scrollLeft += 600;
});

scrollContainer3.addEventListener("scroll", function () {
    if (scrollContainer3.scrollLeft === 0) {
        scrollButtonLeft3.classList.add("hidden");
    } else {
        scrollButtonLeft3.classList.remove("hidden");
    }

    if (scrollContainer3.scrollLeft === scrollContainer3.scrollWidth - scrollContainer3.clientWidth) {
        scrollButtonRight3.classList.add("hidden");
    } else {
        scrollButtonRight3.classList.remove("hidden");
    }
});
