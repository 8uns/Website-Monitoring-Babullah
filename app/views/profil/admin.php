<div class="container profil">
    <div class="row justify-content-end mb-3">
        <div class="col-9">
            <h3 class="border-bottom"><strong> Profil Saya</strong></h3>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-9 mt-3">

            <div class="card mb-3" style="max-width:100%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= BASEURL ?>img/user-default.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"></h5>

                            <div class="row">
                                <div class="col">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            Username
                                            <div class="fw-bold"> jhon21</div>
                                        </li>

                                        <li class="list-group-item">
                                            Nama Lengkap
                                            <div class="fw-bold"> Jhon Geral </div>
                                        </li>

                                    </ul>
                                </div>


                               
                            </div>


                        </div>

                        <div class="row p-5">
                            <div class="col text-end ">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#profilMemebers">
                                    Perbarui Profil
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="profilMemebers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perbarui Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Nama Lengkap</label>
                                <input required name="name" type="text" class="form-control" id="" aria-describedby="" value="Jhone Geral">
                                <div id="" class="form-text">Tidak boleh kosong</div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="">
                                <div id="" class="form-text">Kosongkan password jika tidak ingin diganti</div>

                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Username</label>
                                <input required name="username" type="text" class="form-control" id="" aria-describedby="" value="jhon21">
                                <div id="" class="form-text">Tidak boleh kosong</div>
                            </div>





                        </div>

                        
                    </div>








                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </div>

        </form>

    </div>
</div>