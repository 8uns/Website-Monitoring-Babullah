<div class="container">
    <div class="row justify-content-end mb-3">
        <div class="col-10 col-sm-10 col-md-9">
            <h3 class="border-bottom"><strong>Profil Setting</strong></h3>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-10 col-sm-10 col-md-9">
            <?php Flasher::flashAll() ?>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-10 col-sm-10 col-md-9">


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
                                <th class="d-none d-lg-table-cell" scope="col">Username</th>

                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $i = 1;

                            foreach ($data['akun'] as $vals) :


                            ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $vals['name'] ?></td>
                                <td class="d-none d-lg-table-cell"><?= $vals['username'] ?></td>

                                <td>


                                    <button title="Perbarui data Pengguna" type="button" class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal" data-bs-toggle="tooltip"
                                        data-bs-target="#update<?= $vals['acount_id'] ?>"><i
                                            class="fas fa-pen-square"></i></button>


                                    <!-- Modal Hapus-->


                                </td>
                            </tr>





                            <!-- Modal Update Profil-->
                            <div class="modal fade" id="update<?= $vals['acount_id'] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= BASEURL ?>Dashboardupbu/updateProfil/<?= $vals['acount_id'] ?>"
                                        method="post">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Memperbarui Data Profil
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
                                                    <label for="" class="form-label">Username</label>
                                                    <input value="<?= $vals['username'] ?>" required name="username"
                                                        type="text" class="form-control" id="">
                                                    <div id="" class="form-text text-danger">Tidak boleh kosong</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label">Password</label>
                                                    <input name="password" type="password" class="form-control" id="">

                                                    <div id="" class="form-text text-danger">Kosongkan jika tidak ingin
                                                        diperbarui</div>
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