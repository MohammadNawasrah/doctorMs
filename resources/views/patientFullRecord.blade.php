<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap5.3.0/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap5.3.0/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <title>Dashboard</title>
    <style>
        /* Add your custom styles here if needed */
        .hover-effect:hover {
            background-color: #0d6efd ; /* تحديد لون الخلفية عند هوفر */
            color: #fff; /* تحديد لون النص عند هوفر */
            border-color:#0d6efd;
            box-shadow:  0 0 10px rgba(0, 0, 0, 0.5);
        }
        .hover-link:hover{
            background-color: #e3efff ; /* تحديد لون الخلفية عند هوفر */
            color: #0d6efd; /* تحديد لون النص عند هوفر */
        }
        a{
            color: black;
        }
        p:hover{
            background-color: #e3efff ; /* تحديد لون الخلفية عند هوفر */
            color: #0d6efd; /* تحديد لون النص عند هوفر */
        }
        p{
            color: black;
        }

        .menu-active{
        color: #0d6efd;
        border-right: 7px solid #0d6efd;
        }
        .btn-blue{
           background-color: #b7d4fa;
           color: #0d6efd;
        }
        .custom-icon {
      font-size: 20px; /* الحجم الذي تريده (20px × 20px في هذا المثال) */
    }
        .custom-icons {
      font-size: 60px; /* الحجم الذي تريده (20px × 20px في هذا المثال) */
    }
    .table-bordered-custom {
            border-bottom: 2px solid #0A76D8;
        }
        .p-active{
            color:#0d6efd ;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;" class="m-4">Records page</h1>
            <!-- Main Content -->
            <main role="main" class="col">
                <!-- Content Goes Here -->
                <div class="container mt-5  ">
                    <div class="row justify-content-center ">
                        <div class="col">
                            <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;" >
                                <!-- ====================================================================================== -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Fill the information</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form><div class="mb-3">
                                                <div class="row">
                                                <div class="col">

                                                    <input type="text" class="form-control " id="inputField1" placeholder="First Name" required>
                                                </div>

                                                <div class="col">
                                                  <input type="text" class="form-control " id="inputField1" placeholder="Last Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                  <input type="text" class="form-control" id="inputField1" placeholder="User Name" required>
                                                  </div>
                                                  <div class="col">

                                                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                                                </div>
                                            </div>
                                        </div>
                                                <div class="mb-3">
                                                    <select class="form-select" aria-label="Default select example" required>
                                                        <option selected>Choose an account </option>
                                                        <option value="1">Admin</option>
                                                        <option value="2">User</option>
                                                      </select>
                                                </div>
                                                <div class="row">
                                                <div class="col">

                                                    <input type="password" class="form-control mb-3" id="password" placeholder="Enter your password" required>
                                                  </div>

                                                  <div class="col">

                                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
                                                  </div>
                                                </div>
                                                  <label class="form-check-label" for="switch">Status</label>
                                                <div class="mb-3 form-check form-switch">
                                                  <input class="form-check-input" type="checkbox" id="switch">
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                                              </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- ===================================================================================== -->
                                                                <!-- ==========================================delete modal============================================ -->


  <!-- Modal -->
  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
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
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
<!-- ====================================================================================== -->

                                    <table class="table table-bordered">
                                    <thead class="table-bordered-custom">
                                        <tr>
                                            <th scope="col" class="col-1" style="padding-left: 5%;">id</th>
                                            <th scope="col" class="col-4" style="padding-left: 5%;">Note</th>
                                            <th scope="col" class="col-4" style="padding-left: 5%;">Time and Date</th>
                                            <th scope="col" class="col-5" style="padding-left: 5%;">Events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" rows="3"></textarea></td>
                                            <td style="padding-left: 5%;">aseel</td>
                                            <td>
                                                <button class="btn btn-primary" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="view image"><i class="bi bi-file-image"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- You can retain your existing HTML content here -->
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Your additional scripts can go here -->
</body>
</html>
</body>

</html>