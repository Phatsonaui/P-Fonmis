<div class="container-fluid">
    <div class="row card-group">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header d-flex" style="justify-content: space-between;">
                    <div class="justify-content-start">
                        <h2>แผนกลยุทธ์</h2>
                    </div>
                    <div class="justify-content-end">
                        <select class="form-select select-sm" name="year-section" id="year-section">
                            <?php
                            $dbstg = new Database('nurse');
                            $dbstg->Table = "stg_strategic";
                            $dbstg->Where = "order by strategic_year DESC ";
                            $userstg = $dbstg->Select();
                            foreach ($userstg as $valuesstg => $datastg) {
                                $yeae = $datastg['strategic_year'] + 543;
                                echo "<option value=\"$datastg[strategic_year]\">$yeae</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row g-3 card-body mt-2">
                    <div id="data_kpi" class="row"></div>
                </div>
            </div>
        </div>
        <?php include "t_roi.php"; ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var today = new Date().toISOString().slice(0, 10);
        var currentDate = new Date();
        var initialYear = currentDate.getFullYear().toString(); //ปีปัจจุ บัน
        // var initialYear = 2024;
        fetchData(initialYear);

        $('#year-section').change(function() {
            selectedYear = $(this).val();

            fetchData(selectedYear);
        });

        function fetchData(year) {
            $.ajax({
                url: 'config/get_data_kpi_graph.php',
                method: 'POST',
                data: {
                    year: year
                },
                success: function(data) {
                    $('#data_kpi').html(data);
                }
            });
        }

    });
</script>