

class GetAllHmtlCode {
    static $
    static get(selectButton) {
        GetAllHmtlCode.selectButton = selectButton
        let ajaxHelper = new AjaxHelper(HtmlCodePage.getAllHtmlCode);
        ajaxHelper.sendPost({}, [], (response) => GetAllHmtlCode.onResponse(response))
    }
    static onResponse(response) {
        response = JSON.parse(response);
        if (response.status == 200) {
            var data = response.data;
            var selectPageName = GetAllHmtlCode.$('#selectActionName');
            var htmlCode = GetAllHmtlCode.$('#htmlCode');
            data.forEach(htmlCodeApi => {
                selectPageName.append(` <option value="${htmlCodeApi["actionName"]}">${htmlCodeApi["actionName"]}</option>`)
                htmlCode.append(`<textarea   class="d-none htmlCodeEdit" data-select="${htmlCodeApi["actionName"]}"></textarea>`)
                $(`[data-select="${htmlCodeApi["actionName"]}"]`).text(htmlCodeApi["htmlCode"]);
            })
        }
    }
}

$(function () {
    GetAllHmtlCode.$ = $;
    GetAllHmtlCode.get($(this));
    function onChangeActionSelectBox() {
        $(document).on("change", "#selectActionName", function () {
            $("textarea ").addClass("d-none")
            $(`[data-select="${$(this).val()}"]`).removeClass("d-none")
        })
    }
    onChangeActionSelectBox();
    $(document).on("click", "#saveChangeHtml", function () {
        dataToSend = {}
        $(".htmlCodeEdit").each((index, element) => {
            dataToSend[$(element).data("select")] = $(element).val();
        })
        ajax = new AjaxHelper(HtmlCodePage.updateHtmlCode);

        var selectButton = $(this);

        function doneSaveHtmlChange(response) {
            var response = JSON.parse(response);
            if (response.status == 200) {
                Message.addMessage(response.message, selectButton, "success")
                setInterval(() => {
                    Loader.removeLoader()
                    location.reload();
                }, 1000)
                return
            }
            Message.addMessage(response.message, selectButton, "danger")
        }
        ajax.sendPost({
            jsonData: dataToSend
        }, [], doneSaveHtmlChange, Loader.addLoader(selectButton));
    })

})