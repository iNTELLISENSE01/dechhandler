<?php
include "header.php";

if (isset($_POST['save-leave'])) {
    $saveLeave = $oms->save_leave($_POST);
}

$viewLeaveType = $oms->view_leave_type();

$viewImp = $oms->view_employee();

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-10">
            <?php
            if (isset($saveLeave['su'])) {
                echo $saveLeave['su'];
            }
            ?>
            <h1 class="page-header">Request Leave</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-10">
            <form role="form" method="post">

                <div class="form-group">
                    <label>Leave Type</label>
                    <select name="leave_type" class="form-control">
                        <option value="">--- Select ---</option>
                        <?php
                        if (isset($viewLeaveType)) {
                            foreach ($viewLeaveType as $value) {
                        ?>
                                <option value="<?php echo $value['leave_type']; ?>"> <?php echo $value['leave_type']; ?> </option>
                        <?php }
                        } ?>
                    </select>
                    <?php
                    if (isset($saveLeave['leave_type'])) {
                        echo $saveLeave['leave_type'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label>Reason</label>
                    <textarea name="reason" class="form-control" rows="3"></textarea>
                </div>
                <label>Date From</label>
                <div class="input-group w-100 form-group dae" data-provide="dateicker">
                    <input type="date" name="date_from" min="<?= date("Y-m-d") ?>" class="form-control">
                    <?php
                    if (isset($saveLeave['date_from'])) {
                        echo $saveLeave['date_from'];
                    }
                    ?>
                </div>
                <label>Date To</label>
                <div class="input-group w-100 form-group ate" data-provide="datepiker">
                    <input type="date" name="date_to" min="<?= date("Y-m-d") ?>" class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy">
                    <?php
                    if (isset($saveLeave['date_to'])) {
                        echo $saveLeave['date_to'];
                    }
                    ?>
                </div>
                <input type="submit" name="save-leave" class="btn btn-primary" value="Save">
            </form>
        </div>
    </div>
    <div class="cliyerfix"></div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php
include "footer.php";
?>