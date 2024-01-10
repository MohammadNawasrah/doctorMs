

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
        $("html").append(`
        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="${Message.modalToken}" tabindex="-1" aria-labelledby="notificationmodalMabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
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
const showAlert = (message, type = 202) => {
    if (typeof Message !== 'undefined')
        Message.addModalMessage(addResponse(type, message), 1500)
    else
        alert(message)
}
const addResponse = (statusData, messageData) => {
    return { status: statusData, message: messageData }
}
const ajax = (options = {}) => {

    const send = (options) => {
        $.ajax({
            url: options.URL,
            type: options.METHOD,
            data: options.DATA,
            success: function (response) {
                response = JSON.parse(response);
                if (options.showAlert === true) {
                    showAlert(response.message, response.status);
                }
                if (options.callBackFunction)
                    options.callBackFunction(response);
            },
            error: function (xhr, textStatus, errorThrown) {
                showAlert(202, errorThrown);
            }
        });
    };

    const getFormData = (FORMID) => {
        let selectedForm = $(`#${FORMID}`);
        let inputs = selectedForm.find('[name]');
        let data = {};

        $.each(inputs, (index, value) => {
            let inputName = $(value).attr("name");
            let inputValue = $(value).val();

            if (data[inputName]) {
                // If the key already exists, treat it as an array
                if (!Array.isArray(data[inputName])) {
                    // If it's not already an array, convert it
                    data[inputName] = [data[inputName]];
                }
                // Push the new value to the array
                data[inputName].push(inputValue);
            } else {
                // If the key doesn't exist, create a new entry
                data[inputName] = inputValue;
            }
        });

        return data;
    };

    if (options.FORMID) {
        const FORM = $(`#${options.FORMID}`);
        options.URL = FORM.prop("action");
        options.METHOD = FORM.prop("method");
        options.DATA = getFormData(options.FORMID);
    }
    if (!options.URL) {
        showAlert("Please Add FORM ID or URL");
        return;
    }
    if (!options.METHOD) {
        showAlert("Please Add FORM ID or METHOD");
        return;
    }
    if (options.functionBeforSend) {
        options.functionBeforSend();
    }
    if (!options.FORMID) {
        send(options);
        return;
    }

    $(document).off("submit", `#${options.FORMID}`);
    $(document).on("submit", `#${options.FORMID}`, function (event) {
        event.preventDefault();
        send(options);
    });
};
