@extends('layouts.dashboard')

@section('title', 'Users')

@section('content')

<style>
    #addUserMessage {
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<script src="/js/users.js"></script>
<main role="main" class="col-9">

    <div class="container mt-5  ">
        <div class="row justify-content-center ">
            <div class="col-md-8  ">
                <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
                    <!-- ====================================================================================== -->
                    <div class="modal fade" id="addPermissionToUserModal" tabindex="-1" aria-labelledby="addPermissionToUserModalModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPermissionToUserModalModalLabel">Choose Permission For Users</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                    </div>
                                    <div class="mb-3" style="display: flex;flex-direction: column;justify-content: center; align-items: center;">
                                        <select class="form-select" id="pagesNamePermission" aria-label="Default select example" required>
                                        </select>
                                    </div>
                                    <div class="row mt-2" id="actionsPermissionForUsers" style="display: flex;flex-direction: column;justify-content: center; align-items: center;">
                                    </div>
                                    <div id="savePermissionToUserMessage" class="alert d-none" role="alert">
                                    </div>
                                    <div class="centerPage">
                                        <div>
                                            <div>
                                                <button type="button" id="savePermissionToUser" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" tabindex="-1" role="dialog" id="deleteUserModal" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteUserModalLabel">are you sure to delete ??</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="centerPage">
                                    <div>
                                        <div>
                                            <button type="button" id="deleteUser" class="btn btn-danger m-3">Delete User</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ===================================================================================== -->
                    <div class="row" style="justify-content: space-between;display: flex; margin: 20px;">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addUserType">
                            Add Users Type
                        </button>
                        <div data-permission="addUser" style="justify-content: center;display: flex;">

                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addUserType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserTypeLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserTypeLabel">Add User Type</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="userType" class="form-control" placeholder="write the type user">
                                </div>
                                <div class="modal-footer centerPage">
                                    <div class="">
                                        <div>
                                            <div>
                                                <button type="button" id="addNewUserType" class="btn btn-success">Save</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="d-flex mb-3"style=" justify-content: center; align-items: center;">
                    <input class="form-control" style="width: 90%;" type="search" id="searchInput" placeholder="Search" aria-label="Search" oninput="performSearch()">
                </form>
                    <div class="container" style="height: 500px;overflow-y: scroll;">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead class="table-bordered-custom">
                                    <tr>
                                        <th scope="col" class="col-4" style="padding-left: 5%;">Name</th>
                                        <th scope="col" class="col-3" style="padding-left: 5%;">Events</th>
                                    </tr>
                                </thead>
                                <tbody data-permission="usersTableShow" id="usersTableBody">
                                    <!-- fill from ajax -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on("click", "#addUserButtonModal", function() {
            var settings = {
                "url": baseUrl() + "/dashboard/users/getUsersType",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                }
            };
            $.ajax(settings).done(function(response) {
                response = JSON.parse(response)
                var options = "";
                if (response.status === 200) {
                    response.types.forEach((element, index) => {
                        options += '<option value=' + element.id + '>' + element.type + "</option>";
                    });
                    $('#usersType').html(options)
                }
            })
        })

        $(document).on("click", "#addNewUserType", function() {
            var selectedButton = $(this)
            var settings = {
                "url": baseUrl() + "/dashboard/users/user/type/add",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                },
                "data": JSON.stringify({
                    "type": $("#userType").val(),
                }),
            };
            Loader.addLoader(selectedButton)
            $.ajax(settings).done(function(response) {
                response = JSON.parse(response)
                console.log(response)
                if (response.status === 200) {
                    Message.addMessage(response.message, selectedButton, "success");
                    setTimeout(() => {
                        Loader.removeLoader();
                        $(".close").trigger("click")
                    }, 1000);
                    return;
                }
                Loader.removeLoader();
                Message.addMessage(response.message, selectedButton, "danger");
            })
        })
    })
</script>
@endsection
