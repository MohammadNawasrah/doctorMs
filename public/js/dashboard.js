$(function () {
    toActiveLinks();
    fetchAllPermissionDashboard();
    const getImageProfile = () => {
        ajax({
            URL: baseUrl() + "/dashboard/image/profile/getUserProfileImage",
            METHOD: "GET",
            callBackFunction: (response) => {
                if (response.status === 200)
                    $("#userProfileImage").attr("src", response.message)
            }
        });
    }
    const showSettingsModal = () => {
        $(document).on("click", "#settingsButton", () => {
            $("#photoModal").modal("show");
        })
    }
    const uploadImage = () => {
        $(document).on("click", "#uplodeImage", () => {
            var form = new FormData();
            form.append("file", $("#profileImage")[0].files[0]);
            form.append("userName", sessionStorage.getItem("userName"))
            ajax({
                URL: baseUrl() + "/dashboard/image/profile/add",
                DATA: form,
                METHOD: "POST",
                fileUp: true,
                showAlert: true,
                callBackFunction: (response) => {
                    window.location.reload();
                }
            });
        })
    }
    showSettingsModal();
    getImageProfile();
    uploadImage();
})
function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        tds = tr[i].getElementsByTagName("td");
        for (var j = 0; j < tds.length; j++) {
            td = tds[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}