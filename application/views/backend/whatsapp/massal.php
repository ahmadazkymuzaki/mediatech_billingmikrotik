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
<div class="row">
    <div class="col-lg-12">
        <div style="border: 3px solid <?= $backgroundnya ?>;" class="card shadow mb-4">
            <div style="border-bottom: 3px solid <?= $backgroundnya ?>;" class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color : <?= $backgroundnya ?>">Kirim Pesan Massal</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <?php echo form_open_multipart('whatsapp/sendingmassal') ?>
                        <div class="form-group">
                            <label><i>Tujuan Pesan</i></label>
                            <select name="role_id" id="role_id" class="selectpicker show-tick form-control" data-live-search="true" tabindex="-98" required>
                                <option value=""> -- Pilih Tujuan Pesan --</option>
                                <?php
                                $pelanggan = $this->db->get_where('campaign', ['kategori_kontak' => 'PELANGGAN'])->num_rows();
                                $karyawan = $this->db->get_where('campaign', ['kategori_kontak' => 'KARYAWAN'])->num_rows();
                                $operator = $this->db->get_where('campaign', ['kategori_kontak' => 'OPERATOR'])->num_rows();
                                $grup_wa = $this->db->get_where('campaign', ['kategori_kontak' => 'GRUP WA'])->num_rows();
                                $reseller = $this->db->get_where('campaign', ['kategori_kontak' => 'RESELLER'])->num_rows();
                                $sales = $this->db->get_where('campaign', ['kategori_kontak' => 'SALES'])->num_rows();
                                $service = $this->db->get_where('campaign', ['kategori_kontak' => 'SERVICE'])->num_rows();
                                $tambahan = $this->db->get_where('campaign', ['kategori_kontak' => 'TAMBAHAN'])->num_rows();
                                $seluruh = $this->db->get('campaign')->num_rows();
                                ?>
                                <option value="PELANGGAN">Ke Seluruh Kontak PELANGGAN (<?= $pelanggan ?> Orang)</option>
                                <option value="KARYAWAN">Ke Seluruh Kontak KARYAWAN (<?= $karyawan ?> Orang)</option>
                                <option value="OPERATOR">Ke Seluruh Kontak OPERATOR (<?= $operator ?> Orang)</option>
                                <option value="RESELLER">Ke Seluruh Kontak RESELLER (<?= $reseller ?> Orang)</option>
                                <option value="SALES">Ke Seluruh Kontak SALES (<?= $sales ?> Orang)</option>
                                <option value="SERVICE">Ke Seluruh Kontak SERVICE (<?= $service ?> Orang)</option>
                                <option value="TAMBAHAN">Ke Seluruh Kontak TAMBAHAN (<?= $tambahan ?> Orang)</option>
                                <option value="GRUP WA">Ke Seluruh Kontak GRUP WA (<?= $grup_wa ?> grup)</option>
                                <option value="SELURUH">Ke Seluruh Kontak Yang Ada (<?= $seluruh ?> Orang)</option>
                                <?php
                                $data_coverage = $this->db->get('coverage')->result();
                                foreach ($data_coverage as $coverage) {
                                    $jumlah = $this->db->get_where('customer', ['coverage' => $coverage->coverage_id])->num_rows();
                                ?>
                                    <option value="<?= $coverage->coverage_id ?>">Ke Seluruh Kontak di <?= $coverage->address ?> (<?= $jumlah ?> Orang)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><i>Isi Pesan WhatsApp</i></label>
                            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css" rel="stylesheet">
                            <link href="https://www.jquery-az.com/jquery/css/bootstrap-markdown-editor.css" rel="stylesheet">
                            <textarea rows="7" type="text" id="message" name="pesan" class="form-control" placeholder="Halo, Perkenalkan saya Admin @Boss.Net" required></textarea>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>
                            <script src="https://files.billing.or.id/assets/backend/js/markdown-wa.js"></script>
                            <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
                            <script src="https://www.wasap.at/assets/js/lightbox.min.js"></script>
                            <script src="https://www.wasap.at/assets/js/clipboard.min.js"></script>
                            <script src="https://www.wasap.at/assets/js/wasap.js?v=1"></script>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success form-control">Kirim Sekarang</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>