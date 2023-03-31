<?php

include 'header.php';

//Count Send Item  
$countSent = $oms->count_sent($id);

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Inbox Message</h1>
                   
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
                            Message Inbox
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Form</th>
                                        <th>Subject</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    if($viewInbox){
                                        foreach ($viewInbox as $viewValue) {
                                            if($viewValue['message_read'] == 2){
                                ?>
                                    <tr class="odd gradeX" style="color: #999; font-weight: bold;">
                                        <td><?php echo $i; ?></td>
                                        <td><a href="view-inbox-message.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['name']; ?></a></td>
                                        <td><a href="view-inbox-message.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['subject']; ?></a></td>
                                        <td><?php echo $viewValue['date_times']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                        else{
                                    ?>
                                        <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><a href="view-inbox-message.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['name']; ?></a></td>
                                        <td><a href="view-inbox-message.php?view-id=<?php echo $viewValue['id']; ?>"><?php echo $viewValue['subject']; ?></a></td>
                                        <td><?php echo $viewValue['date_times']; ?></td>
                                    </tr>
                                    <?php
                                            }
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