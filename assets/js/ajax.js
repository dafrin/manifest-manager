// позволяет асинхронно отправить форму и получить rendered (HTML) ответ, таблица и тд
// возвращает Promise
async function ajaxRenderedRequest(url, formData) {
    const result = await fetch(url, {
        method: "POST",
        mode: 'cors',
        cache: 'no-cache',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    });

    return await result.text();
}

// управляет состоянием кнопки. Должна быть настроена структура кнопки. See Readme
function setBtnLoadingState(btn) {
    btn.classList.add("btn-loading");
}

function resetBtnLoadingState(btn) {
    btn.classList.remove("btn-loading");
}

// блюр элементов
function blurElement(element) {
    element.classList.add("blurElement");
}

function unBlurElement(element) {
    element.classList.remove("blurElement");
}

/**
 * Отправляет данные через Ajax
 * @param btnID id кнопки, на которое происходит событие
 * @param resultPlaceholderID id div в который будет помещён результат
 * @param formID id формы, которую надо отправить
 * @param url куда отправлять данные
 * @param thenCB колбэк, которые будет вызван после успешной обработки операции
 * @param finallyCB колбэк, которые будет вызван в любом случае, ошибка или нет
 */
function doAjaxRequest(btnID, resultPlaceholderID, formID, url, thenCB, finallyCB) {
    let btn = document.getElementById(btnID);
    let resultPlaceHolder = document.getElementById(resultPlaceholderID);

    let form = document.getElementById(formID);
    let formData = new FormData(form);

    blurElement(resultPlaceHolder);
    setBtnLoadingState(btn);

    const promise = ajaxRenderedRequest(url, formData);
    promise
        .then((data) => {
            resultPlaceHolder.innerHTML = data;
            if (thenCB !== undefined) {
                thenCB();
            }
        })
        .finally(() => {
            resetBtnLoadingState(btn);
            unBlurElement(resultPlaceHolder);

            if (finallyCB !== undefined) {
                finallyCB();
            }
        });
}

/**
 * На случай только одной кнопки, которая использует форму, но данные надо отобразить более затейливо, чем просто положить в placeHolder
 * @param btnID
 * @param formID
 * @param url
 * @param thenCB
 * @param finallyCB
 */
function doAjaxDataCallback(btnID, formID, url, thenCB, finallyCB) {
    let btn = document.getElementById(btnID);
    setBtnLoadingState(btn);

    let form = document.getElementById(formID);
    let formData = new FormData(form);
    const promise = ajaxRenderedRequest(url, formData);
    promise
        .then((data) => {
            if (thenCB !== undefined) {
                thenCB(data);
            }
        })
        .finally(() => {
            resetBtnLoadingState(btn);

            if (finallyCB !== undefined) {
                finallyCB();
            }
        });
}
