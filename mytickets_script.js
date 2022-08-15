function getTickets() {
    let getData = new XMLHttpRequest()
    getData.responseType = "document"
    getData.open("GET", "xhr/gettickets.php?personal=yes")
    getData.onload = function () {
        if (document.getElementById("for_tickets").innerHTML != getData.response.body.innerHTML) {
            document.getElementById("for_tickets").innerHTML = getData.response.body.innerHTML
        }
    }
    getData.send()
}

getTickets()
let check_updates = setInterval(getTickets, 5000)