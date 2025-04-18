<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NU QUEUE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles/index.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="rounded-end-5 col-4 blue-bg position-fixed">
                <img src="assets/NU_shield.svg" alt="Image" class="img-fluid img_logo"
                    style="max-height: auto; max-width: 40%;">
                <div class="mt-4">
                    <h1 class="fw-bolder text-light text-center">NU LAGUNA</h1>
                    <h4 class="fw-bold text-light text-center">Queueing System</h4>
                </div>

            </div>
            <div class="col-8 p-5 offset-4">
                <h4 class="fst-italic fs-2 pt-5 fw-bold text-center nu_color">WELCOME!</h4>
                <p class="card-text fw-bold mb-1 nu_color text-center fst-italic fs-5">Please select your identity.</p>
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="text-center row mt-5 mx-2" style="margin-bottom: 10rem;">
                        <a href="nulqueue.php" class="btn btn-select-yellow my-3 fw-bold p-4 m-2"
                            onclick="registerGuest()">APPLICANT / GUEST</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exStudent"
                            class="btn btn-select-blue fw-bold p-4 m-2">EXISTING STUDENT</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Header -->
    <!-- <header class="custom-header py-4">
        <div class="mb-1">
            <img src="assets/NU_shield.svg" alt="Image" class="img-fluid ms-3 me-3 float-start"
                style="max-height: auto; max-width: 5rem;">
        </div>
        <div>
            <h1 class="fw-bolder text-light">NU LAGUNA</h1>
            <h5 class="fw-bold text-light">Queueing System</h5>
        </div>

    </header> -->

    <!-- Content -->
    <!-- <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 80vh;">
            <div class="col-sm-6">
                <div class="card p-3 border-dark">
                    <div class="card-body text-center">
                        <h1 class="card-title fw-bolder">WELCOME!</h1>
                        <p class="card-text fw-bold mb-1 nu_color">PLEASE SELECT YOUR IDENTITY</p>
                        <div class="text-center row mt-5 mx-2" style="margin-bottom: 10rem;">
                            <a href="nulqueue.html" class="btn btn-select-yellow my-3 fw-bold" onclick="registerGuest()">APPLICANT / GUEST</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exStudent"
                                class="btn btn-select-blue fw-bold">EXISTING STUDENT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Add this alert div at the top of your HTML body -->

    <!-- modals -->
    <div class="modal fade" id="exStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header d-block border-0 pb-0">
                    <h1 class="modal-title fs-4 text-center custom-bold custom-primary-color" id="modalTitle2">
                        EXISTING STUDENT</h1>
                    <p class="modal-secondary fst-italic text-center custom-primary-color p-0 m-0">Please select your
                        program and
                        enter your student ID</p>
                </div>
                <div class="modal-body text-center pb-0  my-3">
                    <?php
                    @include 'database.php';
                    $sql = "SELECT acronym, collegeName FROM colleges";
                    $result = $conn->query($sql);
                    ?>
                    <select
                        class="h5 form-select text-center selectpicker rounded border-1 mb-2 border-dark font-weight-bold"
                        aria-label="Default select example" id="program">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $acronym = $row["acronym"];
                                $collegeName = $row["collegeName"];
                                echo '<option value="' . $acronym . '">' . $acronym . ' - ' . $collegeName . '</option>';
                            }
                        } else {
                            echo '<option value="">No colleges available</option>';
                        }
                        ?>

                        <!-- <option value="SCS">SCS - School of Computer Studies</option>
                        <option value="SEA">SEA - School of Engineering and Architecture</option>
                        <option value="SAS">SAS - School of Arts and Sciences</option>
                        <option value="SABM">SABM - School of Accountancy and Business Management</option>
                        <option value="SHS">SHS - Senior High School</option> -->
                    </select>
                    <input type="text" pattern="[0-9]*[^a-zA-Z]"
                        class="form-control text-center rounded border-1 border-dark custom-primary-color font-weight-bold"
                        placeholder="Enter Student ID" id="studentId">
                    <p class="text-danger" id="error-message" style="display: none;">Please enter a Student ID.</p>
                </div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="btn btn-yes px-4 rounded" onclick="submitStudentId()"
                        id="doneButton">DONE</button>
                    <button type="button" class="btn btn-no px-4 rounded" data-bs-dismiss="modal">CANCEL</button>


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exStudentError" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header d-block border-0 pb-0">

                    <h1 class="modal-title fs-4 text-center custom-bold custom-primary-color mb-2" id="modalTitle2">
                        Existing Queue: <span id="queueNumber"> </span></h1>

                    <div class="alert alert-warning fade show text-center" role="alert" id="ongoingQueueAlert"
                        style="display: none;">
                        You have an ongoing
                        queue. Do you wish to cancel your current transaction?
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="btn btn-yes px-4 rounded" onclick="deleteStudentId()"
                        id="doneButton">YES</button>
                    <button type="button" class="btn btn-no px-4 rounded" data-bs-dismiss="modal">NO</button>


                </div>
            </div>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.socket.io/4.3.1/socket.io.min.js"></script>
<script src="script/client.js"></script>

</html>