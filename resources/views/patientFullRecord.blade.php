<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <title>Patient Records</title>
  <style>
    /* Add your custom styles here if needed */
    .hover-effect:hover {
      background-color: #0d6efd;
      /*  ÕœÌœ ·Ê‰ «·Œ·›Ì… ⁄‰œ ÂÊ›— */
      color: #fff;
      /*  ÕœÌœ ·Ê‰ «·‰’ ⁄‰œ ÂÊ›— */
      border-color: #0d6efd;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .hover-link:hover {
      background-color: #e3efff;
      /*  ÕœÌœ ·Ê‰ «·Œ·›Ì… ⁄‰œ ÂÊ›— */
      color: #0d6efd;
      /*  ÕœÌœ ·Ê‰ «·‰’ ⁄‰œ ÂÊ›— */
    }

    a {
      color: black;
    }

    p:hover {
      background-color: #e3efff;
      /*  ÕœÌœ ·Ê‰ «·Œ·›Ì… ⁄‰œ ÂÊ›— */
      color: #0d6efd;
      /*  ÕœÌœ ·Ê‰ «·‰’ ⁄‰œ ÂÊ›— */
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
      /* «·ÕÃ„ «·–Ì  —ÌœÂ (20px ◊ 20px ›Ì Â–« «·„À«·) */
    }

    .custom-icons {
      font-size: 60px;
      /* «·ÕÃ„ «·–Ì  —ÌœÂ (20px ◊ 20px ›Ì Â–« «·„À«·) */
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fill the information</h5>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-3">
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
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                  <label for="floatingTextarea">Comments</label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save</button>
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


                <select class="form-select" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

                <div class="card" style="width: 100%;margin-top: 3%; height: 60vh;">


                  <div class="card-body">


                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Download</button>
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
        <form class="d-flex mb-3">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <input class="form-control ms-2 w-50" type="search" placeholder="Search" aria-label="Search">
        </form>
        <!-- ====================================================================================== -->

        <table class="table table-bordered">
          <thead class="table-bordered-custom">
            <tr style="text-align: center;">
              <th scope="col" class="col-1">id</th>
              <th scope="col" class="col-3">Name</th>
              <th scope="col" class="col-2">Nots</th>
              <th scope="col" class="col-2">Photo</th>
              <th scope="col" class="col-4">Events</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td>aseel</td>
              <td>
                <button class="btn btn-secondary w-100" data-toggle="tooltip" data-placement="top" title="Add Nots" data-bs-toggle="modal" data-bs-target="#noteModal"><i class="bi bi-plus"></i></button>

              </td>
              <td>
                <button class="btn btn-warning w-100" data-toggle="tooltip" data-placement="top" title="Photo" data-bs-toggle="modal" data-bs-target="#photoModal"><i class="bi bi-image"></i></button>
              </td>
              <td>
                <div class="row">
                  <div class="col"><button class="btn btn-success w-100" data-toggle="tooltip" data-placement="top" title="Update" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i class="bi bi-arrow-down-up"></i></button>
                  </div>
                  <div class="col"><button class="btn btn-danger w-100" data-toggle="tooltip" data-placement="top" title="Delete" data-bs-toggle="modal" data-bs-target="#Modal"><i class="bi bi-trash"></i></button>
                  </div>

                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- You can retain your existing HTML content here -->
  </main>

  <!-- Bootstrap JS and Popper.js and jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <!-- Your additional scripts can go here -->
</body>

</html>