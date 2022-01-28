function confirmDelete(e){return!0===confirm("Weet u zeker dat alle gegevens worden gewist?")||(e.preventDefault(),!1)}document.getElementById("deleteButton").addEventListener("click",confirmDelete);
