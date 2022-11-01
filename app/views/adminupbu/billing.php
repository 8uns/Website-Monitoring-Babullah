<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Tenan</strong></h3>
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
                Tambah Tenan Baru
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
                                <th scope="col">Nama</th>
                                <th scope="col">CV</th>
                                <th scope="col">NPWP</th>


                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($data['tenan'] as $key => $vals) :


                            ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $vals['name'] ?></td>
                                <td><?= $vals['cv'] ?></td>
                                <td><?= $vals['npwp'] ?></td>

                                <td>

                                    <button title="Lihat data Pengguna" type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip"
                                        data-bs-target="#show<?= $vals['tenan_id'] ?>"><i
                                            class="fas fa-eye"></i></button>
                                    <button title="Perbarui data Pengguna" type="button" class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip"
                                        data-bs-target="#update<?= $vals['tenan_id'] ?>"><i
                                            class="fas fa-pen-square"></i></button>
                                    <button title="Pemasukan Tenan" type="button" class="btn btn-secondary btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip"
                                        data-bs-target="#pemasukan<?= $vals['tenan_id'] ?>"><i
                                            class="fas fa-file-invoice-dollar"></i></button>
                                    <button title="Hapus data Pengguna" type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip"
                                        data-bs-target="#hapus<?= $vals['tenan_id'] ?>"><i
                                            class="fas fa-trash-alt"></i></button>

                                    <!-- Modal Hapus-->
                                    <div class="modal fade" id="hapus<?= $vals['tenan_id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengguna
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Yakin ingin menghapus Data Tenan <?= $vals['name'] ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="<?= BASEURL ?>Dashboardupbu/del/<?= $vals['tenan_id'] ?>"
                                                        type="button" class="btn btn-primary">Ya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>


                            <!-- Modal Lihat-->
                            <div class="modal fade" id="show<?= $vals['tenan_id'] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data <?= $vals['name'] ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="card mb-3" style="max-width:100%;">
                                                <div class="row g-0">
                                                    <div class="col-md-4 p-4 mt-5 text-center">
                                                        <img height="100%" src="<?= BASEURL ?>img/Tenan-default.png"
                                                            class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title"></h5>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">
                                                                            Nama
                                                                            <div class="fw-bold"> <?= $vals['name'] ?>
                                                                            </div>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            CV
                                                                            <div class="fw-bold"> <?= $vals['cv'] ?>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>


                                                                <div class="col">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">
                                                                            NPWP
                                                                            <div class="fw-bold"> <?= $vals['npwp'] ?>
                                                                            </div>
                                                                        </li>

                                                                        <li class="list-group-item">
                                                                            Persetujuan
                                                                            <div class="fw-bold">
                                                                                <?= $vals['agreement'] ?> </div>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Lihat Pemasukan-->
                            <div class="modal fade" id="pemasukan<?= $vals['tenan_id'] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Pemasukan
                                                <?= $vals['name'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="card mb-3" style="max-width:100%;">
                                                <div class="row g-0">

                                                    <div class="col-md-14">
                                                        <div class="card-body">

                                                            <div class="card-group">

                                                                <div class="card">

                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Harian</h5>
                                                                        <p class="card-text">Update Pendapatan Hari Ini
                                                                            : Rp.
                                                                            <?php

                                                                                foreach ($data['tenanHarian'] as $valsHar) {
                                                                                    if ($valsHar['tenan_id'] == $vals['tenan_id']) {
                                                                                        echo $valsHar['total_harian'];
                                                                                        break;
                                                                                    }
                                                                                }


                                                                                ?>
                                                                        </p>
                                                                        <form
                                                                            action="<?= BASEURL ?>Dashboardupbu/cekHarianTenan/<?= $vals['tenan_id'] ?>"
                                                                            method="post">
                                                                            <p class="card-text">Pilih Tanggal : <input
                                                                                    required name="tgl" type="date"
                                                                                    class="form-control" id=""></p>
                                                                            <p class="card-text"><button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </p>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                                <div class="card">

                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Bulanan</h5>
                                                                        <p class="card-text">Update Pendapatan Bulan Ini
                                                                            : Rp.
                                                                            <?php
                                                                                foreach ($data['tenanBulanan'] as $valsBul) {
                                                                                    if ($valsBul['tenan_id'] == $vals['tenan_id']) {
                                                                                        echo $valsBul['total_bulanan'];
                                                                                        break;
                                                                                    }
                                                                                }


                                                                                ?>
                                                                        </p>
                                                                        <form
                                                                            action="<?= BASEURL ?>Dashboardupbu/cekBulananTenan/<?= $vals['tenan_id'] ?>"
                                                                            method="post">
                                                                            <p class="card-text">
                                                                                <label for=""
                                                                                    class="form-label">Bulan</label>
                                                                                <input required name="bulan"
                                                                                    placeholder="01-12" type="number"
                                                                                    min="1" max="12"
                                                                                    class="form-control" id="">
                                                                            </p>
                                                                            <p class="card-text">
                                                                                <label for=""
                                                                                    class="form-label">Tahun</label>
                                                                                <input required name="tahun"
                                                                                    type="number" class="form-control"
                                                                                    id="">
                                                                            </p>
                                                                            <p class="card-text"><button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </p>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                                <div class="card">

                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Tahunan</h5>
                                                                        <p class="card-text">Update Pendapatan Tahun Ini
                                                                            : Rp.
                                                                            <?php
                                                                                foreach ($data['tenanTahunan'] as $valsTah) {
                                                                                    if ($valsTah['tenan_id'] == $vals['tenan_id']) {
                                                                                        echo $valsTah['total_tahunan'];
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                ?>
                                                                        </p>
                                                                        <form
                                                                            action="<?= BASEURL ?>Dashboardupbu/cekTahunanTenan/<?= $vals['tenan_id'] ?>"
                                                                            method="post">
                                                                            <p class="card-text">
                                                                                <label for=""
                                                                                    class="form-label">Tahun</label>
                                                                                <input required name="tahun"
                                                                                    type="number" class="form-control"
                                                                                    id="">
                                                                            </p>
                                                                            <p class="card-text"><button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </p>
                                                                        </form>
                                                                    </div>
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


                            <!-- Modal Update Tenan-->
                            <div class="modal fade" id="update<?= $vals['tenan_id'] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= BASEURL ?>Dashboardupbu/update/<?= $vals['tenan_id'] ?>"
                                        method="post">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Memperbarui Data Tenan
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
        <form action="<?= BASEURL ?>Dashboardupbu/createTenan" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input required name="name" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">cv</label>
                        <input required name="cv" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">NPWP</label>
                        <input required name="npwp" type="text" class="form-control" id="">

                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Persetujuan</label>
                        <input required name="agreement" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Masa Kontrak</label>
                        <input required name="contract_period" type="date" class="form-control" id="">

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