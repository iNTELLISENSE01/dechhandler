<?php

include 'header.php';

$viewTask = $oms->view_task();

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Task List</h1>

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
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <br/>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Task List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Assigned To</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if($viewTask){
                                        foreach ($viewTask as $viewValue) {
                                ?>
                                    <tr class="odd gradeX">
                                        <td><a href="view-task.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['task_name']; ?></a></td>
                                        <td><a href="view-task.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['name']; ?></a></td>
                                        <td><a href="view-task.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['start_date']; ?></a></td>
                                        <td><a href="view-task.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['end_date']; ?></a></td>
                                        <?php
                                            if($viewValue['status'] == 0){
                                        ?>
                                        <td><p class="btn btn-danger btn-xs">Not Started</p></td>
                                        <?php
                                            }
                                            if($viewValue['status'] == 1){
                                        ?>
                                        <td><p class="btn btn-default btn-xs">Pending</p></td>
                                        <?php
                                            }
                                            if($viewValue['status'] == 2){
                                        ?>
                                        <td><p class="btn btn-info btn-xs">In Progress</p></td>
                                        <?php
                                            }
                                            if($viewValue['status'] == 3){
                                        ?>
                                        <td><p class="btn btn-success btn-xs">Completed</p></td>
                                        <?php
                                            }
                                        ?>
                                        <td><a href="edit-task.php?view-id=<?php echo $viewValue['id']; ?>" class="btn btn-success btn-xs">Edit</a> <a href="edit-task.php?view-id=<?php echo $viewValue['id']; ?>" class="btn btn-danger btn-xs">Delete</a></td>
                                    </tr>
                                    <?php
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
                       
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
        include "footer.php";
    ?>