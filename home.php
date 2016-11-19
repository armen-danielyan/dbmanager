<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// select loggedin users detail
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res);
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Homepage</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    <body>

    <header>

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Logo</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link 1</a></li>
                        <li><a href="#">Link 2</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span> <?php echo $userRow['userName']; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
    </header>



    <main>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Title</div>

                        <div class="panel-body">
                            <p>Panel Tools</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>Order Date</th>
                                        <th>ASIN</th>
                                        <th>SKU</th>
                                        <th>Final QTY</th>
                                        <th>Whole Sale Cost</th>
                                        <th>Top Rep Ship Cost</th>
                                        <th>Top Rep Ship Percent</th>
                                        <th>Total Handling Cost</th>
                                        <th>Handling Percent</th>
                                        <th>To AMZN Shipping</th>
                                        <th>To AMZN Shipping Percent</th>
                                        <th>Row Complete</th>
                                        <th>Final Cost</th>
                                        <th>Notes</th>
                                        <th>Last Update</th>
                                        <th>Paid Date</th>
                                        <th>ASIN Manufacturer</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                $rows = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM data"));
                                $pages = ceil($rows / 10);
                                $currPage = ($_GET['page'] && $_GET['page'] >= 1 && $_GET['page'] <= $pages) ? $_GET['page'] : 1;
                                $rowsPerPage = 10;
                                $rowNum = ($currPage - 1) * 10;

                                $qs = "SELECT * FROM data LIMIT $rowsPerPage OFFSET $rowNum";
                                $data = mysqli_query($conn, $qs);

                                if (mysqli_num_rows($data) > 0) {
                                    while ($dataRow = mysqli_fetch_assoc($data)) { ?>
                                        <tr>
                                            <th><?php echo ++$rowNum; ?></th>
                                            <td><?php echo $dataRow['orderdate']; ?></td>
                                            <td><?php echo $dataRow['asin']; ?></td>
                                            <td><?php echo $dataRow['sku']; ?></td>
                                            <td><?php echo $dataRow['finalqty']; ?></td>
                                            <td><?php echo $dataRow['wholesalecost']; ?></td>
                                            <td><?php echo $dataRow['toprepshipcost']; ?></td>
                                            <td><?php echo $dataRow['toprepshippercent']; ?></td>
                                            <td><?php echo $dataRow['totalhandlingcost']; ?></td>
                                            <td><?php echo $dataRow['handlingpercent']; ?></td>
                                            <td><?php echo $dataRow['toamznshipping']; ?></td>
                                            <td><?php echo $dataRow['toamznshippingpercent']; ?></td>
                                            <td><?php echo $dataRow['rowcomplete']; ?></td>
                                            <td><?php echo $dataRow['finalcost']; ?></td>
                                            <td><?php echo $dataRow['notes']; ?></td>
                                            <td><?php echo $dataRow['lastupdate']; ?></td>
                                            <td><?php echo $dataRow['paiddate']; ?></td>
                                            <td><?php echo $dataRow['asinmanufacturer']; ?></td>
                                            <td>
                                                <span class="glyphicon glyphicon-edit"></span>
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    echo "0 results";
                                } ?>


                                </tbody>
                            </table>
                    </div>

                        <div class="panel-footer">Tools</div>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>

    </main>

    <script src="assets/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    </body>
    </html>
<?php ob_end_flush(); ?>