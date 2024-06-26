<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <script src="/js/util/mainClass.js"></script>
  <script src="/js/util/route.js"></script>
  <script src="/js/jquery/jquery-3.7.1.min.js"></script>
  <title>Patient Records</title>
  <style>
    /* Add your custom styles here if needed */
    .hover-effect:hover {
      background-color: #0d6efd;
      /* ����� ��� ������� ��� ���� */
      color: #fff;
      /* ����� ��� ���� ��� ���� */
      border-color: #0d6efd;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .hover-link:hover {
      background-color: #e3efff;
      /* ����� ��� ������� ��� ���� */
      color: #0d6efd;
      /* ����� ��� ���� ��� ���� */
    }

    a {
      color: black;
    }

    p:hover {
      background-color: #e3efff;
      /* ����� ��� ������� ��� ���� */
      color: #0d6efd;
      /* ����� ��� ���� ��� ���� */
    }

    p {
      color: black;
    }

    .menu-active {
      color: #0d6efd;
      border-right: 7px solid #0d6efd;
    }

    .btn-blue {
      background-color: #b7d4fa;
      color: #0d6efd;
    }

    .custom-icon {
      font-size: 20px;
      /* ����� ���� ����� (20px � 20px �� ��� ������) */
    }

    .custom-icons {
      font-size: 60px;
      /* ����� ���� ����� (20px � 20px �� ��� ������) */
    }

    .table-bordered-custom {
      border-bottom: 2px solid #0A76D8;
    }

    .p-active {
      color: #0d6efd;
    }
  </style>
</head>

<body>

  <!-- Main Content -->
  <main role="main" class="col">
    <!-- Content Goes Here -->
    <div class="container mt-5  ">
      <div class="row justify-content-center ">
        <!-- ====================================================================================== -->
        <!-- ===================================================================================== -->
        <!-- ==========================================delete modal============================================ -->


        <!-- Modal -->
        <div class="modal fade" id="deleteRecordModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure to delete it?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="deleteRecord" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </div>
        </div>
        <!-- ====================================================================================== -->
        <!-- ==========================================date modal============================================ -->


        <!-- Modal -->
        <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>
                  <input type="datetime-local" class="form-control">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save</button>
              </div>
            </div>
          </div>
        </div>
        <!-- ====================================================================================== -->
        <!-- ==========================================Nots modal============================================ -->


        <!-- Modal -->
        <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body h-50">
                <div class="form-floating">
                  <textarea class="form-control" readonly placeholder="Leave a comment here" id="noteTextArea"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ====================================================================================== -->
        <!-- ==========================================photo modal============================================ -->


        <!-- Modal -->
        <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="height: 50;">


                <select class="form-select" id="imageSelect" aria-label="Default select example">
                  <option selected>select image to show or dowanload or delete</option>
                </select>
                <div>
                  <div id="imageContainer" style="display: flex; justify-content: center; margin: 30px;">
                    <!-- Image will be displayed here -->
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" id="downloadImage">Download</button>
                <button type="button" class="btn btn-danger">Delete</button>
              </div>
            </div>

          </div>
        </div>
        <!-- ====================================================================================== -->
        <!-- ========================================update========================================= -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Update Notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                  <label for="floatingTextarea">Comments</label>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                <button class="btn btn-success" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- ====================================================================================== -->
        <!-- ===================================search============================================== -->
        <h2 class="mb-4" id="name" style="width: 100%; text-align: center;">name</h2>
        <div class=" mb-3" style="display: flex; justify-content: space-between;">
          <div class="text-center">
            <label class="mb-3" for="totalHavePatientPay">Patient Pay</label>
            <input type="text" class="form-control text-center" id="totalHavePatientPay" placeholder="Cash">
          </div>

          <div class="text-center">
            <label class="mb-3" for="totalHavePatientPay ">Patient Have To Pay</label>
            <input type="text" class="form-control text-center" id="patientFullWasPay" placeholder="Total">
          </div>
        </div>
        <!-- ====================================================================================== -->
        <div class="container" style="max-height: 60vh; overflow-y: auto;">
          <table class="table table-bordered">
            <thead class="table-bordered-custom sti">
              <tr style="text-align: center;">
                <th scope="col" class="col-1">id</th>
                <th scope="col" class="col-3">Patient pay</th>
                <th scope="col" class="col-3">Date</th>
                <th scope="col" class="col-2">Nots</th>
                <th scope="col" class="col-2">Photo</th>
                <th scope="col" class="col-4">Events</th>
              </tr>
            </thead>
            <tbody id="patientsRecordBody">
            </tbody>
          </table>
        </div>
        <!-- You can retain your existing HTML content here -->
  </main>

  <!-- Bootstrap JS and Popper.js and jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <!-- Your additional scripts can go here -->
  <script>
    var selecedToken;
    var selectedPhoto;
    var selectedNote;
    $(function() {
      $(document).on("click", "#showNoteModal", function() {
        $("#noteTextArea").val($(this).data("note"))
      })
      $(document).on("click", "#showPhotoModal", function() {
        var settings = {
          "url": baseUrl() + "/dashboard/image/patient/show",
          "method": "POST",
          "headers": {
            "Content-Type": "application/json"
          },
          data: JSON.stringify({
            "patientToken": $(this).data("token"),
            "recordId": $(this).data("photo")
          }),
        };
        $.ajax(settings).done(function(response) {
          response = JSON.parse(response)
          if (response.status === 200) {
            imagesName = response.data[1]
            imagesUrl = response.data[0]
            imagesName.forEach((element, index) => {
              $("#imageSelect").append(`<option value="${imagesUrl[index]}">${element}</option>`)
            });
          }
        });
      })
      $("#imageSelect").on("change", function() {
        // Get the selected image filename
        var selectedImage = $(this).val();

        // Update the image container with the selected image
        $("#imageContainer").html("<img src='" + selectedImage + "' alt='Selected Image'>");
      });
      $("#photoModal").on("hide.bs.modal", function() {
        $("#imageContainer").html("")
      })
      $("#downloadImage").on("click", function() {
        // Get the selected image filename
        if ($("#imageSelect").val() === "select image to show or dowanload or delete") {
          alert("please select image")
          return;
        }
        var selectedImage = $("#imageSelect").val();

        // Create a link with the selected image source and trigger a click to download
        var downloadLink = document.createElement("a");
        downloadLink.href = selectedImage;
        downloadLink.download = $("#imageSelect").text() + ".jpg";
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
      });

      function fetchPatientsHaveDateToday() {
        var currentUrl = window.location.href;

        // Split the URL by "/"
        var urlParts = currentUrl.split("/");

        // Find the part of the URL that contains "record"
        var recordIndex = urlParts.indexOf("record");

        // Extract the token from the next part of the URL
        var token = urlParts[recordIndex + 1];
        var settings = {
          "url": baseUrl() + "/dashboard/patientRecords/record",
          "method": "POST",
          "timeout": 0,
          "headers": {
            "Content-Type": "application/json",
            "Cookie": "laravel_session=eyJpdiI6IlB3eFJLN2RnUmtvRmFVdlhzZ2plcGc9PSIsInZhbHVlIjoiakFEQVNjbjQ0QkZHWmZzbjh6VGJXYWppSExmUVlpSDJnNU55WENhRFIzdklPTW9OZjVGMWRwcnRLNXZnU1Q5dWRoN2NsekNQSWhnWkwwZGlVL2hkOUNQVmcwaGxZQXcyTktpZnYwT0lYdUJhWW5CYmdRWkkxSzlSODBJWjh3QngiLCJtYWMiOiIzYmVjMDk2YjIwMWU4MGRkZTI1M2YwYTczOTI4M2RmZmRhNjYyODA2MWRjNWI5NTVjNzY0M2NkM2MzYTc5MTQ1IiwidGFnIjoiIn0%3D"
          },
          "data": JSON.stringify({
            "patienToken": token
          }),
        };
        $.ajax(settings).done(function(response) {
          response = JSON.parse(response);
          $("#patientsRecordBody").html("");
          if (response.status === 200) {
            $("#totalHavePatientPay").val(response.main.patientFullPay)
            $("#name").text(response.main.name)
            $("#patientFullWasPay").val(response.main.patientFullWasPay)
            $("#patientsRecordBody").html("");
            $("#patientsRecordBody").append(response.data.patientsRecordBody)
          }
          Loader.removeLoadPage();

        });
      }
      fetchPatientsHaveDateToday();
    })
    var selectedRecord;
    var selectdPhotoDirectory;
    var patientToken;
    const deleteRecord = () => {
      $(document).on("click", "#deleteRecord", function() {
        ajax({
          URL: baseUrl() + "/dashboard/patientRecords/record/delete",
          METHOD: "post",
          showAlert: true,
          DATA: {
            "recordId": selectedRecord,
            "PhotoDirectory": selectdPhotoDirectory,
            "patientToken": patientToken,
          },
          callBackFunction: (response) => {
            if (response.status === 200) {
              $(".close").trigger("click");
              if (typeof fetchPatientsHaveDateToday === 'function') {
                fetchPatientsHaveDateToday();
                return
              }
              window.location.reload();
            }
          }
        });
      })
    }
    deleteRecord();
    const openDeleteRecordModal = () => {
      $(document).on("click", "#showDeleteRecordModal", function() {
        selectedRecord = $(this).data("record_id");
        selectdPhotoDirectory = $(this).data("photo")
        patientToken = $(this).data("token")
        $("#deleteRecordModal").modal("show")
      })
    }
    openDeleteRecordModal();
  </script>
</body>

</html>
