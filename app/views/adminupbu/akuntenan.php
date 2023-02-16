<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Akun Tenan</strong></h3>
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
                    Tambah Akun Tenan Baru
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
                                <th scope="col">Nama Tenan</th>
                                <th class="d-none d-lg-table-cell" scope="col">Username</th>


                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($data['akuntenan'] as $vals) :


                            ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $vals['tenan'] ?></td>
                                    <td class="d-none d-lg-table-cell"><?= $vals['username'] ?></td>

                                    <td>

                                        <button title="Lihat data Pengguna" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#show<?= $vals['acount_id'] ?>"><i class="fas fa-eye"></i></button>
                                        <button title="Perbarui data Pengguna" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#update<?= $vals['acount_id'] ?>"><i class="fas fa-pen-square"></i></button>
                                        <button title="Hapus data Pengguna" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#hapus<?= $vals['acount_id'] ?>"><i class="fas fa-trash-alt"></i></button>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="hapus<?= $vals['acount_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengguna
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin ingin menghapus Data Tenan <?= $vals['name'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= BASEURL ?>Dashboardupbu/del/<?= $vals['acount_id'] ?>" type="button" class="btn btn-primary">Ya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>


                                <!-- Modal Lihat-->
                                <div class="modal fade" id="show<?= $vals['acount_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Akun Tenan
                                                    <?= $vals['name'] ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="card mb-3" style="max-width:100%;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4 p-4 mt-5 text-center">
                                                            <i style="font-size: 9em;" class="fas fa-user-alt"></i>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title"></h5>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                Tenan
                                                                                <div class="fw-bold"> <?= $vals['tenan'] ?>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                Nama
                                                                                <div class="fw-bold"> <?= $vals['name'] ?>
                                                                                </div>
                                                                            </li>

                                                                            <li class="list-group-item">
                                                                                Username
                                                                                <div class="fw-bold">
                                                                                    <?= $vals['username'] ?>
                                                                                </div>
                                                                            </li>

                                                                            <li class="list-group-item">
                                                                                password
                                                                                <div class="fw-bold">
                                                                                    <?= Bunlib::generatePasswordDecodeTwoWay($vals['showit']) ?>
                                                                                </div>
                                                                            </li>

                                                                            <li class="list-group-item">
                                                                                NPWP
                                                                                <div class="fw-bold"> <?= $vals['npwp'] ?>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                Masa Kontrak
                                                                                <div class="fw-bold">
                                                                                    <?= $vals['contract_period'] ?> </div>
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
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Update Tenan-->
                                <div class="modal fade" id="update<?= $vals['acount_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= BASEURL ?>Dashboardupbu/updateAkunTenan/<?= $vals['acount_id'] ?>" method="post">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Memperbarui Data Tenan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Tenan</label>
                                                        <select disabled required name="tenan_id" type="text" class="form-control" id="">
                                                            <?php foreach ($data['tenanAkun'] as $value) : ?>
                                                                <option <?php if ($vals['tenan_id'] == $value['tenan_id']) {
                                                                            echo "selected='selected'";
                                                                        } ?> value="<?= $value['tenan_id'] ?>">
                                                                    <?= $value['name'] ?></option>


                                                            <?php endforeach; ?>
                                                        </select>
                                                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nama</label>
                                                        <input value="<?= $vals['name'] ?>" required name="name" type="text" class="form-control" id="">
                                                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Username</label>
                                                        <input value="<?= $vals['username'] ?>" required name="username" type="text" class="form-control" id="">
                                                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Password</label>
                                                        <input name="password" type="password" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Kosongkan jika tidak ingin
                                                            diperbarui</div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Perbarui</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            <?php
                                $i++;
                            endforeach;
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- Modal tambah Tenan -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= BASEURL ?>Dashboardupbu/createAkunTenan" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="form-label">Tenan</label>
                        <select required name="tenan_id" type="text" class="form-control" id="">
                            <?php foreach ($data['tenan'] as $vals) : ?>
                                <option value="<?= $vals['tenan_id'] ?>"><?= $vals['name'] ?></option>

                            <?php endforeach; ?>
                        </select>
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input required name="name" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Username</label>
                        <input required name="username" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
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