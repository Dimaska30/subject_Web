function search() {
    let text = document.forms[0].text_search.value
    let type = document.forms[0].type_search.value

    if(type=="tag"){
        window.location.replace(`/INFOgrapics/search.php?type=2&tagName=${text}`);
    } else {
        window.location.replace(`/INFOgrapics/search.php?type=3&title=${text}`);
    }
    
}