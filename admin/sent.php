<?php

include 'header.php';

//Count Send Item  
$viewSent = $oms->view_sent($id);
$countSent = $oms->count_sent($id);

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Sent Message</h1>

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
            <div class="row">
                <div class="col-lg-10">
                    <a href="compose.php" class="btn btn-info">Compose</a>
                    <a href="message.php" class="btn btn-primary" type="button">Inbox <span class="badge"><?php if(isset($countInbox)){ echo $countInbox; } ?></span></a>
                    <a href="sent.php" class="btn btn-success" type="button">Sent <span class="badge"><?php if(isset($countSent)){ echo $countSent; } ?></span></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <br/>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Message Sent
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>To</th>
                                        <th>Subject</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    if($viewSent){
                                        foreach ($viewSent as $viewValue) {
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><a href="view-sent-message.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['name']; ?></a></td>
                                        <td><a href="view-sent-message.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['subject']; ?></a></td>
                                        <td><?php echo $viewValue['date_times']; ?></td>
                                    </tr>
                                    <?php
                                        $i++;
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