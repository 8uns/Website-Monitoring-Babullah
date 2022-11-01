<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Tagihan & Billing</strong></h3>
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
                    <i class="fas fa-upload"></i>
                    Keluarkan Tagihan
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
                        <thead class="text-center">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tenan</th>
                                <th scope="col">Bulan</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Tagihan</th>
                                <th scope="col">Billing</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">

                            <?php
                            $i = 1;
                            foreach ($data['billing'] as $key => $vals) :

                            ?>
                                <tr>
                                    <th scope="row">
                                        <?= $i ?>
                                    </th>
                                    <td>
                                        <?= $vals['nama'] ?>
                                    </td>
                                    <td>
                                        <?= $vals['month'] ?>
                                    </td>
                                    <td>
                                        <?= $vals['year'] ?>
                                    </td>
                                    <td>
                                        <button title="Action" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#actionTagihan<?= $vals['billing_id'] ?>"><i class="fas fa-file-invoice"></i></button>













                                    </td>

                                    <td>
                                        <?php if ($vals['file_billing'] != '') : ?>
                                            <a data-bs-toggle="tooltip" title="Lihat Billing" class="btn btn-sm btn-primary" <?php
                                                                                                                                echo 'target="blank" href="' . BASEURL . 'file/billing/' . $vals['tenan_id'] . '/' . $vals['file_billing'] . '"';
                                                                                                                                ?>>
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </a>
                                            <?php if ($vals['validation'] == 0) : ?>
                                                <button title="Perbarui Billing" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#perbaruibilling<?= $vals['billing_id'] ?>">
                                                    <i class="fas fa-upload"></i>

                                                </button>
                                            <?php endif; ?>
                                        <?php else : ?>


                                            <button title="Keluarkan Billing" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#keluarkanbill<?= $vals['billing_id'] ?>">
                                                <i class="fas fa-upload"></i>

                                            </button>
                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <?php if ($vals['validation'] == 1) :
                                        ?>
                                            <div class="badge bg-success text-wrap" style="width: 6rem;">
                                                Valid
                                            </div>
                                        <?php
                                        else :
                                        ?>
                                            <div class="badge bg-danger text-wrap" style="width: 6rem;">
                                                Belum dikonfirmasi
                                            </div>
                                        <?php

                                        endif ?>

                                    </td>

                                    <td>
                                        <?php if ($vals['payment_sewatempat'] != '' && $vals['payment_konsesi'] != '' && $vals['payment_listrik'] != '' && $vals['validation'] == 0) :  ?>
                                            <button title="Konfirmasi Bukti Pembayaran" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#konfirmasi<?= $vals['billing_id'] ?>">
                                                <i class="fas fa-check-circle"></i></button>


                                        <?php endif; ?>
                                        <?php if ($vals['validation'] == 1) :  ?>
                                            <button title="Batalkan Konfirmasi Bukti Pembayaran" type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#batalkonfirmasi<?= $vals['billing_id'] ?>">
                                                <i class="fas fa-check-circle"></i></button>
                                        <?php endif; ?>



                                        <?php if ($vals['validation'] == 0) :  ?>

                                            <button title="Hapus Billing" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#hapus<?= $vals['billing_id'] ?>">
                                                <i class="fas fa-trash-alt"></i></button>
                                        <?php endif; ?>

                                    </td>
                                </tr>

                                <!-- Modal Action Tagihan -->
                                <div class="modal fade" id="actionTagihan<?= $vals['billing_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Action Tagihan
                                                    <?= $vals['nama'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-0 ps-5">
                                                    <div class="row">
                                                        <div class="col-2 text-center">
                                                            <a data-bs-toggle="tooltip" title="Lihat Tagihan Konsesi" class="btn btn-sm btn-primary" <?php if ($vals['file_konsesi'] == '') {
                                                                                                                                                            echo 'href="#"';
                                                                                                                                                        } else {
                                                                                                                                                            echo 'target="blank" href="' . BASEURL . 'file/billing/' . $vals['tenan_id'] . '/' . $vals['file_konsesi'] . '"';
                                                                                                                                                        }  ?>>
                                                                <i class="fas fa-file-alt"></i> </a>
                                                        </div>
                                                        <div class="col">
                                                            <label for="" class="form-label"> Lihat Tagihan Konsesi</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php if ($vals['payment_konsesi'] != '') : ?>

                                                    <div class="mb-0 ps-5">
                                                        <div class="row">
                                                            <div class="col-2 text-center">
                                                                <a data-bs-toggle="tooltip" title="Lihat Pembayaran Konsesi" class="btn btn-sm btn-success" <?php if ($vals['payment_konsesi'] == '') {
                                                                                                                                                                echo 'href="#"';
                                                                                                                                                            } else {
                                                                                                                                                                echo 'target="blank" href="' . BASEURL . 'file/payment/' . $vals['tenan_id'] . '/' . $vals['payment_konsesi'] . '"';
                                                                                                                                                            }  ?>>

                                                                    <i class="fas fa-file-alt"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="form-label"> Lihat Pembayaran Konsesi</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr>

                                                <?php endif; ?>

                                                <div class="mb-0 ps-5">
                                                    <div class="row">
                                                        <div class="col-2 text-center">

                                                            <a data-bs-toggle="tooltip" title="Lihat Tagihan Lapak" class="btn btn-sm btn-primary" <?php if ($vals['file_sewatempat'] == '') {
                                                                                                                                                        echo 'href="#"';
                                                                                                                                                    } else {
                                                                                                                                                        echo 'target="blank" href="' . BASEURL . 'file/billing/' . $vals['tenan_id'] . '/' . $vals['file_sewatempat'] . '"';
                                                                                                                                                    }  ?>>
                                                                <i class="fas fa-store-alt"></i></a>
                                                        </div>
                                                        <div class="col">
                                                            <label for="" class="form-label"> Lihat Tagihan Lapak</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php if ($vals['payment_sewatempat'] != '') : ?>

                                                    <div class="mb-0 ps-5">
                                                        <div class="row">
                                                            <div class="col-2 text-center">
                                                                <a data-bs-toggle="tooltip" title="Lihat Pembayaran Lapak" class="btn btn-sm btn-success" <?php if ($vals['payment_sewatempat'] == '') {
                                                                                                                                                                echo 'href="#"';
                                                                                                                                                            } else {
                                                                                                                                                                echo 'target="blank" href="' . BASEURL . 'file/payment/' . $vals['tenan_id'] . '/' . $vals['payment_sewatempat'] . '"';
                                                                                                                                                            }  ?>>

                                                                    <i class="fas fa-store-alt"></i></i>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="form-label"> Lihat Pembayaran Lapak</label>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                <?php endif; ?>

                                                <div class="mb-0 ps-5">
                                                    <div class="row">
                                                        <div class="col-2 text-center">
                                                            <a data-bs-toggle="tooltip" title="Lihat Tagihan Listrik" class="btn btn-sm btn-primary" <?php if ($vals['file_listrik'] == '') {
                                                                                                                                                            echo 'href="#"';
                                                                                                                                                        } else {
                                                                                                                                                            echo 'target="blank" href="' . BASEURL . 'file/billing/' . $vals['tenan_id'] . '/' . $vals['file_listrik'] . '"';
                                                                                                                                                        }  ?>>
                                                                <i class="fas fa-bolt"></i></i></a>
                                                        </div>
                                                        <div class="col">
                                                            <label for="" class="form-label"> Lihat Tagihan Listrik</label>

                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php if ($vals['payment_listrik'] != '') : ?>

                                                    <div class="mb-0 ps-5">
                                                        <div class="row">
                                                            <div class="col-2 text-center">
                                                                <a data-bs-toggle="tooltip" title="Lihat Pembayaran Listrik" class="btn btn-sm btn-success" <?php if ($vals['payment_listrik'] == '') {
                                                                                                                                                                echo 'href="#"';
                                                                                                                                                            } else {
                                                                                                                                                                echo 'target="blank" href="' . BASEURL . 'file/payment/' . $vals['tenan_id'] . '/' . $vals['payment_listrik'] . '"';
                                                                                                                                                            }  ?>>

                                                                    <i class="fas fa-bolt"></i></i>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="form-label"> Lihat Pembayaran Listrik</label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            </div>
                                        </div>

                                    </div>
                                </div <!-- Modal keluarkan billing -->
                                <div class="modal fade" id="keluarkanbill<?= $vals['billing_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= BASEURL ?>Dashboardupbu/keluarkanBilling/<?= $vals['tenan_id'] ?>/<?= $vals['billing_id'] ?>" method="post" enctype="multipart/form-data">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Keluarkan Billing
                                                        <?= $vals['nama'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Billing</label>
                                                        <input required name="file_billing" type="file" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran
                                                            tidak lebih dari 2 MB &
                                                            Extention Pdf</div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <!-- Modal perbarui billing -->
                                <div class="modal fade" id="perbaruibilling<?= $vals['billing_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= BASEURL ?>Dashboardupbu/perbaruibilling/<?= $vals['tenan_id'] ?>/<?= $vals['billing_id'] ?>" method="post" enctype="multipart/form-data">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Perbarui Billing
                                                        <?= $vals['nama'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Billing</label>
                                                        <input required name="file_billing" type="file" class="form-control" id="">

                                                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran
                                                            tidak lebih dari 2 MB &
                                                            Extention Pdf</div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <!-- Modal Hapus Billing-->
                                <div class="modal fade" id="hapus<?= $vals['billing_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Billing
                                                    <?= $vals['nama'] ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin Menghapus Billing <?= $vals['nama'] ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="<?= BASEURL ?>Dashboardupbu/hapusBilling/<?= $vals['billing_id'] ?>" type="button" class="btn btn-danger">Ya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Konfirmasi Bukti Pembayaran-->
                                <div class="modal fade" id="konfirmasi<?= $vals['billing_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Bukti Pembayaran
                                                    <?= $vals['nama'] ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin Mengkonfirmasi Bukti Pembayaran <?= $vals['nama'] ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="<?= BASEURL ?>Dashboardupbu/konfirmasiBuktiPembayaran/<?= $vals['billing_id'] ?>" type="button" class="btn btn-primary">Ya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Batal Konfirmasi Bukti Pembayaran-->
                                <div class="modal fade" id="batalkonfirmasi<?= $vals['billing_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Batalkan Konfirmasi Bukti
                                                    Pembayaran
                                                    <?= $vals['nama'] ?>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin Membatalkan Konfirmasi Bukti Pembayaran <?= $vals['nama'] ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="<?= BASEURL ?>Dashboardupbu/batalkonfirmasiBuktiPembayaran/<?= $vals['billing_id'] ?>" type="button" class="btn btn-dark">Ya</a>
                                            </div>
                                        </div>
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



<!-- Modal keluarkan tagihan -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= BASEURL ?>Dashboardupbu/tambahBilling" method="post" enctype="multipart/form-data">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluarkan Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">

                        <select name="tenan_id" class="form-select" aria-label="Default select example" required>
                            <option value="">Pilih Tenan</option>
                            <?php

                            $ii = 1;

                            foreach ($data['tenan'] as $key => $valsTenan) :


                            ?>
                                <option value="<?= $valsTenan['tenan_id'] ?>"><?= $valsTenan['name'] ?></option>
                            <?php
                                $ii++;
                            endforeach;
                            ?>
                        </select>
                        <div id="" class="form-text text-danger">Wajib memilih tenan</div>
                    </div>

                    <div class="mb-3">

                        <select name="bulan" class="form-select" aria-label="Default select example" required>
                            <option value="">Pilih Bulan</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                        <div id="" class="form-text text-danger">Wajib memilih bulan</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Konsesi</label>
                        <input required name="file_konsesi" type="file" class="form-control" id="">

                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran tidak lebih dari 2 MB &
                            Extention Pdf</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Sewa Lapak</label>
                        <input required name="file_sewatempat" type="file" class="form-control" id="">

                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran tidak lebih dari 2 MB &
                            Extention Pdf</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Listrik</label>
                        <input required name="file_listrik" type="file" class="form-control" id="">

                        <div id="" class="form-text text-danger">Tidak boleh kosong, Ukuran tidak lebih dari 2 MB &
                            Extention Pdf</div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>

    </div>
</div>