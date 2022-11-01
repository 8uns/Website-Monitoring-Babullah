<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Pendapatan Bulanan
                    "<?= isset($data['transaksitahunan'][0]['nama_tenan']) ? $data['transaksitahunan'][0]['nama_tenan'] : '' ?>"
                    Tahun
                    <?= isset($data['transaksitahunan'][0]['tahun']) ? $data['transaksitahunan'][0]['tahun'] : '' ?></strong>
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
                                <th scope="col">Bulan</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($data['transaksitahunan'] as $vals) :


                            ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= Bunlib::transalateBulan($vals['bulan']) ?></td>
                                    <td><?= $vals['tahun'] ?></td>
                                    <td>Rp. <?= $vals['total_tahun'] ?></td>

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