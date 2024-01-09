

class Loader {
    static token;
    static HtmlCodButton;
    static buttonId;
    static pageToken
    static addLoader(button) {
        Loader.getButtonString(button);
        Loader.token = "setUniqerMosdlkfjDDFasdfjkl4349843f";
        var loader = `
        <img id="${Loader.buttonId}" width="50" src="/image/loading.gif" alt="">
        `
        $(`#${Loader.buttonId}`).parent().first().addClass(Loader.token)
        $(`.${Loader.token}`).html(loader);
    }
    static removeLoader() {
        $(`.${Loader.token}`).html(`${Loader.HtmlCodButton}`);
    }
    static getButtonString(button) {
        Loader.HtmlCodButton = button[0].outerHTML
        Loader.buttonId = button.attr("id")
    }
    static addLoadPage = () => {
        Loader.pageToken = "dsklafjlkdsjfklewioudsjflkadsjf";
        $("main").prepend(`
            <div id= "${Loader.pageToken}" style="position: relative;  display: flex;justify-content: center;align-items: center; height: 100vh; z-index: 5; background-color: white;">
                <img src="${UrlData.baseUrl}/image/loading.gif" alt="">
            </div>`)
    }
    static removeLoadPage() {
        $(`#${Loader.pageToken}`).remove();
    }
}
class Message {
    static token;
    static modalToken;
    static addMessage(messageText, button, type) {

        Message.token = "setUniqerMosdlkfjDDFasfideruioutrdfjkl4349843f";
        var messageToken = $(`#${Message.token}`);

        if (messageToken.length === 0) {
            $(`<div class="alert alert-${type}" style="height: 30px;
            display: flex;width: 250px;
            justify-content: center;
            align-items: center;width: max-content;" id="${Message.token}">${messageText}</div>`).insertBefore($(`#${button.attr("id")}`).parent())

            return;
        }
        messageToken.text(messageText)

        if (type === "success") {
            messageToken.addClass("alert-success")
            messageToken.removeClass("alert-danger")
            return
        }
        messageToken.removeClass("alert-success")
        messageToken.addClass("alert-danger")
    }
    static addModalMessage(response, timeToDeleteModal) {
        Message.modalToken = "asdlkfjlkjadslkfjlkdsjaf";
        console.log(Message.modalToken)
        $("html").append(`
        <div class="modal fade" id="${Message.modalToken}" tabindex="-1" aria-labelledby="notificationmodalMabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="margin:10px; display: flex;justify-content: center;align-items: center;">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
        `);
        if (response.status === 200) {
            $(`#${Message.modalToken} .modal-body div`).addClass("alert alert-success")
        } else {
            $(`#${Message.modalToken} .modal-body div`).addClass("alert alert-danger")
        }
        $(`#${Message.modalToken} .modal-body div`).text(response.message)
        $(`#${Message.modalToken}`).modal("show")
        setTimeout(() => {
            $(`#${Message.modalToken}`).modal("hide")
            $(`#${Message.modalToken}`).remove();
        }, timeToDeleteModal)
    }

}
class AjaxHelper {
    url;
    constructor(url) {
        this.url = url;
    }
    mainSettings(data, method, headers) {
        let settings = {};
        if (this.url === "null") {
            alert("Please Add Url")
        }
        settings["url"] = this.url;
        settings["method"] = method;
        if (headers["json"] !== null)
            settings["headers"] = {
                "Content-Type": "application/json",
            }
        if (headers["token"] !== null) {
            settings["headers"] = {
                "XSRF-TOKEN": "eyJpdiI6IjJ0UUFmMVBFNkdCMS94Rm5JeXBVMFE9PSIsInZhbHVlIjoibWNqS1I2MEUzcDZlT0VQRmpNSDhyUHRrWC8vVlM0c3FUQklTS1prOEN5ZlI4N0JNeW5hWFNHTExKNi9kNGU4TVY5M3U5WW5oNTZZSHFSNXBMTEdMSGJETHZTdmRBcTRVKzhWcmU4TGJNdW9ZYWxUTVJ3dW02ZjVtTWtFNXpEL1UiLCJtYWMiOiIzNjNjOWRmZTgwM2ViYzcxZmEzNzhiZmVmOTc3YjMxMjM0ZDc3NjllYzJlNmQ5Y2YxNTEwZGY4YTUxN2UxMWY4IiwidGFnIjoiIn0%3D",
            }
        }
        if (data !== null) {
            settings["data"] = data
        }
        return settings;
    }
    sendPost(data = {}, headers = [], methodOnAjaxResponse, methodBeforAjax) {
        if (typeof methodBeforAjax === 'function') {
            methodBeforAjax();
        }
        $.ajax(this.mainSettings(data, 'POST', headers)).done(response => {
            if (typeof (methodOnAjaxResponse) === "function") {
                methodOnAjaxResponse(response);
            }
        });
    }
    sendGet(data = {}, headers = [], methodOnAjaxResponse, methodBeforAjax) {
        if (typeof methodBeforAjax === 'function') {
            methodBeforAjax();
        }
        $.ajax(this.mainSettings(data, 'Get', headers)).done(response => {
            if (typeof (methodOnAjaxResponse) === "function") {
                methodOnAjaxResponse(response);
            }
        });
    }
}
