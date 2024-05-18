<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `payment_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
	<form action="" id="payment-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name ="account_id" value="<?php echo isset($account_id) ? $account_id : (isset($_GET['account_id']) ? $_GET['account_id'] : '') ?>">
		<div class="form-group">
			<label for="month_of" class="control-label">Month of</label>
			<input type="month" name="month_of" id="month_of" class="form-control form-control-sm rounded-0" value="<?php echo isset($month_of) ? $month_of : ''; ?>"  required placeholder="YYYY-MM"/>
		</div>
		<div class="form-group">
			<label for="amount" class="control-label">Amount</label>
			<input type="number" step="any" name="amount" id="amount" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($amount) ? $amount : 0; ?>"  required/>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#uni_modal').on('shown.bs.modal', function(e){
			end_loader()
		})
		$('#uni_modal').on('hidden.bs.modal', function(e){
			if('<?= isset($account_id) ?>' == 1 && $('#payment-form').length > 0 && $('#payment-form').find('[name="id"]').val() != ""){
				uni_modal("<i class='fa fa-money-check-alt'></i> Payment History", "accounts/payment_history.php?account_id=<?= isset($account_id) ? $account_id : '' ?>", 'modal-lg')
				e.preventDefault()
			}
		})
		$('#payment-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_payment",
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
						alert_toast(resp.msg, resp.status)
						$('#uni_modal').on('hidden.bs.modal', function(){
							if($('#payment-form').length > 0 ){
								uni_modal("<i class='fa fa-money-check-alt'></i> Payment History", "accounts/payment_history.php?account_id=<?= isset($account_id) ? $account_id : (isset($_GET['account_id']) ? $_GET['account_id'] : '') ?>", 'modal-lg')
							}
						})
						$('.modal').modal('hide')
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