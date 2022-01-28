function confirmDelete(e){return!0===confirm("All data will be deleted, are you sure?")||(e.preventDefault(),!1)}document.getElementById("deleteButton").addEventListener("click",confirmDelete);
