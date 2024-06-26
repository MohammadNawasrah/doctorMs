@extends('layouts.dashboard')

@section('title', 'Users')

@section('content')
<script src="/js/permission.js"></script>
<!-- Main Content -->
<main role="main" style="display: flex;justify-content: center;align-items: start; margin-top: 5%;" class="col">
    <main role="main" class="col">
        <!-- Content Goes Here -->
        <div class="container">

            <div class="row justify-content-center ">
                <div class="col">
                    <div class="container table-container">
                        <!-- ====================================================================================== -->
                        <div class="row mb-5">
                            <div class="col" data-permission="addAction" style="display: flex;justify-content: center;">

                            </div>
                            <div class="col" data-permission="addPermission" style="display: flex;justify-content: center;">

                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="search-box">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search..." oninput="filterTable()">
                        </div>
                        <!-- ====================================================================================== -->
                        <div class="container" data-permission="showPermission" style="max-height: 60vh; overflow-y: auto;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- You can retain your existing HTML content here -->
    </main>

</main>

<!-- Bootstrap JS and Popper.js and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script>
    const whenPermissionPageLoad = () => {
        ajax({
            URL: Permissions.getHtmlByPermission,
            METHOD: "POST",
            callBackFunction: response => {
                data = response.data;
                data.forEach(permission => {
                    let keys = Object.keys(permission)
                    keys.forEach(element => {
                        $(`[data-permission=${element}]`).append(permission[element])
                    });
                })
            }
        });
    }
</script>
<script>
    var permissions;
    var pagesName;
    $(function() {
        function fetchPermission() {
            var settings = {
                "url": Permissions.getAllPermission,
                "method": "GET",
                "timeout": 0,
            };
            $.ajax(settings).done(function(response) {
                const permissionTableBody = $("#permissionTableBody");
                permissionTableBody.html("");
                response = JSON.parse(response)
                Loader.removeLoadPage();
                if (response.status === 200) {
                    permissions = JSON.parse(response.data.jsonPermission);
                    pagesName = Object.keys(permissions)
                    pagesName.forEach(element => {
                        $("#PageNameToAddAction").append(` <option value="${element}">${element}</option>`);
                    })
                    pagesName.forEach(pageName => {
                        actionsName = Object.keys(permissions[pageName])
                        pageNameSelectOptions = "";
                        actionsName.forEach(actionName => {
                            pageNameSelectOptions += ` <option value="${actionName}">${actionName}</option>`;
                        })

                        permissionTableBody.append(`
                        <tr>
                            <td style="text-align: center;">${pageName}</td>
                            <td style="display: flex;justify-content: space-evenly;">
                                <select style="width: 200px;" class="form-select" aria-label="Default select example">
                                ${pageNameSelectOptions}
                                </select>
                            </td>
                        </tr>
                            `)
                    });
                    return;
                }
                permissionTableBody.append(`

                <tr>
                <td colspan="2" >
                <div style="display:flex;justify-content:center">
                ${response.message}
                </div>
                </td>
                </tr>
                `)
            });
        }
        fetchPermission();

        $(document).on("click", "#addPermissionInput", function() {
            const actionInput = $("#permissionInputs");
            actionInput.append(`  <input type="text" class="form-control mb-3 " id="inputField1" placeholder="Action Name" required>`);
        })
        $(document).on("click", "#removePermissionInput", function() {
            const actionInput = $("#permissionInputs input").last();
            actionInput.remove();
        })

        $(document).off("click", "#addPermission");
        $(document).on("click", "#addPermission", function() {
            pageName = $("#PageNameToAddPermission").val();
            actionInputs = $("#permissionInputs").children()
            actionValue = [];
            actionInputs.each(function() {
                if ($(this).val() !== "") {
                    actionValue.push($(this).val())
                }
            })
            const resultActionObject = {};
            actionValue.forEach((element) => {
                resultActionObject[element] = 0;
            });
            const resultPermissionObject = {};
            resultPermissionObject[pageName] = resultActionObject;
            var settings = {
                "url": Permissions.addPermission,
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                    "Cookie": "laravel_session=eyJpdiI6InQwL1RqVFRNUkdRR2hkY0U5NFh0Rmc9PSIsInZhbHVlIjoiR1RKNXd5ellscU1iVzhkZnpnV1VkWHExeThFK1JVSnhZcHFzQmdxV3NKY2dYbzJMMFVPUEVLS1EwMzluM3pFR3ZGL0RVc3NxSVo4dThCcmN1VEZlK216RThHUEp3dVM1NUdMNE1HbjkrdzhSWkRIRDkzREx6dW52S0NoTE1QWG8iLCJtYWMiOiI5ZWY1NDAyMmZjMzM0YjM2YTJhYmYyODM4ZWY3M2FhOGI1MzU5MGQwMTI3NThjNWU3NTEzYWVkMDg5NzQ0N2Q2IiwidGFnIjoiIn0%3D"
                },
                "data": JSON.stringify({
                    "userId": "1",
                    "jsonPermission": resultPermissionObject
                }),
            };
            selectedButton = $(this)
            Loader.addLoader(selectedButton)
            $.ajax(settings).done(function(response) {
                response = JSON.parse(response)
                if (response.status === 200) {
                    Message.addMessage(response.message, selectedButton, "success");
                    setTimeout(() => {
                        Loader.removeLoader();
                        $(".close").trigger("click")
                        fetchPermission();
                    }, 1000);
                    return;
                }
                Loader.removeLoader();
                Message.addMessage(response.message, selectedButton, "danger");
            });
        })

        $(document).off("click", "#addActionToPageName");
        $(document).on("click", "#addActionToPageName", function() {
            pageNameFromSelectBox = $("#PageNameToAddAction").val();
            actionInputs = $("#actionInputs").children()
            actionValue = [];
            actionInputs.each(function() {
                if ($(this).val() !== "") {
                    actionValue.push($(this).val())
                }
            })
            const resultActionObject = {};
            actionValue.forEach((element) => {
                resultActionObject[element] = 0;
            });
            var settings = {
                "url": Permissions.addNewActionForPagePermission,
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                },
                "data": JSON.stringify({
                    "pageName": pageNameFromSelectBox,
                    "actions": resultActionObject
                }),
            };
            selectedButton = $(this)
            Loader.addLoader(selectedButton)
            $.ajax(settings).done(function(response) {
                response = JSON.parse(response)
                if (response.status === 200) {
                    Message.addMessage(response.message, selectedButton, "success");
                    setTimeout(() => {
                        Loader.removeLoader();
                        $(".close").trigger("click")
                        fetchPermission();
                    }, 1000);
                    return;
                }
                Loader.removeLoader();
                Message.addMessage(response.message, selectedButton, "danger");
            });
        })

    })
</script> -->
@endsection