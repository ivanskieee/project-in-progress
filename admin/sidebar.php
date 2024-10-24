<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="dropdown">
    <a href="./" class="brand-link">
      <h3 class="text-center p-0 m-0"><b>Admin Panel</b></h3>
    </a>

  </div>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item dropdown">
          <a href="home.php"
            class="nav-link nav-home <?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>"
            style="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'background-color: rgb(51, 128, 64); color: #fff; border: 1px solid #343a40;' : 'background-color: #343a40; color: #fff; border: 1px solid #343a40;'; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a href="subject_list.php"
            class="nav-link nav-subject_list <?php echo in_array(basename($_SERVER['PHP_SELF']), ['subject_list.php']) ? 'active' : ''; ?>"
            style="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['subject_list.php', 'manage_subject.php']) ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fas fa-th-list"></i>
            <p>Subjects</p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a href="class_list.php"
            class="nav-link nav-class_list <?php echo in_array(basename($_SERVER['PHP_SELF']), ['class_list.php']) ? 'active' : ''; ?>"
            style="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['class_list.php', 'manage_class.php']) ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Classes
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a href="academic_list.php"
            class="nav-link nav-academic_list <?php echo in_array(basename($_SERVER['PHP_SELF']), ['academic_list.php']) ? 'active' : ''; ?>"
            style="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['academic_list.php', 'manage_academic.php']) ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
              Academic Year
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a href="questionnaire.php"
            class="nav-link nav-questionnaire <?php echo in_array(basename($_SERVER['PHP_SELF']), ['questionnaire.php']) ? 'active' : ''; ?>"
            style="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['questionnaire.php', 'manage_questionnaire.php']) ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Questionnaires
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a href="criteria_list.php"
            class="nav-link nav-criteria_list <?php echo in_array(basename($_SERVER['PHP_SELF']), ['criteria_list.php']) ? 'active' : ''; ?>"
            style="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['criteria_list.php']) ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Evaluation Criteria
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#"
            class="nav-link nav-edit_user">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Head Faculties
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./" class="nav-link nav-new_user tree-item">
                <i class="nav-icon"></i>
                <p>Add New</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./" class="nav-link nav-user_list tree-item">
                <i class="nav-icon"></i>
                <p>List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#"
            class="nav-link nav-edit_faculty <?php echo in_array(basename($_SERVER['PHP_SELF']), ['new_faculty.php', 'tertiary_faculty_list.php']) ? 'active' : ''; ?>"
            style="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['new_faculty.php', 'tertiary_faculty_list.php']) ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
              Faculties
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link nav-edit_faculty">
                <i class="right fas fa-angle-left"></i>
                <p>Tertiary</p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="new_faculty.php" class="nav-link nav-new_faculty tree-item">
                    <i class="nav-icon"></i>
                    <p>Add New</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="tertiary_faculty_list.php" class="nav-link nav-tertiary_faculty_list tree-item">
                    <i class="nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link nav-edit_faculty">
                <i class="right fas fa-angle-left"></i>
                <p>Secondary</p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="new_faculty.php" class="nav-link nav-new_faculty tree-item">
                    <i class="nav-icon"></i>
                    <p>Add New</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./" class="nav-link nav-faculty_list tree-item">
                    <i class="nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#"
            class="nav-link nav-edit_student <?php echo (basename($_SERVER['PHP_SELF']) == 'new_student.php' || basename($_SERVER['PHP_SELF']) == 'student_list.php') ? 'active' : ''; ?>"
            style="<?php echo (basename($_SERVER['PHP_SELF']) == 'new_student.php' || basename($_SERVER['PHP_SELF']) == 'student_list.php') ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fa ion-ios-people-outline"></i>
            <p>
              Students
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="new_student.php" class="nav-link nav-new_student tree-item">
                <i class="nav-icon"></i>
                <p>Add New</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="student_list.php" class="nav-link nav-student_list tree-item">
                <i class="nav-icon"></i>
                <p>List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="report.php" class="nav-link nav-report <?php echo in_array(basename($_SERVER['PHP_SELF']), ['report.php']) ? 'active' : ''; ?>"
          style="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['report.php']) ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Evaluation Report
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#"
            class="nav-link nav-edit_user <?php echo in_array(basename($_SERVER['PHP_SELF']), ['users.php', 'edit_user.php']) ? 'active' : ''; ?>"
            style="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['new_users.php', 'user_list.php']) ? 'background-color: rgb(51, 128, 64); color: #fff;' : ''; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="new_users.php" class="nav-link nav-new_user tree-item">
                <i class="nav-icon"></i>
                <p>Add New</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="user_list.php" class="nav-link nav-user_list tree-item">
                <i class="nav-icon"></i>
                <p>List</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<script>
  $(document).ready(function () {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
    if (s != '')
      page = page + '_' + s;
    if ($('.nav-link.nav-' + page).length > 0) {
      $('.nav-link.nav-' + page).addClass('active')
      if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
      }
      if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
        $('.nav-link.nav-' + page).parent().addClass('menu-open')
      }

    }

  })

  document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
      if (link.href === window.location.href) {
        link.classList.add('active');
      }
    });
  });
</script>