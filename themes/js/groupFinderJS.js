const url = 'libraries/fetchGroups.php';

fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        displayGroups(data);
    })
    .catch(error => {
        console.error('There was a problem fetching data:', error);
    });

function displayGroups(groups, filter = "", genre = "") {
    console.log("Displaying groups with filter:", filter, "and genre:", genre);

    let productContainer = document.getElementById("products");
    productContainer.innerHTML = '';

    for (let group of groups) {
        if (filter && !fuzzySearch(group.name, filter)) {
            console.log("Skipping group due to filter:", group.name);
            continue;
        }
        if (genre && group.genre !== genre) {
            console.log("Skipping group due to genre mismatch:", group.name);
            continue;
        }

        // Create clickable card
        let card = document.createElement("a");
        card.classList.add("card", group.type);
        card.href = `groupDetails.php?group_id=${group.GroupID}`;

        // Create container for card content
        let container = document.createElement("div");
        container.classList.add("container");

        // Group name
        let name = document.createElement("h5");
        name.classList.add("group-name");
        name.innerText = group.name.toUpperCase();
        container.appendChild(name);

        // Group games - check if the property exists and is an array
        let gamesText = group.games ? "Games: " + group.games.join(", ") : "Games information not available";
        let games = document.createElement("p");
        games.classList.add("group-games");
        games.innerText = gamesText;
        container.appendChild(games);

        // Group website
        let website = document.createElement("a");
        website.classList.add("group-website");
        website.href = group.website;
        website.innerText = "Visit website";
        website.target = "_blank"; // open in new tab
        container.appendChild(website);

        // Group bio
        let bio = document.createElement("p");
        bio.classList.add("group-bio");
        bio.innerText = group.bio;
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
