<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Pendapatan Detail
                    "<?= isset($data['transaksiharian'][0]['nama_tenan']) ? $data['transaksiharian'][0]['nama_tenan'] : '' ?>"
                    Tanggal
                    <?= isset($data['transaksiharian'][0]['tgl']) ? $data['transaksiharian'][0]['tgl'] : '' ?> </strong>
            </h3>
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
                                <th scope="col">No</th>
                                <th scope="col">Transaksi Id</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Total Pendapatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($data['transaksiharian'] as $vals) :


                            ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $vals['transaction_id'] ?></td>
                                <td><?= $vals['time'] ?></td>
                                <td><?= $vals['date'] ?></td>
                                <td>Rp. <?= $vals['total_harian'] ?></td>
                                <td>
                                    <a href="<?= BASEURL ?>Dashboardupbu/cetaktransDetail/<?= $vals['transaction_id'] ?>"
                                        target="blank" title="Print Detail Transaksi" class="btn btn-warning btn-sm"
                                        data-bs-toggle="tooltip"><i class="fas fa-file-alt"></i></a>
                                    <button totaltrans='Rp. <?= $vals['total_harian'] ?>' onclick="getItemTrans(this)"
                                        title="Lihat Detail Transaksi" type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#showitemTrans"
                                        value="<?= $vals['transaction_id'] ?>"><i class="fas fa-eye"></i></button>
                                </td>
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

<!-- Modal Lihat item transaksi-->
<div class="modal fade" id="showitemTrans" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleshowitem">
                    Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="card mb-3" style="max-width:100%;">
                    <div class="row g-0">

                        <div class="col">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <ul class="list-group list-group-flush" id="modelItemTrans">



                                </ul>

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