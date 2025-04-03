function searchProduct() {
    let id = document.getElementById("searchInput").value;

    fetch("search.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + id
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            document.getElementById("message").innerText = data.error;
        } else {
            document.getElementById("name").value = data.name;
            document.getElementById("category").value = data.category;
            document.getElementById("price").value = data.price;
            document.getElementById("description").value = data.description;
            document.getElementById("message").innerText = "Product loaded!";
        }
    });
}
function updateProduct() {
    let id = document.getElementById("searchInput").value;
    let name = document.getElementById("name").value;
    let category = document.getElementById("category").value;
    let price = document.getElementById("price").value;
    let description = document.getElementById("description").value;

    fetch("update.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${id}&name=${name}&category=${category}&price=${price}&description=${description}`
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // 🔍 Debugging
        document.getElementById("message").innerText = data.message || data.error;
    })
    .catch(error => console.error("Error:", error));
}
function searchData() {
    let query = document.getElementById("searchInput").value;
    let searchType = document.getElementById("searchType").value;

    fetch(`search.php?query=${query}&type=${searchType}`)
    .then(response => response.json())
    .then(data => {
        let tableBody = document.querySelector("#resultTable tbody");
        tableBody.innerHTML = "";

        data.forEach(row => {
            let tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${row.id}</td>
                <td>${row.name}</td>
                <td>${row.category}</td>
                <td>${row.price}</td>
                <td>
                    <button onclick="editProduct(${row.id})">✏️ Edit</button>
                    <button onclick="deleteProduct(${row.id})">❌ Delete</button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    });
}




function resetForm() {
    document.getElementById("updateForm").reset();
    document.getElementById("message").innerText = "";
}
