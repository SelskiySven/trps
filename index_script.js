let password_complete = false
let passwordrepeate_complete = false
let login_complete = false
let firstname_complete = false
let lastname_complete = false
let login_does_not_exists = false

function checkLogin() {
    let login = document.getElementById("registration_login").value
    let checkLogin = new XMLHttpRequest()
    checkLogin.responseType = "document"
    checkLogin.open("GET", "scripts/checklogin.php?login=" + login)
    checkLogin.onload = function () {
        if (checkLogin.response.body.innerText != "0") {
            login_does_not_exists = false
        } else {
            login_does_not_exists = true
        }
        document.getElementById("login_exists").hidden = login_does_not_exists
    }
    checkLogin.send()
}

function onChangePassword() {
    let pass = document.getElementById("registration_password").value
    password_complete = (pass.length > 7 & pass.length < 256)
    document.getElementById("password_hint").hidden = password_complete
}

function onChangePasswordRepeat() {
    let pass = document.getElementById("registration_password").value
    let repeat_pass = document.getElementById("registration_password_repeat").value
    passwordrepeate_complete = (pass == repeat_pass)
    document.getElementById("repeat_password_hint").hidden = passwordrepeate_complete
}

function onChangeLogin() {
    let login = document.getElementById("registration_login").value
    login_complete = (login.length > 3 & login.length < 256)
    document.getElementById("login_hint").hidden = login_complete
}

function onChangeFirstName() {
    let firstname = document.getElementById("registration_first_name").value
    firstname_complete = (firstname != "")
    document.getElementById("first_name_hint").hidden = firstname_complete
}

function onChangeLastName() {
    let lastname = document.getElementById("registration_last_name").value
    lastname_complete = (lastname != "")
    document.getElementById("last_name_hint").hidden = lastname_complete
}

try {
    document.getElementById("registration_submit").addEventListener("click", (e) => {
        onChangeFirstName()
        onChangeLastName()
        onChangeLogin()
        onChangePassword()
        onChangePasswordRepeat()
        checkLogin()
        if (!(login_does_not_exists & password_complete & passwordrepeate_complete & login_complete & firstname_complete & lastname_complete)) {
            e.preventDefault()
        }
    }, false)
} catch (error) {
}

let sort = "ASC"
let limit = 10

function change_limit(newlimit) {
    limit = newlimit + 0
    getTickets(false)
}

function change_sort() {
    if (sort == "ASC") {
        sort = "DESC"
    } else {
        sort = "ASC"
    }
    getTickets(false)
}

function getTickets(check=true) {
    let getData = new XMLHttpRequest()
    getData.responseType = "document"
    getData.open("GET", "xhr/gettickets.php?personal=no&sort=" + sort + "&limit=" + limit)
    getData.onload = function () {
        if (document.getElementById("for_tickets").innerHTML != getData.response.body.innerHTML) {
            if (check){
                document.getElementById("update_xhr").hidden=false
            } else{
                document.getElementById("for_tickets").innerHTML = getData.response.body.innerHTML
            }
        }
    }
    getData.send()
}
getTickets(false)
let check_updates = setInterval(getTickets, 5000)
