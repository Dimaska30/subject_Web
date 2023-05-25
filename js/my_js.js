
let current_reaction = [0, 0, 0, 0]
let current_id_article = 0

let Id

// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {

    options = {
        path: '/',
        path: document.URL,
        // при необходимости добавьте другие значения по умолчанию
        ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}

function deleteCookie(name) {
    setCookie(name, "", {
        'max-age': -1
    })
}

const choose = (src, alt, desc) => {
    document.getElementsByClassName('modalDialog_img')[0].src = src
    document.getElementsByClassName('modalDialog_description')[0].innerHTML = alt
    document.getElementsByClassName("modalDialog_img_description")[0].innerHTML = desc
}

const face_grin_squint_tears = (event) => {
    toggle(event.target.classList)
    click_reaction(event.target, 0)
}

const face_smile = (event) => {
    toggle(event.target.classList)
    click_reaction(event.target, 1)
}

const face_frown = (event) => {
    toggle(event.target.classList)
    click_reaction(event.target, 2)
}

const face_sad_tear = (event) => {
    toggle(event.target.classList)
    click_reaction(event.target, 3)
}

const like = (event) => {
    toggle(event.target.classList)
    toggle_like()
}

const share = (event) => {
    copyText(document.URL)
}

const toggle = (list) => {
    list.toggle("fa-regular")
    list.toggle("fa-solid")
}

const disable = (list) => {
    list.add("fa-regular")
    list.remove("fa-solid")
}

const enable = (list) => {
    list.remove("fa-regular")
    list.add("fa-solid")
}

const click_reaction = (el, num) => {
    setReaction(num)
    let custom_e = new CustomEvent("ChangeReaction", {
        bubbles: true,
        detail: { num: num }
    })
    el.dispatchEvent(custom_e)
}

const toggle_like = () => {
    let getLike = toBool(getCookie("like"))
    getLike = !getLike
    let future_date = new Date()
    future_date.setFullYear(future_date.getFullYear() + 5)
    setCookie("like", getLike, { expires: future_date })
}

function getCurrentIDArticle() {
    current_id_article = 1
}

function setReaction(num) {
    current_reaction = [0, 0, 0, 0]
    current_reaction[num] = 1
    let future_date = new Date()
    future_date.setFullYear(future_date.getFullYear() + 5)
    setCookie("reaction", JSON.stringify(current_reaction), { expires: future_date })
}

function getReaction() {
    current_reaction = JSON.parse(getCookie("reaction"))
    let num = current_reaction.indexOf(1)
    children = document.getElementsByClassName("reaction")[0].children[0].children
    for (let i = 0; i < 4; i++)
        if (i == num) {
            let list = children[i].classList
            enable(list)
        }
}


function getLike() {
    let currentLike = toBool(getCookie('like'))
    if (currentLike) {
        let list = document.getElementsByClassName("--red")[0].classList
        enable(list)
    }
}

window.onload = function () {
    getCurrentIDArticle()
    if(data_base_reaction == "None"){
        getReaction()
    }else{
        if (data_base_reaction == "lol") {
            setReaction(0)
        }
        if (data_base_reaction == "smile") {
            setReaction(1)
        }
        if (data_base_reaction == "sad") {
            setReaction(2)
        }
        if (data_base_reaction == "cry") {
            setReaction(3)
        }
    }
    if(data_base_like =="fa-regular") {
        getLike()
    }else {
        toggle_like()
    }
    
    document.getElementsByClassName("reaction")[0].addEventListener("ChangeReaction", (event) => {
        console.log("Hi")
        children = document.getElementsByClassName("reaction")[0].children[0].children
        for (let i = 0; i < 4; i++)
            if (i != event.detail.num) disable(children[i].classList)
    }
    )
}

const toBool = (value) => {
    if (value === 'true')
        return true;
    else return false;
}

const push = (id) => {
    location.hash = "#" + id;
    Id = setTimeout(() => {
        location.hash = "#close"
    }, 15000)
}

function copyText(text) {
    if (!navigator.clipboard) {
        alert("OOOOPS!...")
        push("errorCopy")
        return;
    }
    navigator.clipboard.writeText(text).then(function () {
        console.log('Async: Copying to clipboard was successful!')
        push("successCopy")
    }, function (err) {
        console.error('Async: Could not copy text: ', err)
        push("errorCopy")
    });
}
