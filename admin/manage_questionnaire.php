<?php
include 'handlers/questionnaire_handler.php';
?>
<nav class="main-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="card card-success">
                    <div class="card-header">
                        <b><?php echo isset($questionToEdit) ? 'Edit Question' : 'Add New Question'; ?></b>
                    </div>
                    <div class="card-body">
                        <form action="" id="manage-question" method="POST">
                            <input type="hidden" name="question_id"
                                value="<?php echo isset($questionToEdit['question_id']) ? $questionToEdit['question_id'] : ''; ?>">
                            <div class="form-group">
                                <label for="criteria_id">Select Criteria:</label>
                                <select name="criteria_id" id="criteria_id" class="form-control" required>
                                    <option value=""></option>
                                    <?php foreach ($criteriaList as $criteria): ?>
                                        <option value="<?= $criteria['criteria_id'] ?>"
                                            <?= isset($questionToEdit['criteria_id']) && $questionToEdit['criteria_id'] == $criteria['criteria_id'] ? 'selected' : '' ?>>
                                            <?= $criteria['criteria'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="question">Question</label>
                                <textarea name="question" id="question" cols="30" rows="4" class="form-control"
                                    required><?php echo isset($questionToEdit['question']) ? $questionToEdit['question'] : ''; ?></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end w-100">
                            <button type="submit" class="btn btn-sm btn-success btn-flat bg-gradient-success mx-1"
                                form="manage-question" name="submit_question">Save</button>
                            <button class="btn btn-sm btn-flat btn-secondary bg-gradient-secondary mx-1"
                                form="manage-question" type="reset"
                                onclick="window.location.href = './manage_questionnaire.php';">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mt-2">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <b>Evaluation Questionnaire for Academic: </b>
                    </div>
                    <div class="card-body">
                        <fieldset class="border border-success p-2 w-100">
                            <legend class="w-auto">Rating Legend</legend>
                            <p>5 = Strongly Agree, 4 = Agree, 3 = Uncertain, 2 = Disagree, 1 = Strongly Disagree</p>
                        </fieldset>
                        <div class="clear-fix mt-2"></div>
                        <?php foreach ($criteriaList as $row): ?>
                            <table class="table table-condensed">
                                <thead>
                                    <tr class="bg-gradient-secondary">
                                        <th colspan="2" class="p-1"><b><?php echo $row['criteria'] ?></b></th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">1</th>
                                    </tr>
                                </thead>
                                <tbody class="tr-sortable">
                                    <?php
                                    $hasQuestions = false;

                                    if (is_array($questions)) {
                                        foreach ($questions as $qRow) {
                                            if (is_array($qRow) && $qRow['criteria_id'] == $row['criteria_id']) {
                                                $hasQuestions = true;
                                                ?>
                                                <tr class="bg-white">
                                                    <td class="p-1 text-center" width="5%">
                                                        <span class="btn-group dropright">
                                                            <span type="button" class="btn" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </span>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item edit_question"
                                                                    href="manage_questionnaire.php?question_id=<?php echo $qRow['question_id']; ?>">Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <form method="post" action="manage_questionnaire.php"
                                                                    style="display: inline;">
                                                                    <input type="hidden" name="delete_id"
                                                                        value="<?= $qRow['question_id'] ?>">
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Are you sure you want to delete this question?');">Delete</button>
                                                                </form>
                                                            </div>
                                                        </span>
                                                    </td>
                                                    <td class="p-1" width="20%">
                                                        <?= htmlspecialchars($qRow['question']) ?>
                                                        <input type="hidden" name="qid[]" value="<?= $qRow['question_id'] ?>">
                                                    </td>
                                                    <?php for ($c = 0; $c < 5; $c++): ?>
                                                        <td class="text-center">
                                                            <div class="icheck-success d-inline">
                                                                <input type="radio" name="qid[<?= $qRow['question_id'] ?>][]"
                                                                    id="qradio<?= $qRow['question_id'] . '_' . $c ?>" value="<?= $c + 1 ?>">
                                                                <label for="qradio<?= $qRow['question_id'] . '_' . $c ?>"></label>
                                                            </div>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    if (!$hasQuestions): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No questions available for the selected
                                                criteria.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>