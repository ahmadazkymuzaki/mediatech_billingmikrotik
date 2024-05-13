<style>
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-track:hover {
            background: #f1f1f1;
        }
    </style>
    <?php if ($company['front'] == 'primary') {
        $backgroundnya = '#0ea2bd';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'secondary') {
        $backgroundnya = '#485664';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'success') {
        $backgroundnya = '#1cc88a';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'danger') {
        $backgroundnya = '#dc3545';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'warning') {
        $backgroundnya = '#ffc107';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'info') {
        $backgroundnya = '#0dcaf0';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'dark') {
        $backgroundnya = '#212529';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'light') {
        $backgroundnya = '#f8f9fa';
        $colornya = '#000';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'default') {
        $backgroundnya = '#1a1f24';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'purple') {
        $backgroundnya = '#6f42c1';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } elseif ($company['front'] == 'orange') {
        $backgroundnya = '#fd7e14';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } else {
        $backgroundnya = '#e74a3b';
        $colornya = '#fff';
        $colorsub = '#000';
    ?>
        <style>
            ::-webkit-scrollbar-thumb {
                background: <?= $backgroundnya ?>;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: <?= $backgroundnya ?>;
            }
        </style>
    <?php } ?>
<div class="container-fluid"><br>
    <div class="card" style="min-height:499px; max-height:499px">
        <div class="card-header text-center" style="background: <?= $backgroundnya ?>; color: <?= $colornya ?>;">
            <h4 class="card-title text-center" style="color: <?= $colornya ?>"><b>Media Download</b></h4>
        </div>
        <div class="card-body overflow-auto">
            <div class="table-responsive">
                <table class="table table-bordered" style="border: 1px solid <?= $backgroundnya ?>;" id="tablebt" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" style="color: <?= $backgroundnya ?>;">No</th>
                            <th class="text-center" style="color: <?= $backgroundnya ?>;">Nama File</th>
                            <th class="text-center" style="color: <?= $backgroundnya ?>;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($media as $r => $data) { ?>
                            <tr>
                                <td class="text-center" width="35px" style="color: <?= $backgroundnya ?>;"><?= $no++ ?></td>
                                <td style="color: <?= $backgroundnya ?>;"><?= $data->name ?></td>
                                <td  style="color: <?= $backgroundnya ?>;"class="text-center">
                                    <a class="btn btn-xs btn-success" href="<?= $data->link ?><?= $data->media ?>"><i class="fa fa-download"> </i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>