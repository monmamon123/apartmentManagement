<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT *, concat(firstname, ' ', coalesce(concat(middlename,' '), ''), lastname) as `name` from `student_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="mx-0 py-5 px-3 mx-ns-4 bg-gradient-maroon">
	<h3><b>Student Details</b></h3>
</div>
<div class="row justify-content-center" style="margin-top:-2em;">
	<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
                    <div class="text-right mb-2">
                        <div class="float-right">
                            <?php 
                                $status = isset($status) ? $status : '';
                                switch($status){
                                    case 1:
                                        echo '<span class="badge badge-light bg-gradient-light border text-center px-3 rounded-pill"><i class="fa fa-circle text-maroon mr-2"></i>Active</span>';
                                        break;
                                    case 0:
                                        echo '<span class="badge badge-light bg-gradient-light border text-center px-3 rounded-pill"><i class="far fa-circle mr-2"></i>Inctive</span>';
                                        break;
                                    default:
                                        echo '<span class="badge badge-light bg-gradient-light border text-center px-3 rounded-pill"><i class="far fa-circle mr-2"></i>N/A</span>';
                                        break;
                                }
                            ?>
                        </div>
                    </div>
                    <fieldset class="border-bottom">
                        <legend>School Details</legend>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="code" class="control-label">School ID/Code</label>
                                    <div class="pl-3"><?php echo isset($code) ? $code : ''; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="department" class="control-label">Department</label>
                                    <div class="pl-3"><?php echo isset($department) ? $department : ''; ?></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="course" class="control-label">Course</label>
                                    <div class="pl-3"><?php echo isset($course) ? $course : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border-bottom">
                        <legend>Personal Information</legend>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <div class="pl-3"><?php echo isset($name) ? $name : ''; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="gender" class="control-label">Gender</label>
                                    <div class="pl-3"><?php echo isset($gender) ? $gender : ''; ?></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="contact" class="control-label">Contact #</label>
                                    <div class="pl-3"><?php echo isset($contact) ? $contact : ''; ?></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <div class="pl-3"><?php echo isset($email) ? $email : ''; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="address" class="control-label">Address</label>
                                    <div class="pl-3"><?php echo isset($address) ? $address : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border-bottom">
                        <legend>Emergency Details</legend>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="emergency_name" class="control-label">Name</label>
                                    <div class="pl-3"><?php echo isset($emergency_name) ? $emergency_name : ''; ?></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="emergency_contact" class="control-label">Contact #</label>
                                    <div class="pl-3"><?php echo isset($emergency_contact) ? $emergency_contact : ''; ?></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="emergency_relation" class="control-label">Relation</label>
                                    <div class="pl-3"><?php echo isset($emergency_relation) ? $emergency_relation : ''; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="emergency_address" class="control-label">Address</label>
                                    <div class="pl-3"><?php echo isset($emergency_address) ? $emergency_address : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
				</div>
			</div>	
			<div class="card-footer py-1 text-center">
				<a class="btn btn btn-flat btn-primary btn-sm" href="./?page=students/manage_student&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
				<button class="btn btn btn-flat btn-danger btn-sm" type="button" id="delete-data"><i class="fa fa-trash"></i> Delete</button>
				<a class="btn btn btn-flat btn-light bg-gradient-light border text-dark btn-sm" href="./?page=students"><i class="fa fa-angle-left"></i> Back to List</a>
			</div>
		</div>	
	</div>	
</div>	
<script>
    $(function(){
        $('#delete-data').click(function(){
            _conf("Are you sure to delete this Student?", 'delete_student',['<?= isset($id) ? $id : '' ?>'])
        })
    })
    function delete_student($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_student",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace('./?page=students');
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>