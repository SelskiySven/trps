function send_message() {
    let message = document.getElementById("new_message").value
    document.getElementById("new_message").blur()
    document.getElementById("new_message").value = ""
    message=message.replaceAll('\n',"\\n")
    message=message.replaceAll('"','\\"')
    message=message.replaceAll("'","\\'")
    message=message.replaceAll("&","%26")
    if (message != "") {
        let ticket_id = document.getElementById("ticket_id").getAttribute("ticket_id")
        let sendMessage = new XMLHttpRequest()
        sendMessage.open("GET", 'scripts/createmessage.php?message="' + message + '"&ticket=' + ticket_id)
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
let update_messages = setInterval(get_messages,10000)

document.addEventListener( 'keydown', event => {
    if (event.key == "Enter" & !event.shiftKey){
        send_message()
    }
  });

function takeTicket(){
    let ticket_id = document.getElementById("ticket_id").getAttribute("ticket_id")
    let take_ticket = new XMLHttpRequest()
    take_ticket.responseType="document"
    take_ticket.open("GET","scripts/taketicket.php?ticket="+ticket_id)
    take_ticket.onload = function(){
        if (take_ticket.response.body.innerHTML=="error"){
            alert(document.getElementById("take_ticket").getAttribute("error"))
        }
        location.href = location.href
    }
    take_ticket.send()
}

function closeTicket(){
    let ticket_id = document.getElementById("ticket_id").getAttribute("ticket_id")
    let close_ticket = new XMLHttpRequest()
    close_ticket.responseType="document"
    close_ticket.open("GET","scripts/closeticket.php?ticket="+ticket_id)
    close_ticket.onload = function(){
        location.href = location.href
    }
    close_ticket.send()
}