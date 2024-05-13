<?php $this->view('messages') ?>
<?php
if ($company['theme'] == 'primary') {
    $backgroundnya = '#4e73df';
    $colornya = '#fff';
} elseif ($company['theme'] == 'secondary') {
    $backgroundnya = '#6c757d';
    $colornya = '#fff';
} elseif ($company['theme'] == 'success') {
    $backgroundnya = '#1cc88a';
    $colornya = '#fff';
} elseif ($company['theme'] == 'danger') {
    $backgroundnya = '#e74a3b';
    $colornya = '#fff';
} elseif ($company['theme'] == 'warning') {
    $backgroundnya = '#f6c23e';
    $colornya = '#fff';
} elseif ($company['theme'] == 'info') {
    $backgroundnya = '#36b9cc';
    $colornya = '#fff';
} elseif ($company['theme'] == 'dark') {
    $backgroundnya = '#5a5c69';
    $colornya = '#fff';
} elseif ($company['theme'] == 'light') {
    $backgroundnya = '#f8f9fc';
    $colornya = '#000';
} elseif ($company['theme'] == 'default') {
    $backgroundnya = '#ffffff';
    $colornya = '#000';
} elseif ($company['theme'] == 'purple') {
    $backgroundnya = '#6f42c1';
    $colornya = '#fff';
} elseif ($company['theme'] == 'orange') {
    $backgroundnya = '#fd7e14';
    $colornya = '#fff';
} else {
    $backgroundnya = '#e74a3b';
    $colornya = '#fff';
}
?>
<div class="col-lg-12">
    <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
        <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Data Perusahaan</h6>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                    <?php echo form_open_multipart('setting/editCompany') ?>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $company['id'] ?>">
                        <label for="company_name">Nama Perusahaan</label>
                        <input type="text" id="company_name" name="company_name" class="form-control" value="<?= $company['company_name'] ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="nama_singkat">Nama Singkat</label>
                                <input type="text" id="nama_singkat" name="nama_singkat" class="form-control" value="<?= $company['nama_singkat'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="phone">Telepon Perusahaan</label>
                                <input type="number" id="phone" name="phone" class="form-control" value="<?= $company['phone'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sub_name">Slogan / Moto</label>
                        <input type="text" id="sub_name" name="sub_name" class="form-control" value="<?= $company['sub_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="link_app">Link PlayStore APK</label>
                        <input type="text" id="link_app" name="link_app" class="form-control" value="<?= $company['link_app'] ?>">
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="owner">Nama Pemilik</label>
                                <input type="text" id="owner" name="owner" class="form-control" value="<?= $company['owner'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="ppn">Pajak PPN (%)</label>
                                <input type="number" id="ppn" name="ppn" class="form-control" value="<?= $company['ppn'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="whatsapp">Nomor WhatsApp</label>
                                <input type="text" id="whatsapp" name="whatsapp" class="form-control" placeholder="<?= $company['whatsapp'] ?>" value="<?= $company['whatsapp'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="due_date">Jatuh Tempo</label>
                                <input type="number" name="due_date" id="due_date" class="form-control" min="1" max="28" value="<?= $company['due_date'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="padding-bottom: 10px;">
                        <label for="address">Alamat Perusahaan</label>
                        <textarea id="address" name="address" rows="3" class="form-control"><?= $company['address'] ?></textarea>
                    </div>
                    <div class="row">
                        <?php
                        if ($company['theme'] == 'danger') {
                            $warna = 'Terpilih (Merah)';
                        } elseif ($company['theme'] == 'default') {
                            $warna = 'Terpilih (Putih)';
                        } elseif ($company['theme'] == 'secondary') {
                            $warna = 'Terpilih (Abu-Abu)';
                        } elseif ($company['theme'] == 'primary') {
                            $warna = 'Terpilih (Biru Tua)';
                        } elseif ($company['theme'] == 'info') {
                            $warna = 'Terpilih (Biru Muda)';
                        } elseif ($company['theme'] == 'warning') {
                            $warna = 'Terpilih (Kuning)';
                        } elseif ($company['theme'] == 'success') {
                            $warna = 'Terpilih (Hijau)';
                        } elseif ($company['theme'] == 'dark') {
                            $warna = 'Terpilih (Gelap)';
                        } elseif ($company['theme'] == 'light') {
                            $warna = 'Terpilih (Terang)';
                        } elseif ($company['theme'] == 'purple') {
                            $warna = 'Terpilih (Ungu)';
                        } elseif ($company['theme'] == 'orange') {
                            $warna = 'Terpilih (Orange)';
                        } else {
                            $warna = 'Tidak Ada Pilihan';
                        }
                        ?>

                        <?php
                        if ($company['front'] == 'danger') {
                            $warnanya = 'Terpilih (Merah)';
                        } elseif ($company['front'] == 'default') {
                            $warnanya = 'Terpilih (Putih)';
                        } elseif ($company['front'] == 'secondary') {
                            $warnanya = 'Terpilih (Abu-Abu)';
                        } elseif ($company['front'] == 'primary') {
                            $warnanya = 'Terpilih (Biru Tua)';
                        } elseif ($company['front'] == 'info') {
                            $warnanya = 'Terpilih (Biru Muda)';
                        } elseif ($company['front'] == 'warning') {
                            $warnanya = 'Terpilih (Kuning)';
                        } elseif ($company['front'] == 'success') {
                            $warnanya = 'Terpilih (Hijau)';
                        } elseif ($company['front'] == 'dark') {
                            $warnanya = 'Terpilih (Gelap)';
                        } elseif ($company['front'] == 'light') {
                            $warnanya = 'Terpilih (Terang)';
                        } elseif ($company['front'] == 'purple') {
                            $warnanya = 'Terpilih (Ungu)';
                        } elseif ($company['front'] == 'orange') {
                            $warnanya = 'Terpilih (Orange)';
                        } else {
                            $warnanya = 'Tidak Ada Pilihan';
                        }
                        ?>

                        <?php
                        if ($company['tm_frontend'] == 'themes/frontend/default') {
                            $frontendnya = 'Terpilih (DEFAULT)';
                        } elseif ($company['tm_frontend'] == 'themes/frontend/design') {
                            $frontendnya = 'Terpilih (DESIGN)';
                        } elseif ($company['tm_frontend'] == 'themes/frontend/herobiz') {
                            $frontendnya = 'Terpilih (HEROBIZ)';
                        } else {
                            $frontendnya = 'Tidak Ada Pilihan';
                        }
                        ?>

                        <?php
                        if ($company['tm_member'] == 'themes/member/default') {
                            $membernya = 'Terpilih (DEFAULT)';
                        } elseif ($company['tm_member'] == 'themes/member/adminlte320L') {
                            $membernya = 'Terpilih (LTE V3)';
                        } elseif ($company['tm_member'] == 'themes/member/adminlte2418') {
                            $membernya = 'Terpilih (LTE V2)';
                        } elseif ($company['tm_member'] == 'themes/member/adminsneat10') {
                            $membernya = 'Terpilih (SNEAT)';
                        } elseif ($company['tm_member'] == 'themes/member/pixinventstack') {
                            $membernya = 'Terpilih (STACK)';
                        } else {
                            $membernya = 'Tidak Ada Pilihan';
                        }
                        ?>

                        <?php
                        if ($company['tm_backend'] == 'themes/backend/default') {
                            $backendnya = 'Terpilih (DEFAULT)';
                        } elseif ($company['tm_backend'] == 'themes/backend/adminltev320L') {
                            $backendnya = 'Terpilih (LTE V3)';
                        } elseif ($company['tm_backend'] == 'themes/backend/adminltev2418') {
                            $backendnya = 'Terpilih (LTE V2)';
                        } elseif ($company['tm_backend'] == 'themes/backend/adminsneat10') {
                            $backendnya = 'Terpilih (SNEAT)';
                        } elseif ($company['tm_backend'] == 'themes/backend/pixinventstack') {
                            $backendnya = 'Terpilih (STACK)';
                        } else {
                            $backendnya = 'Tidak Ada Pilihan';
                        }
                        ?>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="front">Warna Frontend (default)</label>
                                <select name="front" id="front" class="form-control" required>
                                    <option value="<?php echo $company['front'] ?>">
                                        <?php echo $warnanya ?>
                                        <!-- - Pilih Warna Tema - -->
                                    </option>
                                    <option value="danger">Merah</option>
                                    <option value="default">Putih</option>
                                    <option value="secondary">Abu-Abu</option>
                                    <option value="primary">Biru Tua</option>
                                    <option value="info">Biru Muda</option>
                                    <option value="warning">Kuning</option>
                                    <option value="success">Hijau</option>
                                    <option value="purple">Ungu</option>
                                    <option value="orange">Orange</option>
                                    <option value="dark">Gelap</option>
                                    <option value="light">Terang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="theme">Warna Backend (default)</label>
                                <select name="theme" id="theme" class="form-control" required>
                                    <option value="<?php echo $company['theme'] ?>">
                                        <?php echo $warna ?>
                                        <!-- - Pilih Warna Tema - -->
                                    </option>
                                    <option value="danger">Merah</option>
                                    <option value="default">Putih</option>
                                    <option value="secondary">Abu-Abu</option>
                                    <option value="primary">Biru Tua</option>
                                    <option value="info">Biru Muda</option>
                                    <option value="warning">Kuning</option>
                                    <option value="success">Hijau</option>
                                    <option value="purple">Ungu</option>
                                    <option value="orange">Orange</option>
                                    <option value="dark">Gelap</option>
                                    <option value="light">Terang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="tm_frontend">Tema Frontend</label>
                                <select name="tm_frontend" id="tm_frontend" class="form-control" required>
                                    <option value="<?php echo $company['tm_frontend'] ?>">
                                        <?php echo $frontendnya ?>
                                        <!-- - Pilih Warna Tema - -->
                                    </option>
                                    <option value="themes/frontend/default">DEFAULT</option>
                                    <option value="themes/frontend/design">DESIGN</option>
                                    <option value="themes/frontend/herobiz">HEROBIZ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="tm_member">Tema Member</label>
                                <select name="tm_member" id="tm_member" class="form-control" required>
                                    <option value="<?php echo $company['tm_member'] ?>">
                                        <?php echo $membernya ?>
                                        <!-- - Pilih Warna Tema - -->
                                    </option>
                                    <option value="themes/member/default">DEFAULT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="tm_backend">Tema Backend</label>
                                <select name="tm_backend" id="tm_backend" class="form-control" required>
                                    <option value="<?php echo $company['tm_backend'] ?>">
                                        <?php echo $backendnya ?>
                                        <!-- - Pilih Warna Tema - -->
                                    </option>
                                    <option value="themes/backend/default">DEFAULT</option>
                                    <option value="themes/backend/adminltev320L">LTE V3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="website">Website Perusahaan</label>
                                <input type="text" id="website" name="website" class="form-control" placeholder="<?= $company['website'] ?>" value="<?= $company['website'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group pt-2">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= $company['email'] ?>">
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="billing">Domain Billing</label>
                                <input type="text" id="billing" name="billing" class="form-control" placeholder="<?= $company['billing'] ?>" value="<?= $company['billing'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="nama_database">Nama Database</label>
                                <input type="password" id="nama_database" name="nama_database" class="form-control" value="<?= $company['nama_database'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="user_database">Username Database</label>
                                <input type="text" id="user_database" name="user_database" class="form-control" value="<?= $company['user_database'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="pass_database">Password Database</label>
                                <input type="password" id="pass_database" name="pass_database" class="form-control" value="<?= $company['pass_database'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-body">
                    <div class="form-group">
                        <label for="logo">Logo</label><br>
                        <img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" style=" display: block;
  margin-left: auto;
  margin-right: auto;
  width: 80%;" alt=""> <br>
                        <input type="file" name="logo">
                    </div>
                    <div class="form-group">
                        <label for="about">Description Website</label>
                        <textarea id="about" name="about" rows="3" class="form-control"><?= $company['about'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keyword">Keywords Website</label>
                        <textarea id="keyword" name="keyword" rows="3" class="form-control"><?= $company['keyword'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="refresh">Auto Refresh</label>
                                <input type="number" id="refresh" name="refresh" class="form-control" value="<?= $company['refresh'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="youtube">Channel YouTube</label>
                                <input type="text" id="youtube" name="youtube" class="form-control" placeholder="<?= $company['youtube'] ?>" value="<?= $company['youtube'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="facebook">Username Facebook</label>
                                <input type="text" id="facebook" name="facebook" class="form-control" placeholder="<?= $company['facebook'] ?>" value="<?= $company['facebook'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="instagram">Username Instagram</label>
                                <input type="text" id="instagram" name="instagram" class="form-control" placeholder="<?= $company['instagram'] ?>" value="<?= $company['instagram'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="twitter">Username Twitter</label>
                                <input type="text" id="twitter" name="twitter" class="form-control" placeholder="<?= $company['twitter'] ?>" value="<?= $company['twitter'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div class="form-group">
                                <label for="telegram">Username Telegram</label>
                                <input type="text" id="telegram" name="telegram" class="form-control" placeholder="<?= $company['telegram'] ?>" value="<?= $company['telegram'] ?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <label for="latitude">Latitude</label>
                            <div class="input-group">
                                <input id="input-calendar" type="text" name="latitude" class="form-control" value="<?= $company['latitude'] ?>" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <label for="longitude">Longitude</label>
                            <div class="input-group">
                                <input id="input-calendar" type="text" name="longitude" class="form-control" value="<?= $company['longitude'] ?>" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mt-3">
                            <?php echo $map['js'] ?>
                            <?php echo $map['html'] ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                    <button type="submit" style="border: 1px solid <?= $colornya ?>;" class="btn btn-<?= $company['theme'] ?>">Simpan</button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>