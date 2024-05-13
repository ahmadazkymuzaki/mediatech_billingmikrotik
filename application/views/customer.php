<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    <meta name="theme-color" content="#e74a3b">
    <meta name="apple-mobile-web-app-status-bar-style" content="#e74a3b" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="<?= $company['about']; ?>">
    <meta name="author" content="<?= $company['owner']; ?>">
    <meta name="title" content="<?= $company['company_name']; ?>">
    <meta name="keywords" content="<?= $company['keyword']; ?>">
    <meta http-equiv="refresh" content="<?= $company['refresh']; ?>">

    <title><?= $title ?> || Administrator <?= $company['nama_singkat'] ?></title>
    <link rel="shortcut icon" href="<?= site_url('assets/images/favicon.png') ?>" sizes="16x16" type="image/png">
    <!-- Custom fonts for this template-->
    <link href="https://files.billing.or.id/assets/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <!-- Custom styles for this template-->
    <link href="https://files.billing.or.id/assets/backend/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css">
    <!-- Custom styles for this page -->
    <link href="https://files.billing.or.id/assets/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/backend/css/select2.min.css" rel="stylesheet">
    <link href="https://files.billing.or.id/assets/backend/css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://files.billing.or.id/assets/backend/leaflet-search.css" />
    <script src="https://files.billing.or.id/assets/backend/leaflet-search.js"></script>
    <script src="https://unpkg.com/@ngageoint/leaflet-geopackage@2.0.5/dist/leaflet-geopackage.min.js"></script>
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
    <?php if ($company['theme'] == 'primary') {
        $backgroundnya = '#4e73df';
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
    <?php } elseif ($company['theme'] == 'secondary') {
        $backgroundnya = '#6c757d';
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
    <?php } elseif ($company['theme'] == 'success') {
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
    <?php } elseif ($company['theme'] == 'danger') {
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
    <?php } elseif ($company['theme'] == 'warning') {
        $backgroundnya = '#f6c23e';
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
    <?php } elseif ($company['theme'] == 'info') {
        $backgroundnya = '#36b9cc';
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
    <?php } elseif ($company['theme'] == 'dark') {
        $backgroundnya = '#5a5c69';
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
    <?php } elseif ($company['theme'] == 'light') {
        $backgroundnya = '#f8f9fc';
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
    <?php } elseif ($company['theme'] == 'default') {
        $backgroundnya = '#ffffff';
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
    <?php } elseif ($company['theme'] == 'purple') {
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
    <?php } elseif ($company['theme'] == 'orange') {
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
</head>

<body id="page-top" class="sidebar-toggled">
    <?php if ($user['email'] == '') {
        redirect('auth/logout');
    } ?>
    <?php if ($user['role_id'] == 2) {
        $this->session->set_flashdata('error', 'Akses dilarang');
        redirect('member');
    } ?>
    <?php if ($user['role_id'] != 1 && $user['role_id'] != 3 && $user['role_id'] != 4 && $user['role_id'] != 5 && $user['role_id'] != 6 && $user['role_id'] != 9 && $user['role_id'] != 10) {
        $this->session->set_flashdata('error', 'Akses dilarang');
        redirect('auth/logout');
    } ?>
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline text-gray-600 small" style="line-height: 17px;">
                                    <b style="margin-left:-5px">
                                        <?php function get_client_ip()
                                        {
                                            $ipaddress = '';
                                            if (isset($_SERVER['HTTP_CLIENT_IP']))
                                                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                                            else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                                                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                            else if (isset($_SERVER['HTTP_X_FORWARDED']))
                                                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                                            else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
                                                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                                            else if (isset($_SERVER['HTTP_FORWARDED']))
                                                $ipaddress = $_SERVER['HTTP_FORWARDED'];
                                            else if (isset($_SERVER['REMOTE_ADDR']))
                                                $ipaddress = $_SERVER['REMOTE_ADDR'];
                                            else
                                                $ipaddress = 'IP tidak dikenali';
                                            return $ipaddress;
                                        } ?>
                                        IP ADDRESS &nbsp; : &nbsp; <?php echo get_client_ip(); ?> &nbsp;
                                        <?php
                                        ?>
                                    </b>
                                </span>
                                <img class="img-profile rounded-circle" src="<?= site_url(''); ?>assets/images/profile/<?= $user['image']; ?>" alt="" style="margin-left: 5px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-item">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-black-400"></i>
                                    <b>
                                        <?= $user['name']; ?>
                                    </b>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>
                                    <b>
                                        Keluar
                                    </b>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <?= $contents ?>
                </div>
            </div>
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; Copyright <?= date('Y') ?> - Developed by
                            <a href="https://facebook.com/<?= $company['facebook']; ?>" target="_blank" style="text-decoration: none; color:black">
                                <?= $company['nama_singkat']; ?>
                            </a>
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="<?= site_url('auth/logout/') ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/bootstrap-select.js"></script>
    <!-- <script src="<?= site_url('assets/') ?>ajax_daerah.js"></script> -->
    <script src="https://files.billing.or.id/assets/backend/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/sb-admin-2.js"></script>
    <script src="https://files.billing.or.id/assets/backend/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://files.billing.or.id/assets/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/demo/datatables-demo.js"></script>
    <script src="https://files.billing.or.id/assets/backend/js/select2.full.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tablebt').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: ['copy'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: ['csv'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: ['excel'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: ['pdf'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: ['print'],
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            oTable = jQuery('#dataTableDraf').dataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "aoColumns": [{
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": true
                    },

                    {
                        "bSortable": true
                    },
                    {
                        "bSortable": false
                    }
                ]
            });
        })
    </script>
    <script>
        var serverClock = jQuery("#jamServer");
        if (serverClock.length > 0) {
            showServerTime(serverClock, serverClock.text());
        }

        function showServerTime(obj, time) {
            var parts = time.split(":"),
                newTime = new Date();

            newTime.setHours(parseInt(parts[0], 10));
            newTime.setMinutes(parseInt(parts[1], 10));
            newTime.setSeconds(parseInt(parts[2], 10));

            var timeDifference = new Date().getTime() - newTime.getTime();

            var methods = {
                displayTime: function() {
                    var now = new Date(new Date().getTime() - timeDifference);
                    obj.text([
                        methods.leadZeros(now.getHours(), 2),
                        methods.leadZeros(now.getMinutes(), 2),
                        methods.leadZeros(now.getSeconds(), 2)
                    ].join(":"));
                    setTimeout(methods.displayTime, 500);
                },

                leadZeros: function(time, width) {
                    while (String(time).length < width) {
                        time = "0" + time;
                    }
                    return time;
                }
            }
            methods.displayTime();
        }
    </script>
    <script>
        function detail_loc(param) {
            $('div#modal-id').modal('show');
        }

        function setMapToForm(latitude, longitude) {
            $('input[name="latitude"]').val(latitude.toFixed(5));
            $('input[name="longitude"]').val(longitude.toFixed(5));
        }
    </script>
    <script src="https://files.billing.or.id/assets/js/sweetalert2.all.min.js"></script>
    <script src="https://files.billing.or.id/assets/js/myscript.js"></script>
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
    <script>
        $(window).resize(function() {
            if ($(window).width() < 767) {
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
                if ($(".sidebar").hasClass("toggled")) {
                    $('.sidebar .collapse').collapse('hide');
                };
            };
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($(window).width() < 767) {
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
                if ($(".sidebar").hasClass("toggled")) {
                    $('.sidebar .collapse').collapse('hide');
                };
            }
        });
    </script>
</body>

</html>