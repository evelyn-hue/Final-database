document.getElementById("submit").addEventListener("submit", function(event) {

    event.preventDefault()
    const formData = new FormData(this)
    
    fetch("file.php", {
                method: 'POST',
                body: formData   
    })

 alert("Submited Successfully")
    window.location.reload()
})