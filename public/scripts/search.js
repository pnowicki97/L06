const search = document.querySelector('#search');
const projectContainer = document.querySelector(".projects");
const userContainer = document.querySelector(".users");
const groupContainer = document.querySelector(".groups");

search.addEventListener("keyup", async function (event) {
    if (event.key !== "Enter") {
        return;
    }

    event.preventDefault();

    const data = {search: this.value};

    const response = await fetch("/search", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    const projects = await response.json();
    
    projectContainer.innerHTML = "";
    projects.forEach(project => {
        createProject(project);
    });

    userContainer.innerHTML = "";
    users.forEach(user => {
        createUser(user);
    });

    groupContainer.innerHTML = "";
    groups.forEach(group => {
        createGroup(group);
    });
});


function createProject(project) {
    const template = document.querySelector("#project-card-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = project.photoUrl;

    const title = clone.querySelector("h2");
    title.innerHTML = project.title;

    const description = clone.querySelector("p");
    description.innerHTML = project.description;

    projectContainer.appendChild(clone);
}

function createUser(user) {
    const template = document.querySelector("#user-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = user.photoUrl;

    const name = clone.querySelector("label");
    name.innerHTML = user.name;

    userContainer.appendChild(clone);
}

function createGroup(group) {
    const template = document.querySelector("#group-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = group.photoUrl;

    const name = clone.querySelector("label");
    name.innerHTML = group.name;

    groupContainer.appendChild(clone);
}