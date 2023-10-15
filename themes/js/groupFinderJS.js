const url = '../data/groups/groups.json';

// Fetch the JSON data and display it
fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        displayGroups(data);
    })
    .catch(error => {
        console.error('There was a problem fetching the JSON data:', error);
    });

function displayGroups(groups, filter = "", genre = "") {

    let productContainer = document.getElementById("products");
    productContainer.innerHTML = '';

    for (let i of groups) {

        // Create Card
        let card = document.createElement("div");
        card.classList.add("card", i.type);
        let container = document.createElement("div");
        container.classList.add("container");
        let name = document.createElement("h5");
        name.classList.add("group-name");
        name.innerText = i.name.toUpperCase();
        container.appendChild(name);
        card.appendChild(container);
        productContainer.appendChild(card);
    }
}

function filterProduct(value) {
    let buttons = document.querySelectorAll(".button-value");
    buttons.forEach((button) => {
        if (value.toUpperCase() == button.innerText.toUpperCase()) {
            button.classList.add("active");
        } else {
            button.classList.remove("active");
        }
    });

    fetch(url)
        .then(response => response.json())
        .then(data => displayGroups(data, "", value))
        .catch(error => console.error('Error during genre filtering:', error));
}

function fuzzySearch(groupName, query) {
    let queryIndex = 0;
    for (let char of groupName) {
        if (char.toLowerCase() === query[queryIndex].toLowerCase()) {
            queryIndex++;
        }
        if (queryIndex === query.length) {
            return true;
        }
    }
    return false;
}

document.getElementById("search").addEventListener("click", () => {
    let searchInput = document.getElementById("search-input").value;
    fetch(url)
        .then(response => response.json())
        .then(data => displayGroups(data, searchInput))
        .catch(error => console.error('Error during search:', error));
});

document.querySelectorAll(".button-value").forEach(button => {
    button.addEventListener("click", () => {
        filterProduct(button.innerText);
    });
});

window.onload = () => {
    fetch(url)
        .then(response => response.json())
        .then(data => displayGroups(data))
        .catch(error => console.error('Error during initial display:', error));
};
