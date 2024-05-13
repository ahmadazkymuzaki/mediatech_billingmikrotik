<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Access-Control-Allow-Origin" content="*"/>
        <meta name="theme-color" content="#e74a3b">
        <meta name="apple-mobile-web-app-status-bar-style" content="#e74a3b" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="description" content="<?= $company['about']; ?>">
        <meta name="author" content="<?= $company['owner']; ?>">
        <meta name="title" content="<?= $company['company_name']; ?>">
        <meta name="keywords" content="<?= $company['keyword']; ?>">
        <meta http-equiv="refresh" content="<?= $company['refresh']; ?>">
        <title><?= $title ?> || Landing <?= $company['nama_singkat'] ?></title>
        <link rel="shortcut icon" href="<?= site_url('assets/images/favicon.png') ?>" sizes="16x16" type="image/png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
		<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
		<link href="https://files.billing.or.id/design/assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
		<link href="https://files.billing.or.id/design/assets/demo/demo.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
            $backgroundnya = '#171941';
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
    </head>
	<body class="profile-page">
		<nav class="navbar navbar-expand-lg fixed-top shadow" style="background: #171941; border-bottom: 2px solid #435db5;">
			<div class="container">
				<div class="navbar-translate">
					<a class="navbar-brand" href="" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
						<img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" alt="logo" class="logo" height="30">
					</a>
					<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-bar bar1"></span>
						<span class="navbar-toggler-bar bar2"></span>
						<span class="navbar-toggler-bar bar3"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse justify-content-end" id="navigation">
					<div class="navbar-collapse-header">
						<div class="row">
							<div class="col-6 collapse-brand">
								<a href="">
									<img src="<?= site_url('assets/images/') ?><?= $company['logo'] ?>" alt="logo" class="logo" height="30">
								</a>
							</div>
							<div class="col-6 collapse-close text-right">
								<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
									<i class="tim-icons icon-simple-remove"></i>
								</button>
							</div>
						</div>
					</div>
					<ul class="navbar-nav">
						<li class="nav-item mt-2 mb-1 <?= $title == 'Halaman Depan' ? 'active' : '' ?>">
							<a href="<?= site_url('front') ?>" style="color: <?= $colornya ?>;"><b>BERANDA</b></a>
						</li>
						<li class="nav-item mt-2 mb-1 <?= $title == 'Download File' ? 'active' : '' ?>">
							<a href="<?= site_url('download.html') ?>" style="color: <?= $colornya ?>;"><b>DOKUMEN</b></a>
						</li>
						<li class="nav-item mt-2 mb-1 <?= $title == 'Syarat dan Ketentuan' ? 'active' : '' ?>">
							<a href="<?= site_url('syarat-dan-ketentuan.html') ?>" style="color: <?= $colornya ?>;"><b>SYARAT</b></a>
						</li>
						<li class="nav-item mt-2 mb-1 <?= $title == 'Kebijakan Privasi' ? 'active' : '' ?>">
							<a href="<?= site_url('kebijakan-privasi.html') ?>" style="color: <?= $colornya ?>;"><b>PRIVASI</b></a>
						</li>
						<li class="nav-item mt-2 mb-1">
							<a href="share" style="color: <?= $colornya ?>;"><b>BAGIKAN</b></a>
						</li>
						<li class="nav-item mt-2 mb-2">
							<a href="download" style="color: <?= $colornya ?>;"><b>DOWNLOAD</b></a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('auth') ?>" style="color: <?= $colornya ?>;">
							    <button class="btn mb-2 my-2 my-sm-0 btn-danger"><b>L O G I N</b></button>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="wrapper">
			<br><br><br>
			<?= $contents ?>
			<br><br><br>
			<nav class="navbar navbar-expand-lg fixed-bottom shadow" style="background: #171941; border-top: 2px solid #435db5;">
				<div class="container">
					<div class="navbar-translate">
						<a class="navbar-brand" href="<?= base_url() ?>" rel="tooltip" title="Created And Developed by <?= $company['owner'] ?>" data-placement="bottom" target="_blank">
							&copy; <?= $company['company_name'] ?>
						</a>
					</div>
				</div>
			</nav>
		</div>
		<script src="https://files.billing.or.id/design/assets/js/core/jquery.min.js" type="text/javascript"></script>
		<script src="https://files.billing.or.id/design/assets/js/core/popper.min.js" type="text/javascript"></script>
		<script src="https://files.billing.or.id/design/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
		<script src="https://files.billing.or.id/design/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
		<script src="https://files.billing.or.id/design/assets/js/plugins/bootstrap-switch.js"></script>
		<script src="https://files.billing.or.id/design/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
		<script src="https://files.billing.or.id/design/assets/js/plugins/chartjs.min.js"></script>
		<script src="https://files.billing.or.id/design/assets/js/plugins/moment.min.js"></script>
		<script src="https://files.billing.or.id/design/assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
		<script src="https://files.billing.or.id/design/assets/demo/demo.js"></script>
		<script src="https://files.billing.or.id/design/assets/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
	</body>
</html>
