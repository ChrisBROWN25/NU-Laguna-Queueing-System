<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NU QUEUE</title>
    <link href='http://fonts.googleapis.com/css?family=' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
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
                <h4 class="fst-italic fs-3 p-5 fw-bold text-center nu_color">Howdy, Nationalian! Please select your
                    office.</h4>
                <div class="d-flex justify-content-center align-items-center flex-wrap">

                    <?php
                    @include 'database.php';
                    $sql = "SELECT officeName FROM offices WHERE office = 0 AND officeName != 'ACADEMICS'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output buttons dynamically based on the data
                        $counter = 0;
                        while ($row = $result->fetch_assoc()) {
                            $officeName = $row["officeName"];
                            $buttonClass = ($counter % 2 == 0) ? "btn-blue" : "btn-yellow";

                            echo '<button href="#" class="fw-bold btn ' . $buttonClass . ' p-5 m-2 flex-grow-1" data-bs-toggle="modal" 
              data-bs-target="#firstModal" data-title="' . $officeName . '">' . $officeName . '</button>';
                            $counter++;
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                    <!-- <button href="#" class="fw-bold btn btn-blue p-5 m-2 flex-grow-1" data-bs-toggle="modal"
                        data-bs-target="#firstModal" data-title="ADMISSION">ADMISSION</button>

                    <button href="#" class="fw-bold btn btn-yellow p-5 m-2 flex-grow-1" data-bs-toggle="modal"
                        data-bs-target="#firstModal" data-title="REGISTRAR">REGISTRAR</button>
                    <button href="#" class="fw-bold btn btn-blue p-5 m-2 flex-grow-1" data-bs-toggle="modal"
                        data-bs-target="#firstModal" data-title="ACCOUNTING">ACCOUNTING</button> -->
                    <a href="academicsinterface.php" class="fw-bold btn btn-yellow p-5 m-2 flex-grow-1">ACADEMICS</a>
                    <a href="otheroffices.php" class="fw-bold btn btn-blue p-5 m-2 flex-grow-1">OTHER OFFICES</a>
                </div>
                <button onclick="history.back()" class="btn btn-back p-1 m-2 float-end"><img src="assets/backbtn.png"
                        alt="Back" class="img-fluid" style="max-height: auto; max-width: 100%;"></button>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Modal -->

    <!-- First Modal -->
    <div class="modal fade" id="firstModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header d-block border-0">
                    <h1 class="modal-title fs-4 text-center custom-bold custom-primary-color" id="modalTitle1">
                        Loading...
                    </h1>
                </div>
                <div class="modal-body text-center custom-italic custom-bold custom-primary-color">
                    Do you wish to queue at the selected office?
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="btn btn-yes px-4 rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#thirdModal" onclick="registerStudent()" id="btn-print-qn">YES</button>
                    <button type="button" class="btn btn-no px-4 rounded-pill" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 1st MODAL REGISTRAR ENDS -->

    <!-- Modal -->
    <div class="modal fade" id="thirdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header d-block border-0 pb-0">
                    <h1 class="modal-title fs-4 text-center custom-bold custom-primary-color" id="modalTitle3">
                        REGISTRAR</h1>
                    <p id="desc" class="modal-secondary text-center custom-secondary-color custom-italic p-0 m-0">Please
                        proceed
                        to your selected office. Take note of your Queuing Number:</p>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body text-center pb-0">
                    <span class="custom-primary-color fs-1 queue-number" id="queueNumber">Loading...</span>
                </div>
                <div class="modal-footer d-flex flex-column border-0">
                    <button type="button" class="btn btn-yes px-4 rounded" data-bs-dismiss="modal"
                        onclick='returnIndex()'id="doneButton">DONE</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 3rd MODAL REGISTRAR ENDS -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.socket.io/4.3.1/socket.io.min.js"></script>
    <script src="script/client.js"></script>
    <script src="script/printThis.js"></script>
    <script>
        //disable done button for 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
            var doneButton = document.getElementById('doneButton');

            function disableDoneButton() {
                doneButton.disabled = true;
                setTimeout(function () {
                    doneButton.disabled = false;
                }, 5000);
            }
            $('#thirdModal').on('show.bs.modal', function () {
                disableDoneButton();
            });
        });
    </script>

</body>

</html>