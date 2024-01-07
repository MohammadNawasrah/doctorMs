@extends('layouts.dashboard')

@section('title', 'Htmo Code Page')

@section('content')
<main class="col">

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
                                            <th scope="col" class="col-4" style="padding-left: 5%;">Name</th>
                                            <th scope="col" class="col-4" style="padding-left: 5%;">Time and Date</th>
                                            <th scope="col" class="col-5" style="padding-left: 5%;">Events</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td style="padding-left: 5%;">aseel</td>
                                            <td style="padding-left: 5%;">aseel</td>
                                            <td>
                                                <button class="btn btn-primary" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Modify appointments"><i class="bi bi-pen"></i></button>
                                                <button class="btn btn-success" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="send" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-arrow-right"></i></button>
                                                <button class="btn btn-danger" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="Delete appointment" data-bs-toggle="modal" data-bs-target="#Modal"><i class="bi bi-calendar-check"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td style="padding-left: 5%;">nawasrah</td>
                                            <td style="padding-left: 5%;">nawasrah</td>
                                                <td>
                                                <button class="btn btn-primary" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Modify appointments"><i class="bi bi-pen"></i></button>
                                                <button class="btn btn-success" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="send" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-arrow-right"></i></button>
                                                <button class="btn btn-danger" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="Delete appointment" data-bs-toggle="modal" data-bs-target="#Modal"><i class="bi bi-calendar-check"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td style="padding-left: 5%;">naeem</td>
                                            <td style="padding-left: 5%;">naeem</td>
                                                <td>
                                                <button class="btn btn-primary" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Modify appointments"><i class="bi bi-pen"></i></button>
                                                <button class="btn btn-success" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="send" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-arrow-right"></i></button>
                                                <button class="btn btn-danger" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="Delete appointment" data-bs-toggle="modal" data-bs-target="#Modal"><i class="bi bi-calendar-check"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td style="padding-left: 5%;">ali</td>
                                            <td style="padding-left: 5%;">ali</td>
                                            <td>
                                                <button class="btn btn-primary" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Modify appointments"><i class="bi bi-pen"></i></button>
                                                <button class="btn btn-success" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="send" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-arrow-right"></i></button>
                                                <button class="btn btn-danger" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="Delete appointment" data-bs-toggle="modal" data-bs-target="#Modal"><i class="bi bi-calendar-check"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td style="padding-left: 5%;">Ahmad</td>
                                            <td style="padding-left: 5%;">Ahmad</td>
                                                <td>
                                                <button class="btn btn-primary" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Modify appointments"><i class="bi bi-pen"></i></button>
                                                <button class="btn btn-success" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="send" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-arrow-right"></i></button>
                                                <button class="btn btn-danger" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="Delete appointment" data-bs-toggle="modal" data-bs-target="#Modal"><i class="bi bi-calendar-check"></i></button>
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
</main>

@endsection
