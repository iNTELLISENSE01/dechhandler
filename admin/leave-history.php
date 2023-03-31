<?php
include 'header.php';

if(isset($_POST['leave_type_value'])){
    $leaveType = $oms->save_leave_type($_POST);
}

$viewLeaveType = $oms->view_leave_type();

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Leave History</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="filter">
                        <label class="label-filer">From</label>
                            <div class="input-group form-group date col-lg-3" data-provide="datepicker">
                                <input type="text" name="joining_date" class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                        </div>
                        <label class="label-filer">To</label>
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
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Leave Type</th>
                                        <th>Date from</th>
                                        <th>Date to</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    if($viewLeaveType){
                                        foreach ($viewLeaveType as $LeaveValue) {
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $LeaveValue['leave_type']; ?></td>
                                        <td><?php echo $LeaveValue['leave_type']; ?></td>
                                        <td><?php echo $LeaveValue['leave_type']; ?></td>
                                        <td><?php echo $LeaveValue['leave_type']; ?></td>
                                        <td><?php echo $LeaveValue['leave_type']; ?></td>
                                        <td><a href="edit-leave-type.php?edit_id=<?php echo $LeaveValue['id']; ?>" class="btn btn-success btn-xs">Aprrove</a> <a href="delete-leave-type.php?delete_id=<?php echo $LeaveValue['id']; ?>" class="btn btn-danger btn-xs">Decline</a></td>
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