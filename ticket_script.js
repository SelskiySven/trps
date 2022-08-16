function send_message() {
    let message = document.getElementById("new_message").value
    document.getElementById("new_message").value = ""
    message=message.replaceAll("\n","<br>")
    if (message != "") {
        let ticket_id = document.getElementById("ticket_id").getAttribute("ticket_id")
        let sendMessage = new XMLHttpRequest()
        sendMessage.open("GET", "scripts/createmessage.php?message='" + message + "'&ticket=" + ticket_id)
        sendMessage.onload = get_messages
        sendMessage.send()
    }
}

function get_messages() {
    let ticket_id = document.getElementById("ticket_id").getAttribute("ticket_id")
    let getMessage = new XMLHttpRequest()
    getMessage.responseType = "document"
    getMessage.open("GET", "xhr/getmessages.php?id=" + ticket_id)
    getMessage.onload = function () {
        if (document.getElementById("for_messages").innerHTML != getMessage.response.body.innerHTML) {
            document.getElementById("for_messages").innerHTML = getMessage.response.body.innerHTML
        }
    }
    getMessage.send()
}
get_messages()
let update_messages = setInterval(get_messages,5000)

document.addEventListener( 'keydown', event => {
    if (event.key == "Enter" & !event.shiftKey){
        send_message()
    }
  });