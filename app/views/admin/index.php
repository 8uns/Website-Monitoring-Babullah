<div class="body-login">
    <div class="opening">

        <div class="center" id="centeropening">
            <h1>S I M P E L</h1>
            <h6>SISTEM INFORMASI PELAPORAN DAN E-BILLING</h6>
            <h6>BANDAR UDARA SULTAN BABULLAH TERNATE</h6>
        </div>

    </div>
    <div id="login admin" class="container mb-4 pt-4 pb-4 pr-5 pl-5">


        <div class="row">
            <div class="col">
                <?php Flasher::flashAll() ?>
            </div>
        </div>


        <div class="row justify-content-center  align-items-center">



            <div class="col-lg-6 col-sm-12 mt-4 p-5 pt-0 text-center">
                <h2 class=" text-center border-bottom mb-1 pb-3 fw-bold">S I M P E L </h2>
                <h6>Sistem Informasi Laporan Pendapatan dan E-Billing</h6>
                <h6>Bandar Udara Sultan Babullah Ternate</h6>
                <!-- <h2 class=" mb-5 text-center pb-2"><strong>Masuk</strong> </h2> -->
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="<?= BASEURL ?>login/loggedin/admin" method="post" class="mt-5">
                            <div class="mb-4">
                                <i class="fas fa-user"></i>

                                <!-- <label for="exampleInputEmail1" class="form-label">Username</label> -->
                                <input placeholder="username" required name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-lock"></i>

                                <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
                                <input placeholder="password" required name="password" type="password" class="form-control" id="exampleInputPassword1">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-around align-items-center ">
            <div class="col text-center text-dark" style="font-size: 11px;">
                Copyright @ 2022 | Supported by Tifa Malut
            </div>
        </div>
    </div>




    <div class="container mt-5">

    </div>
</div>

<script>
    let opening = document.querySelector('.opening');

    window.addEventListener('load', function() {

        opening.style.transitionDuration = '0.5s';
        document.getElementById('centeropening').style.animation = 'animopening 2s 1';
        setTimeout(function() {
            opening.style.display = 'none';

        }, 1500)


    })
</script>