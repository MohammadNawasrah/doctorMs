
class Loader {
    static token;
    static HtmlCodButton;
    static buttonId;
    static addLoader(button) {
        Loader.getButtonString(button);
        Loader.token = "setUniqerMosdlkfjDDFasdfjkl4349843f";
        var loader = `
        <img id="${Loader.buttonId}" width="50" src="//[::1]:5173/resources/image/loading.gif" alt="">
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
}
class Message {
    static token;
    static addMessage(messageText, button, type) {

        Message.token = "setUniqerMosdlkfjDDFasfideruioutrdfjkl4349843f";
        var messageToken = $(`#${Message.token}`);

        if (messageToken.length === 0) {
            $(`<div class="alert alert-${type}" style="height: 30px;
            display: flex;width: 250px;
            justify-content: center;
            align-items: center;" id="${Message.token}">${messageText}</div>`).insertBefore($(`#${button.attr("id")}`).parent())

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

}