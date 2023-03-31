<?php

include 'header.php';

$viewImp = $oms->view_employee();

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-10">
            <?php
            if (isset($saveImp['su'])) {
                echo $saveImp['su'];
            }
            ?>
            <h1 class="page-header">View Employees</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DataTables Advanced Tables
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Address</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($viewImp) {
                                foreach ($viewImp as $EmpValue) {
                            ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $EmpValue['name']; ?></td>
                                        <td><?php echo $EmpValue['designation']; ?></td>
                                        <td><?php echo $EmpValue['address']; ?></td>
                                        <td><?php echo $EmpValue['email']; ?></td>

                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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