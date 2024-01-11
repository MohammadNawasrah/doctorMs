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
<main role="main" class="col">

    <div class="container mt-5  ">
        <div class="row justify-content-center ">
            <div class="col">
<!-- ==================================================================================================================== -->
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
                                    <h5 class="modal-title" id="deleteUserModalLabel">Are You Sure To Delete ?</h5>
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
<!--=================================================== Modal================================================================== -->
                    <div class="modal fade" id="addUserType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserTypeLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add User Type</h5>
                                    <button type="button" class="close" id="addUserTypea" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" id="addNewUserTypeForm" action="users/user/type/add">
                                    <div class="modal-body">
                                        <input type="text" name="type" id="userType" class="form-control" placeholder="write the type user" required>
                                    </div>
                                    <div class="modal-footer centerPage">
                                        <div class="">
                                            <div>
                                                <div>
                                                    <button type="submit" id="addNewUserType" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    })
</script>
<script>
    // Save the original table HTML
    var originalTableHTML = document.getElementById('originalTable').outerHTML;

    function performSearch() {
        var searchInput = document.getElementById('searchInput').value.toLowerCase();
        var tableRows = document.querySelectorAll('#originalTable tbody tr');

        if (searchInput.trim() === '') {
            // If the search input is empty, show all rows in the original table
            tableRows.forEach(function (row) {
                row.style.display = '';
            });
            return;
        }

        tableRows.forEach(function (row) {
            var rowData = row.textContent.toLowerCase();

            if (rowData.includes(searchInput)) {
                row.style.display = ''; // Show the row if it matches the search
            } else {
                row.style.display = 'none'; // Hide the row if it doesn't match the search
            }
        });
    }
</script>
@endsection
