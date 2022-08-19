if (page == 1) {
    document.getElementById("prev_page").disabled = true
}
if (page == maxpage) {
    document.getElementById("next_page").disabled = true
}

function reload() {
    window.location = "rolesettings.php?page=" + page + "&limit=" + limit + "&sort=" + sort + "&sorttype=" + sorttype + "&search=" + search
}
function page_plus() {
    page += 1
    reload()
}
function page_minus() {
    page -= 1
    reload()
}
function go_to_page() {
    page = document.getElementById("input_page").value
    reload()
}
function update_limit(value) {
    limit = value + 0
    reload()
}
function search_by_name() {
    search = document.getElementById("search_user").value
    reload()
}
function change_sort(value) {
    if (sort == value) {
        change_sort_type()
    } else {
        sort = value + ""
        reload()
    }
}
function change_sort_type() {
    if (sorttype == "ASC") {
        sorttype = "DESC"
    } else {
        sorttype = "ASC"
    }
    reload()
}
function show_button(id) {
    document.getElementById("save_button_" + id).hidden = false
}
function change_role(id) {
    let support = 0 + document.getElementById("support_checkbox_" + id).checked
    let admin = 0 + document.getElementById("admin_checkbox_" + id).checked
    let root = 0 + document.getElementById("root_checkbox_" + id).checked
    let changeRole = new XMLHttpRequest()
    changeRole.open("GET", "scripts/changerole.php?id=" + id + "&support=" + support + "&admin=" + admin + "&root=" + root)
    changeRole.send()
    document.getElementById("save_button_" + id).hidden = true
}