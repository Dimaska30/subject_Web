

// Какая страница следующая:
let nextPage = 2

// Если отправили запрос, но ещё не получили ответ,
// не нужно отправлять ещё один запрос:
let isLoading = false

// Если контент закончился, вообще больше не нужно
// отправлять никаких запросов:
let shouldLoad = true

const post = {
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
        "./images/placeholder.png"
  }

// Метод posts возвращает Promise, имитируя асинхронное общение
// между клиентом и сервером («запрос/ответ»).
const server = {
    // Аргумент page — курсор, номер страницы, которую надо загрузить.
    // С этим номером мы определяем, какую порцию контента отправить.
    // В нашем примере порции отличаться не будут, но в жизни
    // курсор бы влиял на то, какой диапазон постов сервер бы доставал из БД.
    posts(page = 1) {
      // В нашем случае, если текущая страница — 5-я,
      // мы считаем, что контент закончился.
      const finished = page >= 5
  
      // Иначе сервер отправляет курсор next.
      // Он указывает, какая страница будет по счёту следующей.
      // Так клиент будет знать, стоит ли ему отправлять запрос
      // за новой порцией контента.
      const next = finished ? null : page + 1
  
      // В качестве постов отправляем массив из 8 объектов post.
      const posts = Array(7).fill(post)
  
      return new Promise((resolve) => {
        // Таймаут имитирует сетевую «задержку».
        setTimeout(() => {
          resolve({ posts, next })
        }, 150)
      })
    },
  }

/*   const response = await server.posts() */

  async function checkPosition() {
    // Нам потребуется знать высоту документа и высоту экрана:
    const height = document.body.offsetHeight
    const screenHeight = window.innerHeight
  
    // Они могут отличаться: если на странице много контента,
    // высота документа будет больше высоты экрана (отсюда и скролл).
  
    // Записываем, сколько пикселей пользователь уже проскроллил:
    const scrolled = window.scrollY
  
    // Обозначим порог, по приближении к которому
    // будем вызывать какое-то действие.
    // В нашем случае — четверть экрана до конца страницы:
    const threshold = height - screenHeight / 4
  
    // Отслеживаем, где находится низ экрана относительно страницы:
    const position = scrolled + screenHeight
  
    if (position >= threshold) {
      // Если мы пересекли полосу-порог, вызываем нужное действие.
      await fetchPosts()
    }
  }

  function throttle(callee, timeout) {
    let timer = null
  
    return function perform(...args) {
      if (timer) return;
  
      timer = setTimeout(() => {
        callee(...args)
  
        clearTimeout(timer)
        timer = null
      }, timeout)
    }
  }

  ;(() => {
    window.addEventListener('scroll', throttle(checkPosition, 250))
    window.addEventListener('resize', throttle(checkPosition, 250))
  })()

  async function fetchPosts() {
    // Если мы уже отправили запрос, или новый контент закончился,
    // то новый запрос отправлять не надо:
    if (isLoading || !shouldLoad) return;
  
    // Предотвращаем новые запросы, пока не закончится этот:
    isLoading = true
  
    const { posts, next } = await server.posts(nextPage)
    appendPost(posts)
  
    // В следующий раз запрашиваем страницу с номером next:
    nextPage = next
  
    // Если мы увидели, что контент закончился,
    // отмечаем, что больше запрашивать ничего не надо:
    if (!next) shouldLoad = false
  
    // Когда запрос выполнен и обработан,
    // снимаем флаг isLoading:
    isLoading = false
  }

  function appendPost(postData) {
    // Если данных нет, ничего не делаем:
    if (!postData) return;
  
    // Храним ссылку на элемент, внутрь которого
    // добавим новые элементы-свиты:
    const main = document.getElementsByClassName('articles_wrapper')[0]
  
    // Используем функцию composePost,
    // которую напишем чуть позже —
    // она превращает данные в HTML-элемент:
    const postNode = composePost(postData)
  
    // Добавляем созданный элемент в main:
    main.append(postNode)
  }

  function composePost(postData) {
    // Если ничего не передано, ничего не возвращаем:
    if (!postData) return
  
    // Обращаемся к шаблону, который создали ранее:
    const template = document.getElementById('template_article')
  
    // ...и вытаскиваем его содержимое.
    // В нашем случае содержимым будет «скелет» свита, элемент article.
    // Указываем, что нам необходимо его склонировать, а не использовать сам элемент,
    // иначе он изменится сам, и мы не сможем сделать несколько свитов:

    let article_wrapper = document.createElement("div")
    article_wrapper.classList.add("articles_block")
  
    // Из postData получаем всю необходимую информацию:

    for(el in postData){
        let article = template.content.cloneNode(true)
        let { title, body, image } = postData[el]
  
        // Добавляем соответствующие тексты и числа в нужные места в «скелете»:
        article.querySelector('h2').innerText = title
        article.querySelector('p').innerText = body

        article.querySelector('img').src = image
        article_wrapper.append(article)
    }

    // Возвращаем созданный элемент,
    // чтобы его можно было добавить на страницу:
    return article_wrapper
  }