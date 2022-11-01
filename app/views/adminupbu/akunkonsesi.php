<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Akun Konsesi</strong></h3>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-10 col-sm-10 col-md-9">
            <?php Flasher::flashAll() ?>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-10 col-sm-10 col-md-9">
            <?php
            if ($_SESSION['level'] == 0) {
            ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="fas fa-user-plus"></i>
                Tambah Akun Konsesi Baru
            </button>

            <?php
            }
            ?>

        </div>
    </div>
    <div class="row justify-content-end mt-3">
        <div class="col-10 col-sm-10 col-md-9">

            <div class="card" style="width: 100%;">
                <div class="card-body table-responsive">

                    <table id="tableSearch" class="table  table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama Konsesi</th>


                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            // $i = 1;

                            // foreach ($data['akunkonsesi'] as $vals) :
                            for ($i = 1; $i <= 5; $i++) :

                            ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td> George</td>
                                <td>Warung Ijo</td>

                                <td>

                                    <button title="Lihat data Akun" type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#show"><i
                                            class="fas fa-eye"></i></button>
                                    <button title="Perbarui data Akun" type="button" class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip"
                                        data-bs-target="#update<?= $vals['acount_id'] ?>"><i
                                            class="fas fa-pen-square"></i></button>
                                    <button title="Hapus data Akun" type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip"
                                        data-bs-target="#hapus<?= $vals['acount_id'] ?>"><i
                                            class="fas fa-trash-alt"></i></button>

                                    <!-- Modal Hapus-->
                                    <div class="modal fade" id="hapus<?= $vals['acount_id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Akun</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Yakin ingin menghapus Data Akun <?= $vals['name'] ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="<?= BASEURL ?>konsesi/del/<?= $vals['acount_id'] ?>"
                                                        type="button" class="btn btn-primary">Ya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>


                            <!-- Modal Lihat-->
                            <div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data George</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="card mb-3" style="max-width:100%;">
                                                <div class="row g-0">
                                                    <div class="col-md-4 p-4 mt-5 text-center">
                                                        <img height="100%" src="<?= BASEURL ?>img/konsesi-default.png"
                                                            class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title"></h5>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">
                                                                            Username
                                                                            <div class="fw-bold"> Ggeorge </div>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            Nama Konsesi
                                                                            <div class="fw-bold"> Warung Ijo </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>



                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Update konsesi-->
                            <div class="modal fade" id="update<?= $vals['acount_id'] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="konsesi/update/<?= $vals['acount_id'] ?>" method="post">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Memperbarui Data Konsesi
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label for="" class="form-label">Nama</label>
                                                    <input value="<?= $vals['name'] ?>" required name="name" type="text"
                                                        class="form-control" id="">
                                                    <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label">cv</label>
                                                    <input value="<?= $vals['cv'] ?>" required name="cv" type="text"
                                                        class="form-control" id="">
                                                    <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label">NPWP</label>
                                                    <input value="<?= $vals['npwp'] ?>" required name="npwp" type="text"
                                                        class="form-control" id="">

                                                    <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label">Persetujuan</label>
                                                    <input value="<?= $vals['agreement'] ?>" required name="agreement"
                                                        type="text" class="form-control" id="">
                                                    <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label">Masa Kontrak</label>
                                                    <input value="<?= $vals['contract_period'] ?>" required
                                                        name="contract_period" type="date" class="form-control" id="">

                                                    <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <?php
                            // $i++;
                            // endforeach;
                            endfor;
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- Modal tambah konsesi -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="akunkonsesi/create" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="form-label">Pilih Konsesi</label>
                        <input required name="concession_id" type="text" class="form-control" id="">
                        <select class="form-select" aria-label="Default select example">
                            <?php foreach ($data['konsesi'] as $konsesi) : ?>
                            <option value="<?= $konsesi['concession_id'] ?>"><?= $konsesi['name'] ?></option>

                            <?php endforeach; ?>

                        </select>
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">username</label>
                        <input required name="username" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">password</label>
                        <input required name="password" type="password" class="form-control" id="">

                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </div>
        </form>

    </div>
</div>