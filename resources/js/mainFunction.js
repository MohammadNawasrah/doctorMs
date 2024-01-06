
class Loader {
    static token;
    static htmlCodeButton;
    static buttonId;
    static addLoader(button) {
        Loader.getButtonString(button);
        Loader.token = "setUniqerMosdlkfjDDFasdfjkl4349843f";
        var loader = `<img width="50" src="//[::1]:5173/resources/image/loading.gif" alt="">`
        $(`#${Loader.buttonId}`).parent().first().addClass(Loader.token)
        $(`.${Loader.token}`).html(loader);
    }
    static removeLoader() {
        $(`.${Loader.token}`).html(`${Loader.htmlCodeButton}`);
    }
    static getButtonString(button) {
        Loader.htmlCodeButton = button[0].outerHTML
        Loader.buttonId = button.attr("id")
    }
}
class Message {
}