<?php $totalCU = 0;
foreach ($bill as  $data)
    $totalCU += (int) $data->code_unique;
?>
<div class="table-responsive"><span style="color: red;">*Catatan :</span> <br>
    Total donasi anda senilai <b>Rp. <?= indo_currency($totalCU) ?></b> Rupiah, diambil dari total kode unik pelanggan setiap bulannya, ini hanya gambaran saja, boleh dikurangi ataupun ditambah, karena kita tidak memandang nominal yang penting ikhlas dan berkah. <br>
    <p></p>
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr style="text-align: center">
                <th style="text-align: center; width:20px">No</th>
                <th>No Layanan</th>
                <th>Nama Pelanggan</th>
                <th>No. Invoice</th>
                <th>Periode</th>
                <th>Total</th>
                <th>Kode Unik</th>
            </tr>
        </thead>
        <tfoot>
            <tr>

                <th colspan="6" style="text-align: right">Total</th>
                <th style="text-align: right"><?= indo_currency($totalCU) ?></th>
            </tr>
        </tfoot>
        <tbody>
            <?php $no = 1;
            foreach ($bill as $r => $data) { ?>
                <tr>
                    <td style="text-align: center"><?= $no++ ?>.</td>
                    <td style="text-align: center"><?= $data->no_services ?> </td>
                    <td><?= $data->name ?></td>
                    <td><?= $data->invoice ?></td>
                    <td>
                        <?= indo_month($data->month) ?>
                        <?= $data->year ?></td>
                    <td style="text-align: right"> <?php $query = "SELECT *
                                    FROM `invoice_detail`
                                        WHERE `invoice_detail`.`invoice_id` =  $data->invoice";
                                                    $querying = $this->db->query($query)->result(); ?>
                        <?php $subtotal = 0;
                        foreach ($querying as  $dataa)
                            $subtotal += (int) $dataa->total;
                        ?>
                        <?= indo_currency($subtotal + $data->code_unique) ?></td>
                    <td style="text-align: right;"> <?= $data->code_unique  ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if ($totalCU != '') { ?>
        * Terbilang : <?= number_to_words($totalCU) ?> Rupiah
    <?php } ?>
</div>