<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `student_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="mx-0 py-5 px-3 mx-ns-4 bg-gradient-maroon">
	<h3><b><?= isset($id) ? "Update Student Details" : "Register New Student" ?></b></h3>
</div>
<div class="row justify-content-center" style="margin-top:-2em;">
	<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
					<form action="" id="student-form">
						<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
						<fieldset class="border-bottom">
							<legend>School Details</legend>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="code" class="control-label">School ID/Code</label>
										<input type="text" name="code" id="code" class="form-control form-control-sm rounded-0" value="<?php echo isset($code) ? $code : ''; ?>"  required/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="department" class="control-label">Department</label>
										<input type="text" name="department" id="department" class="form-control form-control-sm rounded-0" value="<?php echo isset($department) ? $department : ''; ?>"  required/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="course" class="control-label">Course</label>
										<input type="text" name="course" id="course" class="form-control form-control-sm rounded-0" value="<?php echo isset($course) ? $course : ''; ?>"  required/>
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="border-bottom">
							<legend>Personal Information</legend>
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="firstname" class="control-label">First Name</label>
										<input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" value="<?php echo isset($firstname) ? $firstname : ''; ?>"  required/>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="middlename" class="control-label">Middle Name</label>
										<input type="text" name="middlename" id="middlename" class="form-control form-control-sm rounded-0" value="<?php echo isset($middlename) ? $middlename : ''; ?>"  placeholder="optional"/>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="lastname" class="control-label">Last Name</label>
										<input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" value="<?php echo isset($lastname) ? $lastname : ''; ?>"  required/>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="gender" class="control-label">Gender</label>
										<select type="text" name="gender" id="gender" class="form-control form-control-sm rounded-0" required>
											<option value="Male" <?= isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
											<option value="Female" <?= isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="contact" class="control-label">Contact #</label>
										<input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" value="<?php echo isset($contact) ? $contact : ''; ?>"  required/>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="email" class="control-label">Email</label>
										<input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" value="<?php echo isset($email) ? $email : ''; ?>"  required/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="address" class="control-label">Address</label>
										<textarea rows="3" name="address" id="address" class="form-control form-control-sm rounded-0" required><?= isset($address) ? $address : '' ?></textarea>
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
										<input type="text" name="emergency_name" id="emergency_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($emergency_name) ? $emergency_name : ''; ?>"  required/>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="emergency_contact" class="control-label">Contact #</label>
										<input type="text" name="emergency_contact" id="emergency_contact" class="form-control form-control-sm rounded-0" value="<?php echo isset($emergency_contact) ? $emergency_contact : ''; ?>"  required/>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="emergency_relation" class="control-label">Relation</label>
										<input type="text" name="emergency_relation" id="emergency_relation" class="form-control form-control-sm rounded-0" value="<?php echo isset($emergency_relation) ? $emergency_relation : ''; ?>"  required/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="emergency_address" class="control-label">Address</label>
										<textarea rows="3" name="emergency_address" id="emergency_address" class="form-control form-control-sm rounded-0" required><?= isset($emergency_address) ? $emergency_address : '' ?></textarea>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="status" class="control-label">Status</label>
									<select name="status" id="status" class="form-control form-control-sm rounded-0" required>
										<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
										<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
									</select>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>	
			<div class="card-footer py-1 text-center">
				<button class="btn btn btn-flat btn-primary btn-sm" form="student-form"><i class="fa fa-save"></i> Save</button>
				<a class="btn btn btn-flat btn-light bg-gradient-light border text-dark btn-sm" href="./?page=students"><i class="fa fa-angle-left"></i> Cancel</a>
			</div>
		</div>	
	</div>	
</div>	

<script>
	$(document).ready(function(){
		$('#student-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_student",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.replace('./?page=students/view_student&id='+resp.sid)
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body, .modal").scrollTop(0)
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

	})
</script>