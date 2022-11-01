<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Arsip File Kontrak Tenan <?= $data['tenan']['name'] ?></strong></h3>
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
                <a href="<?= BASEURL ?>Dashboardupbu/tenan" class="btn btn-primary" ">
                    <i class=" fas fa-angle-double-left"></i>
                    Kembali
                </a>

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
                                <th scope="col">File Kontrak</th>
                                <th class="d-none d-lg-table-cell" scope="col">Tanggal Upload</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($data['arsip'] as $key => $vals) :


                            ?>
                                <tr>
                                    <th class="text-center" scope="row"><?= $i ?></th>
                                    <td>
                                        <a target="blank" href="<?= BASEURL ?>file/contract/<?= $vals['tenan_id'] ?>/<?= $vals['file_contract'] ?>">
                                            <?= $vals['file_contract'] ?>
                                        </a>

                                    </td>
                                    <td class="d-none d-lg-table-cell"><?= $vals['date_upload'] ?></td>


                                </tr>


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