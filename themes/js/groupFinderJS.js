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
        print_r('data');
        displayGroups(data);
    })
    .catch(error => {
        console.error('There was a problem fetching the JSON data:', error);
    });

function displayGroups(groups, filter = "", genre = "") {
    console.log("Displaying groups with filter:", filter, "and genre:", genre);

    let productContainer = document.getElementById("products");
    productContainer.innerHTML = '';

    for (let i of groups) {
        if (filter && !fuzzySearch(i.name, filter)) {
            console.log("Skipping group due to filter:", i.name);
            continue;
        }
        if (genre && i.genre !== genre) {
            console.log("Skipping group due to genre mismatch:", i.name);
            continue;
        }

        // Create Card
        let card = document.createElement("div");
        card.classList.add("card", i.type);

        // Create container for card content
        let container = document.createElement("div");
        container.classList.add("container");

        // Group name
        let name = document.createElement("h5");
        name.classList.add("group-name");
        name.innerText = i.name.toUpperCase();
        container.appendChild(name);

        // Group games
        let games = document.createElement("p");
        games.classList.add("group-games");
        games.innerText = "Games: " + i.games.join(", "); // Assuming games is an array
        container.appendChild(games);

        // Group website
        let website = document.createElement("a");
        website.classList.add("group-website");
        website.href = i.website;
        website.innerText = "Visit website";
        website.target = "_blank"; // open in new tab
        container.appendChild(website);

        // Group bio
        let bio = document.createElement("p");
        bio.classList.add("group-bio");
        bio.innerText = i.bio;
        container.appendChild(bio);

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
