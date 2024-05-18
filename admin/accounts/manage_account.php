<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT a.*, concat(s.code, ' - ',s.firstname, ' ', coalesce(concat(s.middlename,' '), ''), s.lastname) as `student` from `account_list` a inner join student_list s on a.student_id = s.id where a.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="mx-0 py-5 px-3 mx-ns-4 bg-gradient-maroon">
	<h3><b><?= isset($id) ? "Update Accounts Details" : "Create New Accounts" ?></b></h3>
</div>
<div class="row justify-content-center" style="margin-top:-2em;">
	<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
					<form action="" id="accounts-form">
						<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
						<fieldset>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="student_id" class="control-label">Student</label>
										<?php if(!isset($id)): ?>
											<select type="text" class="form-control form-control-sm rounded-0" name="student_id" id="student_id">
												<option value="" selected disabled></option>
												<?php 
												$students = $conn->query("SELECT *, concat(firstname,' ', coalesce(concat(middlename,' '), ''), lastname) as `name` FROM `student_list` where delete_flag = 0 and `status` = 1 and id not in (SELECT student_id FROM `account_list` where status = 1 and delete_flag = 0) ".(isset($student_id) && $student_id > 0 ? " or id = '{$student_id}' " : "")." order by `name` asc");
												while($row = $students->fetch_array()):
												?>
												<option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
												<?php endwhile; ?>
											<select>
										<?php else: ?>
											<input type="hidden" name ="student_id" value="<?php echo isset($student_id) ? $student_id : 0 ?>">
											<div class="font-weight-bolder"><?= $student ?></div>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="room_id" class="control-label">Room</label>
										<select type="text" class="form-control form-control-sm rounded-0" name="room_id" id="room_id">
											<option value="" selected disabled></option>
											<?php 
											$rooms = $conn->query("SELECT r.*, d.name as `dorm` FROM `room_list` r inner join `dorm_list` d on r.dorm_id = d.id where r.delete_flag = 0 and r.`status` = 1 and ( r.slots - COALESCE((SELECT COUNT(id) FROM `account_list` where room_id = r.id), 0)) > 0 ".(isset($room_id) && $room_id > 0 ? " or r.id = '{$room_id}' " : "")." order by `name` asc");
											while($row = $rooms->fetch_array()):
											?>
											<option value="<?= $row['id'] ?>"  data-price="<?= $row['price'] ?>" <?= isset($room_id) && $room_id == $row['id'] ? 'selected' : '' ?>><?= "{$row['dorm']} - {$row['name']}" ?></option>
											<?php endwhile; ?>
										<select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="rate" class="control-label">Monthly Rate</label>
										<input type="number" step="any" minimum="" id="rate" name="rate" class="form-control form-control-sm rounded-0 text-right" value="<?= isset($rate) ? $rate : 0 ?>" required>
									</div>
								</div>
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
						</fieldset>
					</form>
				</div>
			</div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-primary btn-sm bg-gradient-maroon rounded-0" form="accounts-form"><i class="fa fa-save"></i> Save</button>
				<a class="btn btn-light btn-sm bg-gradient-light border rounded-0" href="./?page=accounts"><i class="fa fa-angle-left"></i> Cancel</a>
			</div>
		</div>
	</div>
</div>
<noscript id="product-item">
	<tr>
		<td class="p-1 align-middle text-center">
			<input type="hidden" name="product_id[]">
			<input type="hidden" name="product_price[]">
			<a href="javascript:void(0)" class="p-1 text-decoration-none text-danger rem_prod"><i class="fa fa-times"></i></a>
		</td>
		<td class="p-1 align-middle text-center">
			<input type="number" min="1" value= '1' class="form-control form-control-sm rounded-0 text-right" name="product_quantity[]">
		</td>
		<td class="p-1 align-middle product_name"></td>
		<td class="p-1 align-middle product_price text-right"></td>
		<td class="p-1 align-middle product_total text-right"></td>
	</tr>
</noscript>
<script>
	$(document).ready(function(){
		$('#student_id').select2({
			placeholder:"Please Select Student Here",
			width:"100%",
			containerCssClass:'form-control form-control-sm rounded-0'
		})
		$('#room_id').select2({
			placeholder:"Please Select Room Here",
			width:"100%",
			containerCssClass:'form-control form-control-sm rounded-0'
		}).change(function(){
			var id = $(this).val()
			var price = $("#room_id option[value='"+id+"']").attr('data-price')
			$('#rate').val(price)
		})
		$('#accounts-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_account",
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
						location.href="./?page=accounts/view_details&id="+resp.aid
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