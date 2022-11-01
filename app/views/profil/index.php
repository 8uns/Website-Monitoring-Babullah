<div class="container profil">
  <div class="row justify-content-end mb-3">
    <div class="col-9">
      <h3 class="border-bottom"><strong> Profil Saya</strong></h3>
    </div>
  </div>
  <div class="row justify-content-end">
    <div class="col-9 mt-3">

      <div class="card mb-3" style="max-width:100%;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="<?= BASEURL ?>img/user-default.jpg" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <div class="row">
                <div class="col">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      Username
                      <div class="fw-bold"> ajis20ger </div>
                    </li>
                   
                    <li class="list-group-item">
                      Nama Lengkap
                      <div class="fw-bold"> Ajis Gerage </div>
                    </li>

                    <li class="list-group-item">
                      Alamat
                      <div class="fw-bold"> <?= $data['profile']['address'] ?> </div>
                    </li>
                  </ul>
                </div>


                <div class="col">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      Tanggal Lahir
                      <div class="fw-bold"> <?= $data['profile']['birth'] ?> </div>
                    </li>
                    <li class="list-group-item">
                      Tempat Lahir
                      <div class="fw-bold"> <?= $data['profile']['placebirth'] ?> </div>
                    </li>
                    <li class="list-group-item">
                      Jenis Kelamin
                      <div class="fw-bold"> <?= $data['profile']['gender'] ?> </div>
                    </li>
                    <li class="list-group-item">
                      Telepon
                      <div class="fw-bold"> <?= $data['profile']['phone'] ?> </div>
                    </li>
                  </ul>
                </div>
              </div>


            </div>

            <div class="row">
              <div class="col text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" <?php
                //  if ($_SESSION['level'] == 0) {
                //                                                                               echo 'data-bs-target="#profilAdmin"';
                //                                                                             } else {
                //                                                                               echo 'data-bs-target="#profilMemeber"';
                //                                                                             }
                                                                                             ?>>
                  Perbarui Profil
                </button>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="profilMemeber" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="<?= BASEURL ?>profil/ubah/<?= $_SESSION['id'] ?>" method="post">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Perbarui Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="" class="form-label">Nomor Induk Kependudukan</label>
                <input required name="nik" type="text" class="form-control" id="" aria-describedby="" value="<?= $data['profile']['nik'] ?>">
                <div id="" class="form-text">Tidak boleh kosong</div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="" class="form-label">Nama Lengkap</label>
                <input required name="name" type="text" class="form-control" id="" aria-describedby="" value="<?= $data['profile']['name'] ?>">
                <div id="" class="form-text">Tidak boleh kosong</div>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="">
                <div id="" class="form-text">Kosongkan password jika tidak ingin diganti</div>

              </div>

              <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input required name="username" type="text" class="form-control" id="" aria-describedby="" value="<?= $data['profile']['username'] ?>">
                <div id="" class="form-text">Tidak boleh kosong</div>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <input required name="address" type="text" class="form-control" id="" aria-describedby="" value="<?= $data['profile']['address'] ?>">
                <div id="" class="form-text"> Tidak boleh kosong</div>
              </div>



            </div>

            <div class="col">
              <div class="mb-3">
                <label for="" class="form-label">Tanggal Lahir</label>
                <input required name="birth" type="date" class="form-control" id="" aria-describedby="" value="<?= $data['profile']['birth'] ?>">
                <div id="" class="form-text">Tidak boleh kosong</div>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Tempat Lahir</label>
                <input required name="placebirth" type="text" class="form-control" id="" aria-describedby="" value="<?= $data['profile']['placebirth'] ?>">
                <div id="" class="form-text"> Tidak boleh kosong</div>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-control" id="" aria-describedby="">
                  <option value="laki-laki" <?php if ($data['profile']['name'] == 'laki-laki') {
                                              echo "selected='selected'";
                                            } ?>>Laki-laki</option>
                  <option value="perempuan" <?php if ($data['profile']['name'] == 'perempuan') {
                                              echo "selected='selected'";
                                            } ?>>Perempuan</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Phone</label>
                <input required name="phone" type="text" class="form-control" id="" aria-describedby="" value="<?= $data['profile']['phone'] ?>">
                <div id="" class="form-text">Tidak boleh kosong.</div>
              </div>
            </div>
          </div>








        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>
      </div>

    </form>

  </div>
</div>






