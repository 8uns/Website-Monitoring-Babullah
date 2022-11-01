<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Produk "<?= $data['tenan']['name'] ?>"</strong></h3>
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

                    <div class="row">

                        <?php

                        $i = 1;

                        foreach ($data['produktenan'] as $vals) :


                        ?>
                            <div class="col-4">
                                <div class="card text-center">
                                    <?php if ($vals['picture'] != null || $vals['picture'] != '') : ?>
                                        <img src="<?= BASEURL ?>img/produk/<?= $data['tenan']['tenan_id'] ?>/<?= $vals['picture'] ?>" class="card-img-top" alt="...">

                                    <?php else : ?>
                                        <i class="fas fa-image text-secondary" style="font-size: 8em;"></i>
                                    <?php endif; ?>

                                    <div class="card-body text-start">
                                        <h5 class="card-title"><?= $vals['name_product'] ?></h5>
                                        <hr>
                                        <h6 class="card-subtitle mb-2 text-muted">Harga: Rp. <?= $vals['price'] ?></h6>
                                        <p class="card-text">Qty: <?= $vals['quantity'] ?></p>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-target="#StockInOut<?= $vals['product_id'] ?>">History Keluar/Masuk</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Lihat Inventory-->
                            <div class="modal fade" id="StockInOut<?= $vals['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title" id="exampleModalLabel">Cek Data History Keluar/Masuk
                                                <?= $vals['name_product'] ?></h5>
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

                                                                    <form action="<?= BASEURL ?>Dashboardupbu/stockinoutproduk/<?= $vals['tenan_id'] ?>/<?= $vals['product_id'] ?>" method="post">
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
                        <?php
                            $i++;
                        endforeach;
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>