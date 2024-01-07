

$(function () {
    var settings = {
        "url": HtmlCodePage.getAllHtmlCode,
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Cookie": "laravel_session=eyJpdiI6IldHR2hob2ZMaFM1NWhuMkdrMGRqcXc9PSIsInZhbHVlIjoiQUZheG12eDBlTnJsOUpuelovbDY5a2IrcW1yZ21PaHhwSXJQVTZJT1pNTjczZmgyRkNqOVpaellKQnV3WVJmZGlKZ0tLRTFNRUl2LzN5dzg5L2pYeCtROWpQS3ZLZ1A2SitWODlQc3BnQzhCTlJMTU1McEJlMXl6Nm9IaUl3OVciLCJtYWMiOiJhZTcxMzg5OWQxMmQwNGU0MzlkMDQ4YzIxNWNhM2YzNGYyMWJiNmRmZjEwMTE0N2QzN2IzMTFkMjYwZGQwZWQ3IiwidGFnIjoiIn0%3D"
        },

    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        if (response.status == 200) {
            data = response.data;
            selectPageName = $('#selectActionName');
            htmlCode = $('#htmlCode');
            data.forEach(htmlCodeApi => {
                keys = Object.keys(htmlCode)
                selectPageName.append(` <option value="${htmlCodeApi["actionName"]}">${htmlCodeApi["actionName"]}</option>`)
                htmlCode.append(`<textarea   class="d-none htmlCodeEdit" data-select="${htmlCodeApi["actionName"]}"></textarea>`)
                $(`[data-select="${htmlCodeApi["actionName"]}"]`).text(htmlCodeApi["htmlCode"]);
            })
        }

    });
    $(document).on("change", "#selectActionName", function () {
        $("textarea ").addClass("d-none")
        $(`[data-select="${$(this).val()}"]`).removeClass("d-none")
    })
    $(document).on("click", "#saveChangeHtml", function () {
        dataToSend = {}
        $(".htmlCodeEdit").each((index, element) => {
            dataToSend[$(element).data("select")] = $(element).val();
        })
        var settings = {
            "url": HtmlCodePage.updateHtmlCode,
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
                "Cookie": "laravel_session=eyJpdiI6IldHR2hob2ZMaFM1NWhuMkdrMGRqcXc9PSIsInZhbHVlIjoiQUZheG12eDBlTnJsOUpuelovbDY5a2IrcW1yZ21PaHhwSXJQVTZJT1pNTjczZmgyRkNqOVpaellKQnV3WVJmZGlKZ0tLRTFNRUl2LzN5dzg5L2pYeCtROWpQS3ZLZ1A2SitWODlQc3BnQzhCTlJMTU1McEJlMXl6Nm9IaUl3OVciLCJtYWMiOiJhZTcxMzg5OWQxMmQwNGU0MzlkMDQ4YzIxNWNhM2YzNGYyMWJiNmRmZjEwMTE0N2QzN2IzMTFkMjYwZGQwZWQ3IiwidGFnIjoiIn0%3D"
            },
            data: JSON.stringify({
                jsonData: dataToSend
            })

        };
        var selectButton = $(this);
        Loader.addLoader(selectButton);
        $.ajax(settings).done(function (response) {
            var response = JSON.parse(response);
            if (response.status == 200) {
                console.log(selectButton)
                Message.addMessage(response.message, selectButton, "success")
                console.log(response.message)
                setInterval(() => {
                    Loader.removeLoader()
                    location.reload();
                }, 1000)
                return
            }
            Message.addMessage(response.message, selectButton, "danger")
        });
    })

})