<?php
include 'handlers/class_handler.php';
?>

<nav class="main-header">
    <div class="col-lg-12 mt-3">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-success new_class"
                        href="manage_class.php">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="list">
                        <colgroup>
                            <col width="5%">
                            <col width="60%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($classes as $row): ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td>
                                        <b>
                                            <?php echo htmlspecialchars(ucwords($row['course'] . ' -' . ' ' . $row['level'] . ' -' . ' ' . $row['section'])); ?>
                                        </b>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="manage_class.php?class_id=<?php echo $row['class_id']; ?>"
                                                class="btn btn-success  manage_class">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="post" action="class_list.php" style="display: inline;">
                                                <input type="hidden" name="delete_id"
                                                    value="<?php echo isset($row['class_id']) ? $row['class_id'] : ''; ?>">
                                                <button type="submit" class="btn btn-secondary  delete_class"
                                                    onclick="return confirm('Are you sure you want to delete this class?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#list').dataTable();

        // Event for adding a new class
        $('.new_class').on('click', function () {
            uni_modal("New Class", "<?php echo $_SESSION['login_view_folder'] ?>manage_class.php");
        });

        // Event for managing a class (edit)
        $('.manage_class').on('click', function () {
            const classId = $(this).data('id');
            uni_modal("Manage Class", "<?php echo $_SESSION['login_view_folder'] ?>manage_class.php?id=" + classId);
        });

        // Event for deleting a class
        $('.delete_class').on('click', function () {
            const classId = $(this).data('id');
            _conf("Are you sure you want to delete this class?", "delete_class", [classId]);
        });
    });

    // Function to delete a class using AJAX
    function delete_class(id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_class',
            method: 'POST',
            data: { id: id },
            success: function (response) {
                if (response == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function () {
                        location.reload(); // Reload the page after deletion
                    }, 1500);
                } else {
                    alert_toast("Failed to delete data", 'error');
                }
            },
            error: function (xhr, status, error) {
                alert_toast("An error occurred: " + error, 'error');
            }
        });
    }
</script>