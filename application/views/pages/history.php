<?php
  $is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : null;

  if ($is_admin != 1) {
    redirect("index");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>OC History</title>
    <link rel="shortcut icon" href="<?php echo base_url('img/favicon.ico'); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('img/favicon.ico'); ?>" type="image/x-icon">
    <script src="https://kit.fontawesome.com/4c890c6a79.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/history.css'); ?>" media="all">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" class="init">
        $(document).ready(function () {
            $('#example tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '"/>');
            })

            var table = $('#example').DataTable({
                initComplete: function () {
                this.api()
                    .columns()
                    .every(function () {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        })
                    })
                },
            })

            $('#example tfoot th').appendTo('#example thead')
        })

        if (<?= $is_admin ?> == 1){
            const tooltipStyle = document.createElement('style')
            tooltipStyle.innerHTML = `
                .datepick,
                .tooltip:hover .tooltiptext,
                .tooltip:hover .tooltiptexttop,
                #addsb,  #historysb {
                    display: block;
                }
            `
            document.head.appendChild(tooltipStyle)
        }
    </script>
</head>
    <div class="sidebar">
        <img id="logo" alt="" src="img/logo.png" />

        <a href="home"><i class="fa fa-home"></i></a>
        <a id="addsb" href="control"><i class="fa fa-user-plus"></i></a>
        <a href="landscape-chart"><i class="fa-sharp fa-solid fa-sitemap"></i>
        <a id="historysb" class="active"><i class="fa-solid fa-clock-rotate-left"></i></a>
        <a href="floorplan-pismu"><i class="fa-sharp fa-solid fa-map-location-dot"></i></a>
    </div>

    <div class="content">
        <div class="headerContent">
            <h1>HISTORY</h1>
        </div>

        <div class="table-content">
            <table id="example" class="display" style="width:100%;">
                <thead>
                    <tr>
                        <th>EMBID</th>
                        <th>Name</th>
                        <th>Action</th>
                        <th>Date</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
            
                <tbody>
                    <?php
                        foreach($orgcharthis as $row){ ?>
                            <tr>
                                <td><?= $row['embid'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['action'] ?></td>
                                <td><?= date('M d, Y', strtotime($row['date'])) ?></td>
                                <td><?= $row['remarks'] ?></td>
                            </tr>
                    <?php }?>
                </tbody>
                
                <tfoot>
                        <th>EMBID</th>
                        <th>Name</th>
                        <th>Action</th>
                        <th>Date</th>
                        <th>Remarks</th>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>