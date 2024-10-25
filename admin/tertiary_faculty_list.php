<?php
include "handlers/faculty_handler.php"; // Handle faculty-related operations
?>

<nav class="main-header">
    <div class="col-lg-12 mt-3">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-success" href="new_faculty.php"><i
                            class="fa fa-plus"></i> Add New Faculty</a>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-8 col-md-4 ms-auto mt-3 mr-3">
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search Tertiary Faculties">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="list">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>School ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($tertiary_faculties as $row): ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo $row['school_id'] ?></b></td>
                                    <td><b><?php echo ucwords($row['firstname'] . ' ' . $row['lastname']) ?></b></td>
                                    <td><b><?php echo $row['email'] ?></b></td>
                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="true">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="new_faculty.php?faculty_id=<?php echo $row['faculty_id']; ?>">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form method="post" action="tertiary_faculty_list.php" style="display: inline;"
                                                class="delete-form" id="delete-form">
                                                <input type="hidden" name="delete_id"
                                                    value="<?php echo isset($row['faculty_id']) ? $row['faculty_id'] : ''; ?>">
                                                <button type="submit" class="dropdown-item"
                                                    onclick="confirmDeletion()">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p id="noRecordsMessage" style="display:none; color: black;" class="ml-1">No tertiary faculty found.</p>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function () {
        $(document).on('submit', '.delete-form', function (e) {
            e.preventDefault();
            var form = this;

            Swal.fire({
                title: 'Are you sure?',
                text: 'This action will permanently delete the faculty.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    $.ajax({
                        type: 'POST',
                        url: 'tertiary_faculty_list.php', 
                        data: $(form).serialize(),
                        success: function () {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Faculty deleted successfully.',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = 'tertiary_faculty_list.php'; 
                            });
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Error deleting faculty. Please try again.',
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        var searchValue = this.value.toLowerCase();
        var rows = document.querySelectorAll('#list tbody tr');
        var noRecordsMessage = document.getElementById('noRecordsMessage');
        var matchesFound = false;

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var matches = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchValue)) {
                    matches = true;
                }
            });

            if (matches) {
                row.style.display = '';
                matchesFound = true;
            } else {
                row.style.display = 'none';
            }
        });

        if (matchesFound) {
            noRecordsMessage.style.display = 'none';
        } else {
            noRecordsMessage.style.display = '';
        }
    });
</script>