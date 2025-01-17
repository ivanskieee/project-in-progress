<?php

include "handlers/report_handler.php";

?>
<nav class="main-header">
    <div class="col-lg-12 mt-5">
        <div class="row">
            <div class="col-md-12 mb-1">
                <!-- <div class="d-flex justify-content-end w-100">
                    <button class="btn btn-sm btn-success bg-gradient-success mr-3" id="print-btn"><i
                            class="fa fa-print"></i> Print</button>
                </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="callout callout-success">
                    <div class="list-group" id="class-list">

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="callout callout-success" id="printable">
                    <div>
                        <h3 class="text-center">Evaluation Report</h3>
                        <hr>
                        <table width="100%">
                            <tr>
                                <td width="50%">
                                    <p><b>Faculty: <span id="fname"></span></b></p>
                                </td>
                                <td width="50%">
                                    <p><b>Academic Year: <span id="ay">
                                                Semester</span></b></p>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                        </table>
                        <p class=""><b>Total Student Evaluated: <span id="tse">
                                </span></b></p>
                    </div>
                    <fieldset class="border border-success p-2 w-100">
                        <legend class="w-auto">Rating Legend</legend>
                        <p>4 = Strongly Agree, 3 = Agree, 2 = Disagree, 1 = Strongly Disagree</p>
                    </fieldset>
                    <div class="table-responsive">
                        <?php foreach ($criteriaList as $row): ?>
                            <table class="table table-condensed wborder">
                                <thead>
                                    <tr class="bg-gradient-secondary">
                                        <th class=" p-1"><b><?php echo $row['criteria'] ?></b></th>
                                        <th width="5%" class="text-center">1</th>
                                        <th width="5%" class="text-center">2</th>
                                        <th width="5%" class="text-center">3</th>
                                        <th width="5%" class="text-center">4</th>
                                    </tr>
                                </thead>
                                <tbody class="tr-sortable" id="ratings-table-body">
                                    <?php
                                    $hasQuestions = false;

                                    if (is_array($questions)) {
                                        foreach ($questions as $qRow) {
                                            if (is_array($qRow) && $qRow['criteria_id'] == $row['criteria_id']) {
                                                $hasQuestions = true;
                                                ?>
                                                <tr class="bg-white">
                                                    <td class="p-1" width="20%">
                                                        <?= htmlspecialchars($qRow['question']) ?>
                                                        <input type="hidden" name="qid[]" value="<?= $qRow['question_id'] ?>">
                                                    </td>
                                                    <?php for ($c = 0; $c < 4; $c++): ?>
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
                                            <td colspan="7" class="text-center"></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
</nav>
<noscript>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table.wborder tr,
        table.wborder td,
        table.wborder th {
            border: 1px solid gray;
            padding: 3px
        }

        table.wborder thead tr {
            background: #6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important;
            color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }
    </style>
</noscript>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchRatings();
        fetchTotalEvaluations();
    });

    function fetchRatings() {
        fetch('get_faculty_ratings.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update faculty name
                    document.getElementById('fname').innerText = data.faculty_name;

                    // Populate the ratings table with only MCQs
                    const ratingsTable = document.getElementById('ratings-table-body'); // Assuming a table body exists
                    ratingsTable.innerHTML = ''; // Clear old data

                    // Filter MCQ questions and populate the table
                    data.ratings
                        .filter(row => row.question_type === 'mcq') // Only include MCQs
                        .forEach(row => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                        <td>${row.question}</td>
                        <td>${row.rate1}%</td>
                        <td>${row.rate2}%</td>
                        <td>${row.rate3}%</td>
                        <td>${row.rate4}%</td>
                    `;
                            ratingsTable.appendChild(tr);
                        });
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => console.error('Error fetching ratings:', error));
    }
    function fetchTotalEvaluations() {
        fetch('get_total_evaluated.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('tse').innerText = data;
            })
            .catch(error => console.error('Error fetching total evaluations:', error));
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchAcademicInfo(); // Automatically fetch academic information on page load
    });

    function fetchAcademicInfo() {
        fetch('get_academic_info.php') // Modify URL if needed to include specific faculty_id
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update the academic year and semester display
                    const academicYearDisplay = document.getElementById('ay');
                    academicYearDisplay.innerText = `${data.year} - ${data.semester}`;
                } else {
                    console.error('Error:', data.message);
                    document.getElementById('ay').innerText = 'No academic information available.';
                }
            })
            .catch(error => console.error('Error fetching academic information:', error));
    }
</script>