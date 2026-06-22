<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Applications Listing</h2>
            </div>
            <div class="x_content">
                <div class="card-box table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 2%">ID</th>
                            <th>Name</th>
                            <th>CNIC</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>ROll NO.</th>
                            <th>Marks</th>
                            <th>Percentage</th>
                            <th>Board</th>
                            <th>Status</th>
                        </tr>
                        <tbody id="result">
                        <?php
                        foreach($applications as $ap){
                            echo "<tr> <td>".$ap['id']."</td>";
                            echo "<td>".$ap['name']."</td>";
                            echo "<td>".$ap['cnic']."</td>";
                            echo"<td>";
                            if($ap['gender'] == MALE){
                                echo "Male";
                            }else{
                                echo"Female";
                            }
                            echo"</td>";
                            echo "<td>".$ap['phone']."</td>";
                            echo "<td>".$ap['roll_no']."</td>";
                            echo "<td>".$ap['marks']."</td>";
                            echo "<td>".$ap['percentage']."%</td>";
                            echo "<td>".$ap['board']."</td>";
                            echo "<td>";
                            if($ap['status'] == INACTIVE){
                                echo "<a href='#' class='btn btn-danger btn-xs'><span class='fa fa-pause'></span> Pending</a>";
                            }else{
                                echo"<a href='#' class='btn btn-success btn-xs'> <span class='fa fa-check'></span> Approved</a>";
                            }
                            echo"</td</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="pull-right">
                        <?php echo $this->pagination->create_links(); ?>                    
                    </div>   
                </div>             
            </div>
        </div>
    </div>
</div>
<script>
    function get_result(){
        var class_id = $("#class_id").val();
        if (parseInt(class_id)) {
            $.ajax({
                url: "<?=base_url('subject/get_result_by_classid')?>",
                type: "POST",
                data: {class_id: class_id},
                success: function (data) {
                    $('#result').html(data);
                }
            });
        }
    }
</script>
