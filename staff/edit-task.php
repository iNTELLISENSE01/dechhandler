<?php
include 'header.php';

$getID = $_GET['view-id'];

$viewTask = $oms->view_task_by_id($getID);

if (isset($_POST['edit-task'])) {
    $editTask = $oms->edit_task($_POST);
}

$viewImp = $oms->view_employee();

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-10">
            <?php
            if (isset($editTask['error'])) {
                echo $editTask['error'];
            }
            ?>
            <h1 class="page-header">Edit Task</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-10">
            <?php if (!empty($viewTask)) { ?>
                <form role="form" method="post">
                    <input type="text" hidden name="id" value="<?= $viewTask->id ?>" />
                    <div class="form-group">
                        <label>Task Name</label>
                        <input type="text" name="task_name" class="form-control" readonly value="<?php echo $viewTask->task_name; ?>">
                        <?php
                        if (isset($editTask['task_name'])) {
                            echo $editTask['task_name'];
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Task Details</label>
                        <textarea name="task_details" class="form-control" readonly rows="3"><?php echo $viewTask->task_details; ?></textarea>
                    </div>
                    <label>Start Date</label>
                    <div class="input-group w-100 form-group " data-provide="">
                        <input type="date" name="start_date" readonly class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy" value="<?php echo $viewTask->start_date; ?>">

                    </div>
                    <label>End Date</label>
                    <div class="input-group form-group w-100 " data-provide="">
                        <input type="date" name="end_date" readonly class="form-control" data-date-format="mm-dd-yyyy" placeholder="mm-dd-yyyy" value="<?php echo $viewTask->end_date; ?>">

                    </div>
                    <div class="form-group">
                        <label>Completion</label>
                        <input type="text" name="completion" class="form-control" value="<?php echo $viewTask->completion; ?>">
                    </div>
                    <input type="submit" name="edit-task" class="btn btn-primary" value="Save">
                <?php
            } else {
                echo '<h2 class="text-danger text-center">No data found!</h2>';
            }
                ?>
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