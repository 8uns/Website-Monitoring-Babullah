<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>History Keluar/Masuk "<?= $data['tenan']['name'] ?>", Produk "<?= $data['produk']['name'] ?>"</strong></h3>
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
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($data['stockinout'] as $vals) :
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $vals['date'] ?></td>
                                    <td><?= $vals['time'] ?></td>
                                    <td><?= $vals['name'] ?></td>
                                    <td><?= $vals['qtytrans'] ?></td>
                                    <td><?= $vals['in_out'] ?></td>

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