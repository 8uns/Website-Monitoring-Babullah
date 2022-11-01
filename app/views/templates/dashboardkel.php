<div class="container dashboard">
    <div class="row justify-content-end mb-3">
        <div class="col-9">
            <h3 class="border-bottom"><strong>Dashboard</strong></h3>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-9">


            <div class="row">
                <div class="col text-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Presentase Program</h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-12">
                                    <table class="table  table-hover align-middle">
                                        <thead>
                                            <tr class="alig">
                                                <th scope="col">No</th>
                                                <th scope="col">Kelurahan </th>
                                                <th scope="col">Penanggung Jawab</th>
                                                <th scope="col">Tgl </th>
                                                <th scope="col">Progres</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($data['durk'] as $vals) :
                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><?= $vals['alamat'] ?></td>

                                                    <td><?= $vals['pj'] ?></td>
                                                    <td><?= $vals['tgl'] ?></td>



                                                    <td class="text-center presentase">
                                                        <h6>
                                                            <?= $vals['presentase'] ?> %
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
                            <h5 class="card-title">Total DURK</h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-8">


                                    <br>
                                    <h1>
                                        <strong>
                                            <i class="fas fa-file-alt"></i>
                                        </strong>
                                    </h1>
                                    <h2 id="totaldurkkel">

                                    </h2>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <br>
            <div class="row">
                <div class="col-6 text-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Rekomendasi DURK</h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-8">


                                    <br>
                                    <canvas id="chartKel"></canvas>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-6 text-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Approve DURK</h5>
                            <hr>
                            <div class="row justify-content-md-center">
                                <div class="col-8">


                                    <br>
                                    <canvas id="chartKel12"></canvas>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div id="tampil" class=""></div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>