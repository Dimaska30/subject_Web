
// Шаблон для статьи
const article_templete = {
    id: -1,
    title: 'Any Title for empty article',
    body:
        `vestibulum sed arcu non odio euismod lacinia at quis risus
      sed vulputate odio ut enim blandit volutpat maecenas volutpat blandit aliquam etiam erat
      velit scelerisque in dictum non consectetur a erat nam at lectus urna duis convallis
      convallis tellus id interdum velit laoreet id donec ultrices tincidunt arcu non sodales
      neque sodales ut etiam sit amet nisl purus in mollis nunc sed id semper risus in hendrerit
      gravida rutrum quisque non tellus orci ac auctor augue mauris augue neque gravida in
      fermentum et sollicitudin ac orci phasellus egestas tellus rutrum tellus pellentesque eu
      tincidunt tortor aliquam nulla facilisi cras fermentum odio eu feugiat pretium nibh ipsum
      consequat nisl vel pretium lectus quam id leo in vitae turpis massa sed elementum tempus
      egestas sed sed risus pretium quam vulputate dignissim suspendisse in est ante in nibh
      mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing commodo elit at
      imperdiet dui`,
    image:
        "./images/placeholder.png",
    mark:
        true
}

// Типа подгруженные с сайта статьи
const favorites = []
for (let i = 0; i < 7; i++) {
    let temp = structuredClone(article_templete)
    temp.id = i
    favorites.push(temp)
}

const leters = []
for (let i = 0; i < 2; i++) {
    let temp = structuredClone(article_templete)
    temp.id = i
    leters.push(temp)
}
const written = []
for (let i = 0; i < 1; i++) {
    let temp = structuredClone(article_templete)
    temp.id = i
    written.push(temp)
}

// Отображение определенного блока
const hiddenBlocks = (value) => {
    const array = document.getElementById("prifile-article-wrapper").children
    for (let i = 0; i < array.length; i++)
        if (value != i + 1)
            array[i].style.display = "none"
        else
            array[i].style.display = "block"
}

// Функция - триггер на изменение отображение блоков
function change_block() {
    hiddenBlocks(document.forms[1].block.value)
}

function appendPost(articleData, class_wrapper, id_template) {
    if (!articleData) return;

    const main = document.getElementById(class_wrapper).getElementsByClassName("articles_block__mini")[0]
    const postNode = composePost(articleData, id_template)

    main.append(postNode)
}

function composePost(articleData, id_template) {
    if (!articleData) return;

    // Обращаемся к шаблону, который создали ранее:
    const template = document.getElementById(id_template)

    // ...и вытаскиваем его содержимое.
    // В нашем случае содержимым будет «скелет» свита, элемент article.
    // Указываем, что нам необходимо его склонировать, а не использовать сам элемент,
    // иначе он изменится сам, и мы не сможем сделать несколько свитов:

    // Из postData получаем всю необходимую информацию:
    const article = template.content.cloneNode(true)

    const { title, body, image, id } = articleData
    // Добавляем соответствующие тексты и числа в нужные места в «скелете»:
    article.querySelector('article').id = id
    article.querySelector('h2').innerText = title
    article.querySelector('p').innerText = body

    article.querySelector('img').src = image



    // Возвращаем созданный элемент,
    // чтобы его можно было добавить на страницу:
    return article
}

function setBlocks(iFavorites, iLeters, iWritten) {
    iFavorites.forEach((value) => {
        appendPost(value, 'favorite_block', 'article_favorite')
    })
    iLeters.forEach((value) => {
        appendPost(value, 'later_block', 'article_leter')
    })
    iWritten.forEach((value) => {
        appendPost(value, 'my_block', 'article_written')
    })
}

function toggle_click(event, type) {
    const ID = event.currentTarget.parentNode.id
    const btn = event.currentTarget
    const array = type == 'like' ? favorites : leters
    let article
    for (let i = 0; i < array.length; i++)
        if (array[i].id == ID) {
            article = array[i]
            break
        }
    article.mark = !article.mark
    btn.classList.toggle('--disable')
    if (type == 'like') {
        btn.firstChild.classList.toggle('fa-heart')
        btn.firstChild.classList.toggle('fa-heart-crack')
    }
    if (type == 'watch') {
        btn.firstChild.classList.toggle('fa-plus')
        btn.firstChild.classList.toggle('fa-minus')
    }
    /* if(article.mark){
        article.mark = false
        btn.firstChild.classList.remove('fa-heart')
        btn.firstChild.classList.add('fa-heart-crack')
        btn.classList.add('--disable')
    }else{
        article.mark = true
        btn.firstChild.classList.remove('fa-heart-crack')
        btn.firstChild.classList.add('fa-heart')
        btn.classList.remove('--disable')
    } */
}

/* function watch(event) {
    const ID = event.currentTarget.parentNode.id
    const btn = event.currentTarget
    let article
    for (let i = 0; i < leters.length; i++)
        if (leters[i].id == ID) {
            article = leters[i]
            break
        }
    article.mark = !article.mark

    btn.classList.toggle('--disable')
} */



window.onload = () => {
    const array = document.forms[1].getElementsByTagName('input')
    for (let i = 0; i < array.length; i++) {
        const elem = array[i]
        elem.addEventListener('change', () => {
            change_block()
        })
    }
    setBlocks(favorites, leters, written)
}