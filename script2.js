document.getElementById("destroy").addEventListener("submit", function(event){
    event.preventDefault()

    const formData = new FormData(this)

        fetch("table.php", {
            method: 'POST',
            body: formData
        })

            window.location.reload()



})