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
                                <th class="text-center" scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th class="d-none d-lg-table-cell" scope="col">NPWP</th>

                                <th scope="col" class="text-center">Dokumen</th>
                                <th scope="col" class="text-center">Inventaris</th>
                                <th scope="col" class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($data['tenan'] as $key => $vals) :


                            ?>
                                <tr>
                                    <th class="text-center" scope="row"><?= $i ?></th>
                                    <td><?= $vals['name'] ?></td>
                                    <td class="d-none d-lg-table-cell"><?= $vals['npwp'] ?></td>
                                    <td class="text-center">
                                        <?php if ($vals['file_contract'] != null || $vals['file_contract'] != '') : ?>
                                            <a href="<?= BASEURL ?>Dashboardupbu/arsipkontrak/<?= $vals['tenan_id'] ?>" title="Arsip File Kontrak" type="button" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip">
                                                <i class="fas fa-archive"></i>
                                            </a>
                                            <button title="Perbarui File Kontrak" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#perbaruikontrak<?= $vals['tenan_id'] ?>">
                                                <i class="fas fa-file-contract"></i>
                                            </button>
                                            <button title="Ubah File Kontrak" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#ubahkontrak<?= $vals['tenan_id'] ?>">
                                                <i class="fas fa-file-contract"></i>
                                            </button>


                                        <?php else : ?>
                                            <button title="Tambahkan File Kontrak" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#tambahkontrak<?= $vals['tenan_id'] ?>">
                                                <i class="fas fa-file-contract"></i>
                                            </button>

                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= BASEURL ?>Dashboardupbu/produktenan/<?= $vals['tenan_id'] ?>" title="Produk" type="button" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip"><i class="fas fa-boxes"></i></a>

                                        <button title="History Keluar/Masuk" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#StockInOut<?= $vals['tenan_id'] ?>"><i class="fas fa-truck-loading"></i></button>

                                        <button title="Pendapatan" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#Pendapatan<?= $vals['tenan_id'] ?>"><i class="fas fa-file-invoice-dollar"></i></button>

                                    </td>
                                    <td class="text-center">

                                        <button title="Lihat data Tenan" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#show<?= $vals['tenan_id'] ?>"><i class="fas fa-eye"></i></button>

                                        <button title="Ubah data Tenan" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#update<?= $vals['tenan_id'] ?>"><i class="fas fa-pen-square"></i></button>

                                        <button title="Hapus data Tenan" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#hapus<?= $vals['tenan_id'] ?>"><i class="fas fa-trash-alt"></i></button>



                                    </td>
                                </tr>


                                <!-- Modal Hapus-->
                                <div class="modal fade" id="hapus<?= $vals['tenan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Tenan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                Yakin ingin menghapus Data Tenan <?= $vals['name'] ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="<?= BASEURL ?>Dashboardupbu/deltenan/<?= $vals['tenan_id'] ?>" type="button" class="btn btn-primary">Ya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Lihat-->
                                <div class="modal fade" id="show<?= $vals['tenan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="exampleModalLabel">Data <?= $vals['name'] ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="card mb-3" style="max-width:100%;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4 p-4 mt-5 text-center">
                                                            <i style="font-size: 9em;" class="fas fa-store"></i>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title"></h5>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                Nama Tenan
                                                                                <div class="fw-bold"> <?= $vals['name'] ?>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                Masa Kontrak
                                                                                <div class="fw-bold">
                                                                                    <?= $vals['contract_period'] ?> </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                NPWP
                                                                                <div class="fw-bold"> <?= $vals['npwp'] ?>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                File Kontrak Terbaru
                                                                                <div class="fw-bold">
                                                                                    <?php if ($vals['file_contract'] != null || $vals['file_contract'] != '') : ?>
                                                                                        <a target="blank" href="<?= BASEURL ?>file/contract/<?= $vals['tenan_id'] ?>/<?= $vals['file_contract'] ?>">
                                                                                            Lihat
                                                                                        </a>
                                                                                    <?php else : ?>
                                                                                        Kosong
                                                                                    <?php endif; ?>

                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                    <div class="col">
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                Nama Akun
                                                                                <div class="fw-bold"> <?= $vals['name_acount'] ?>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                Username Akun
                                                                                <div class="fw-bold">
                                                                                    <?= $vals['username'] ?> </div>
                                                                            </li>
                                                                        </ul>

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
                                </div>

                                <!-- Modal Lihat Inventory-->
                                <div class="modal fade" id="StockInOut<?= $vals['tenan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title" id="exampleModalLabel">Cek Data History Keluar/Masuk
                                                    <?= $vals['name'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="card mb-3" style="max-width:100%;">
                                                    <div class="row g-0">

                                                        <div class="col-md-14">
                                                            <!-- <div class="card-body"> -->

                                                            <div class="card-group">

                                                                <div class="card">

                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Harian</h5>
                                                                        <hr>

                                                                        <form action="<?= BASEURL ?>Dashboardupbu/stockinout/<?= $vals['tenan_id'] ?>" method="post">
                                                                            <input type="hidden" name='tenan' value="<?= $vals['name'] ?>">

                                                                            <p class="card-text">Pilih Tanggal : <input required name="tgl" type="date" class="form-control" id="">
                                                                            </p>
                                                                            <p class="card-text"><button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i>
                                                                                    Lihat</button>
                                                                            </p>
                                                                        </form>
                                                                    </div>
                                                                </div>



                                                            </div>

                                                            <!-- </div> -->
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


                                <!-- Modal Lihat Pendapatan-->
                                <div class="modal fade" id="Pendapatan<?= $vals['tenan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="exampleModalLabel">Cek Data Pendapatan
                                                    <?= $vals['name'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="card mb-3" style="max-width:100%;">
                                                    <div class="row g-0">

                                                        <div class="col-md-14">
                                                            <!-- <div class="card-body"> -->

                                                            <div class="card-group">

                                                                <div class="card">

                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Harian</h5>
                                                                        <hr>

                                                                        <form action="<?= BASEURL ?>Dashboardupbu/cekHarianTenan/<?= $vals['tenan_id'] ?>" method="post">
                                                                            <input type="hidden" name='tenan' value="<?= $vals['name'] ?>">

                                                                            <p class="card-text">Pilih Tanggal : <input required name="tgl" type="date" class="form-control" id="">
                                                                            </p>
                                                                            <p class="card-text"><button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i>
                                                                                    Lihat</button>
                                                                            </p>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                                <div class="card">

                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Bulanan</h5>
                                                                        <hr>

                                                                        <form action="<?= BASEURL ?>Dashboardupbu/cekBulananTenan/<?= $vals['tenan_id'] ?>" method="post">
                                                                            <p class="card-text">
                                                                                <input type="hidden" name='tenan' value="<?= $vals['name'] ?>">

                                                                                <label for="" class="form-label">Pilih Bulan :</label>
                                                                                <select name="bulan" class="form-select" aria-label="Default select example" required>
                                                                                    <option value="">Pilih Bulan</option>
                                                                                    <option value="1">Januari</option>
                                                                                    <option value="2">Februari
                                                                                    </option>
                                                                                    <option value="3">Maret</option>
                                                                                    <option value="4">April</option>
                                                                                    <option value="5">Mei</option>
                                                                                    <option value="6">Juni</option>
                                                                                    <option value="7">Juli</option>
                                                                                    <option value="8">Agustus</option>
                                                                                    <option value="9">September
                                                                                    </option>
                                                                                    <option value="10">Oktober</option>
                                                                                    <option value="11">November
                                                                                    </option>
                                                                                    <option value="12">Desember
                                                                                    </option>
                                                                                </select>
                                                                            </p>
                                                                            <p class="card-text">
                                                                                <label for="" class="form-label">Pilih Tahun :</label>
                                                                                <select name="tahun" class="form-select" aria-label="Default select example" required>
                                                                                    <option value="">Pilih Tahun</option>
                                                                                    <?php for ($i = 2021; $i <= date("Y"); $i++) : ?>
                                                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </p>
                                                                            <p class="card-text">
                                                                                <button name='submit' type="submit" value="lihat" class="btn btn-primary"><i class="fas fa-eye"></i>
                                                                                    Lihat</button>

                                                                                <button type="submit" name='submit' value="cetak" class="btn btn-warning"><i class="fas fa-print"></i>
                                                                                    Cetak</button>
                                                                            </p>

                                                                        </form>
                                                                    </div>
                                                                </div>

                                                                <div class="card">

                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Tahunan</h5>
                                                                        <hr>

                                                                        <form action="<?= BASEURL ?>Dashboardupbu/cekTahunanTenan/<?= $vals['tenan_id'] ?>" method="post">
                                                                            <p class="card-text">
                                                                                <input type="hidden" name='tenan' value="<?= $vals['name'] ?>">

                                                                                <label for="" class="form-label">Pilh Tahun :</label>
                                                                                <select name="tahun" class="form-select" aria-label="Default select example" required>
                                                                                    <option value="">Pilih Tahun</option>
                                                                                    <?php for ($i = 2021; $i <= date("Y"); $i++) : ?>
                                                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                                                    <?php endfor; ?>

                                                                                </select>
                                                                            </p>
                                                                            <p class="card-text"><button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i>
                                                                                    Lihat</button>
                                                                            </p>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <!-- </div> -->
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
                                <div class="modal fade" id="update<?= $vals['tenan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= BASEURL ?>Dashboardupbu/update/<?= $vals['tenan_id'] ?>" method="post" enctype="multipart/form-data">

                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">Mengubah Data Tenan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nama</label>
                                                        <input value="<?= $vals['name'] ?>" required name="name" type="text" class="form-control" id="">
                                                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="" class="form-label">NPWP</label>
                                                        <input value="<?= $vals['npwp'] ?>" required name="npwp" type="text" class="form-control" id="">

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


                                <!-- Modal tambah file kontrak Tenan-->
                                <div class="modal fade" id="tambahkontrak<?= $vals['tenan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= BASEURL ?>Dashboardupbu/addfilecontract/<?= $vals['tenan_id'] ?>" method="post" enctype="multipart/form-data">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah File Kontrak Tenan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">



                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Masa Kontrak</label>
                                                        <input required name="contract_period" type="date" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                    </div>


                                                    <div class="mb-3">
                                                        <label for="" class="form-label">File Kontrak</label>
                                                        <input required name="file_contract" type="file" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran
                                                            tidak lebih dari 2 MB &
                                                            Extention Pdf</div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>


                                <!-- Modal ubah file kontrak Tenan-->
                                <div class="modal fade" id="ubahkontrak<?= $vals['tenan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= BASEURL ?>Dashboardupbu/ubahfilecontract/<?= $vals['tenan_id'] ?>/<?= $vals['contract_tenan_id'] ?>/<?= $vals['file_contract'] ?>" method="post" enctype="multipart/form-data">

                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah File Kontrak Tenan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">

                                                        <p class="btn btn-danger text-white">
                                                            Jika diubah file kontrak sebelumnya akan di HAPUS !!!
                                                        </p>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Masa Kontrak</label>
                                                        <input value="<?= $vals['contract_period'] ?>" required name="contract_period" type="date" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                    </div>


                                                    <div class="mb-3">
                                                        <label for="" class="form-label">File Kontrak</label>
                                                        <input required name="file_contract" type="file" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran
                                                            tidak lebih dari 2 MB &
                                                            Extention Pdf</div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <!-- Modal perbarui file kontrak Tenan-->
                                <div class="modal fade" id="perbaruikontrak<?= $vals['tenan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= BASEURL ?>Dashboardupbu/addfilecontract/<?= $vals['tenan_id'] ?>" method="post" enctype="multipart/form-data">

                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">Perbarui File Kontrak
                                                        Tenan
                                                    </h5>

                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">

                                                        <p class="btn btn-warning text-white">
                                                            Jika diperbarui file kontrak sebelumnya akan di ARSIP !!!
                                                        </p>
                                                        <p class="btn btn-danger text-white">
                                                            File sebelumnya yang sudah di ARSIP tidak akan dapat dihapus !!!
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Masa Kontrak</label>
                                                        <input value="<?= $vals['contract_period'] ?>" required name="contract_period" type="date" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                    </div>


                                                    <div class="mb-3">
                                                        <label for="" class="form-label">File Kontrak</label>
                                                        <input required name="file_contract" type="file" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran
                                                            tidak lebih dari 2 MB &
                                                            Extention Pdf</div>
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
        <form action="<?= BASEURL ?>Dashboardupbu/createTenan" method="post" enctype="multipart/form-data">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Tenan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="form-label">Nama Tenan</label>
                        <input required name="name" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">NPWP</label>
                        <input required name="npwp" type="text" class="form-control" id="">

                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>


                    <!-- <div class="mb-3">
                        <label for="" class="form-label">cv</label>
                        <input required name="cv" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div>

                    

                    <div class="mb-3">
                        <label for="" class="form-label">Persetujuan</label>
                        <input required name="agreement" type="text" class="form-control" id="">
                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="" class="form-label">Masa Kontrak</label>
                        <input required name="contract_period" type="date" class="form-control" id="">

                        <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="" class="form-label">File Kontrak</label>
                        <input required name="file_contract" type="file" class="form-control" id="">

                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran
                            tidak lebih dari 2 MB &
                            Extention Pdf</div>
                    </div> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </div>
        </form>

    </div>
</div>