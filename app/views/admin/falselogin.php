<div class="body-login">

    <div id="login admin" class="container mb-5 pt-5 pb-5 pr-5 pl-5">

        <!-- <div class="row border-bottom">
        <div class="col text-center">
            <h2><strong> Masuk</strong></h2>
        </div>
    </div> -->

        <div class="row">
            <div class="col">
                <?php Flasher::flashAll() ?>
            </div>
        </div>


        <div class="row justify-content-center  align-items-center">


            <!-- <div class="col">
            <img src="<?= BASEURL ?>img/admin.png" alt="" width="90%">
        </div> -->
            <div class="col-lg-5 col-sm-12 mt-4 p-5 pt-0 text-center">
                <h2 class=" text-center border-bottom mb-1 pb-3 fw-bold">S I M P E L </h2>
                <h6>Sistem Informasi Laporan Pendatapan dan E-Billing</h6>
                <h6>Bandar Udara Sultan Babullah Ternate</h6>
                <!-- <h2 class=" mb-5 text-center pb-2"><strong>Masuk</strong> </h2> -->
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="<?= BASEURL ?>login/loggedin/admin" method="post" class="mt-5">
                            <div class="mb-4">
                                <i class="fas fa-user"></i>

                                <!-- <label for="exampleInputEmail1" class="form-label">Username</label> -->
                                <input placeholder="username" required name="username" type="text" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-lock"></i>

                                <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
                                <input placeholder="password" required name="password" type="password"
                                    class="form-control" id="exampleInputPassword1">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-around align-items-center pb-5">

            <div class="col text-center">
                Copyright @ 2022 | Supported by Tifa Malut
            </div>
        </div>
    </div>




    <div class="container mt-5">

    </div>
</div>