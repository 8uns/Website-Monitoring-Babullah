<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-9">
            <h3 class="border-bottom"><strong> Alamat</strong></h3>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-9">
            <?php Flasher::flashAll() ?>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-9">
            <?php
            if ($_SESSION['level'] == 0) {
            ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAlamat">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Alamat baru
                </button>

            <?php
            }
            ?>

        </div>
    </div>
    <div class="row justify-content-end mt-3">
        <div class="col-9">

            <div class="card" style="width: 100%;">
                <div class="card-body">

                    <table id="tableSearch" class="table  table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Alamat</th>

                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 1;
                            foreach ($data['alamat'] as $vals) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $vals['nama'] ?></td>

                                    <td>

                                        <button title="Perbarui data Alamat" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#update<?= $vals['alamat_id'] ?>"><i class="fas fa-pen-square"></i></button>
                                        <button title="Hapus data Alamat" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#hapus<?= $vals['alamat_id'] ?>"><i class="fas fa-trash-alt"></i></button>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="hapus<?= $vals['alamat_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Alamat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin ingin menghapus Data Alamat <?= $vals['nama'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= BASEURL ?>alamat/del/<?= $vals['alamat_id'] ?>" type="button" class="btn btn-primary">Ya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>


                                <!-- Modal Lihat-->
                                <div class="modal fade" id="show<?= $vals['alamat_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data <?= $vals['name'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

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
                                                                                <div class="fw-bold"> <?= $vals['username'] ?> </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                Nama Lengkap
                                                                                <div class="fw-bold"> <?= $vals['name'] ?> </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>


                                                                    <div class="col">
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                Jenis Kelamin
                                                                                <div class="fw-bold"> <?= $vals['gender'] ?> </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                Alamat
                                                                                <div class="fw-bold"> <?= $vals['address'] ?> </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                Telepon
                                                                                <div class="fw-bold"> <?= $vals['phone'] ?> </div>
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


                                <!-- Modal Update petugas-->
                                <div class="modal fade" id="update<?= $vals['alamat_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="alamat/update/<?= $vals['alamat_id'] ?>" method="post">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Memperbarui Data Alamat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nama Alamat</label>
                                                        <input value="<?= $vals['nama'] ?>" required name="nama" type="text" class="form-control" id="">
                                                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
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



<!-- Modal tambah petugas -->
<div class="modal fade" id="tambahAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="alamat/create" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="form-label">Nama Alamat</label>
                        <input required name="nama" type="text" class="form-control" id="">
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