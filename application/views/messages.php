<?php if ($this->session->has_userdata('success')) { ?>
    <?php if ($company['theme'] == 'danger') { ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i> <?= $this->session->flashdata('success'); ?>
        </div>
    <?php }else{ ?>
        <div class="alert alert-<?= $company['theme'] ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i> <?= $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
<?php } ?>
<?php if ($this->session->flashdata('success-payment')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            html: '<?= $this->session->flashdata('success-payment'); ?>',
            showConfirmButton: true,

        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-sweet')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            html: '<?= $this->session->flashdata('success-sweet'); ?>',
            showConfirmButton: true,

        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('error-sweet')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            html: '<?= $this->session->flashdata('error-sweet'); ?>',
            showConfirmButton: true,

        })
    </script>
<?php endif; ?>
<?php if ($this->session->has_userdata('error')) { ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-ban"></i> <?= $this->session->flashdata('error'); ?>
    </div>
<?php } ?>