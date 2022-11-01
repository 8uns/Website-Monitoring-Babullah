<div class="container dashboard">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Dashboard</strong></h3>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-10 col-sm-10 col-md-9">


            <div class="row">

                <div class="col text-center">
                    <div class="card mb-4" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Pendapatan Bulan
                                <?= Bunlib::transalateBulan(date('F')) ?>
                            </h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-12">
                                    <table class="table  table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">No </th>
                                                <th scope="col">Nama Tenan </th>
                                                <!-- <th scope="col">Bulan </th> -->

                                                <th scope="col">Total Pendapatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($data['transmonth'] as $valTran) :
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $valTran['nama_tenan'] ?></td>
                                                <!-- <td><?= Bunlib::transalateBulan($valTran['bulan']) ?></td> -->




                                                <td class="text-center presentase">
                                                    <h6>
                                                        Rp. <?= $valTran['total'] ?>
                                                    </h6>
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

                <div class="col text-center">
                    <div class="card mb-4" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Pendapatan Harian Tanggal
                                <?= date('j') ?>
                                Bulan
                                <?= Bunlib::transalateBulan(date('F')) ?>
                            </h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-12">
                                    <table class="table  table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">No </th>

                                                <th scope="col">Nama Tenan </th>
                                                <!-- <th scope="col">Tanggal </th> -->

                                                <th scope="col">Total Pendapatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($data['transday'] as $valTran) :
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $valTran['nama_tenan'] ?></td>
                                                <!-- <td><?= $valTran['tgl'] ?></td> -->




                                                <td class="text-center presentase">
                                                    <h6>
                                                        Rp. <?= $valTran['total'] ?>
                                                    </h6>
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



            </div>

            <br>


            <div class="row">

                <div class="col text-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Tenan</h5>
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-8">


                                    <br>
                                    <h1>
                                        <strong>
                                            <i class="fas fa-store-alt"></i>
                                        </strong>
                                    </h1>
                                    <h2 id="totalkel">
                                        <?= $data['totaltenan']['total_tenan'] ?>
                                    </h2>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Akun Tenan</h5>
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-8">


                                    <br>
                                    <h1>
                                        <strong>
                                            <i class="fas fa-users"></i>
                                        </strong>
                                    </h1>
                                    <h2 id="totalpengguna">
                                        <?= $data['totalakuntenan']['total_akuntenan'] ?>
                                    </h2>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <!-- <div class="col-12 text-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Pemasukan Tenan 2022</h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-8">


                                    <br>
                                    <canvas id="myChart"></canvas>

                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->


                <!-- <div class="col-6 text-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Approve DURK</h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-8">


                                    <br>
                                    <canvas id="myChart12"></canvas>

                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->

                <div class="col-12 mt-5">
                    <div id="tampil" class=""></div>
                </div>

            </div>

            <!-- <div class="row">
                <div class="col-12 text-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Billing Tenan 2022</h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-8">


                                    <br>
                                    <canvas id="myChart122"></canvas>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

</div>
</div>