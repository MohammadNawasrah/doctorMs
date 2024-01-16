@extends('layouts.dashboard')

@section('title', 'Htmo Code Page')

@section('content')
<style>
    textarea {
        width: 850px;
        height: 500px;
    }
</style>


<main role="main" style="display: flex;justify-content: center;align-items: start; margin-top: 5%;" class="col">
    <main role="main" class="col">
        <select name="" id="selectActionName">
            <option value="0">Select Action Name</option>
        </select>
        <div class="mt-5 pt-4" id="htmlCode"></div>
    </main>
    <div style="width: 120px; display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;">
        <div>
            <button class="btn btn-success" id="saveChangeHtml">save chenges</button>
        </div>
    </div>
</main>
<script>
    $(function() {
        Loader.removeLoadPage();

        const getAllHtmlCode = () => {
            ajax({
                URL: HtmlCodePage.getAllHtmlCode,
                METHOD: "POST",
                callBackFunction: (response) => {
                    if (response.status == 200) {
                        var data = response.data;
                        var selectPageName = $('#selectActionName');
                        var htmlCode = $('#htmlCode');
                        data.forEach(htmlCodeApi => {
                            selectPageName.append(` <option value="${htmlCodeApi["actionName"]}">${htmlCodeApi["actionName"]}</option>`)
                            htmlCode.append(`<textarea   class="d-none htmlCodeEdit" data-select="${htmlCodeApi["actionName"]}"></textarea>`)
                            $(`[data-select="${htmlCodeApi["actionName"]}"]`).text(htmlCodeApi["html_code"]);
                        })
                    }
                }
            });
        }

        function onChangeActionSelectBox() {
            $(document).on("change", "#selectActionName", function() {
                $("textarea ").addClass("d-none")
                $(`[data-select="${$(this).val()}"]`).removeClass("d-none")
            })
        }
        const SaveChangeHtmlCode = () => {
            $(document).on("click", "#saveChangeHtml", function() {
                dataToSend = {}
                $(".htmlCodeEdit").each((index, element) => {
                    dataToSend[$(element).data("select")] = $(element).val();
                });
                ajax({
                    URL: HtmlCodePage.updateHtmlCode,
                    METHOD: "POST",
                    DATA: {
                        jsonData: dataToSend
                    },
                    showAlert: true,
                    callBackFunction: (response) => {
                        if (response.status === 200)
                            fetchAllPermissionDashboard();
                    }
                });
            });
        }
        getAllHtmlCode();
        onChangeActionSelectBox();
        SaveChangeHtmlCode();

        // $(document).on("click", "#saveChangeHtml", function() {
        //     dataToSend = {}
        //     $(".htmlCodeEdit").each((index, element) => {
        //         dataToSend[$(element).data("select")] = $(element).val();
        //     })
        //     ajax = new AjaxHelper(HtmlCodePage.updateHtmlCode);

        //     var selectButton = $(this);

        //     function doneSaveHtmlChange(response) {
        //         var response = JSON.parse(response);
        //         if (response.status == 200) {
        //             Message.addMessage(response.message, selectButton, "success")
        //             setInterval(() => {
        //                 Loader.removeLoader()
        //                 location.reload();
        //             }, 1000)
        //             return
        //         }
        //         Message.addMessage(response.message, selectButton, "danger")
        //     }
        //     ajax.sendPost({
        //         jsonData: dataToSend
        //     }, [], doneSaveHtmlChange, Loader.addLoader(selectButton));
        // })

    })
</script>
@endsection