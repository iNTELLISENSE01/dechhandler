<?php
include 'header.php';

// if (isset($_POST['leave_type_value'])) {
//     $leaveType = $oms->save_leave_type($_POST);
// }

$viewLeaveHist = $oms->view_leave_history();

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="page-header">Leave History</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="filter">
        <label class="label-filter">From</label>
        <div class="input-group form-group date col-lg-3" data-provide="datepicker">
            <input type="text" name="joining_date" class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
        <label class="label-filter">To</label>
        <div class="input-group form-group date col-lg-3" data-provide="datepicker">
            <input type="text" name="joining_date" class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Leave History
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Leave Type</th>
                                <th>Date from</th>
                                <th>Date to</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($viewLeaveHist) {
                                foreach ($viewLeaveHist as $LeaveValue) {
                            ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $LeaveValue['leave_type']; ?></td>
                                        <td><?php echo $LeaveValue['date_from']; ?></td>
                                        <td><?php echo $LeaveValue['date_to']; ?></td>
                                        <td>
                                            <?php
                                            if ($LeaveValue["granted"] == 0)
                                                echo '<span class="btn btn-warning btn-xs">Pending</span>';
                                            elseif ($LeaveValue["granted"] == 1)
                                                echo '<span class="btn btn-success btn-xs">Granted</span>';
                                            elseif ($LeaveValue["granted"] == -1)
                                                echo '<span class="btn btn-danger btn-xs">Declined</span>';

                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <center>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </center>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php
include "footer.php";
?>