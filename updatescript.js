document.getElementById("submit").addEventListener("submit", function(event) {

    event.preventDefault()
    const formData = new FormData(this)
    
    fetch("updateS1.php", {
                method: 'POST',
                body: formData   
    })

 alert("Submited Successfully")
    window.location.href = "table.php";
})