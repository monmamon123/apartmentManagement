<?php
require_once('../../config.php');
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <table class="table table-bordered" id="payment-histpry-table">
        <colgroup>
            <col width="10%">
            <col width="20%">
            <col width="40%">
            <col width="15%">
            <col width="15%">
        </colgroup>
        <thead>
            <tr class="bg-gradient-primary">
                <th class="text-center">#</th>
                <th class="">DateTime Added</th>
                <th class="">Month of</th>
                <th class="">Amount</th>
                <th class="">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($_GET['account_id'])): ?>
                <?php 
                $i = 1;
                $payment_qry = $conn->query("SELECT *,concat(month_of,'-01') as pmonth FROM `payment_list` where account_id = '{$_GET['account_id']}' order by unix_timestamp(date(concat(month_of,'-01'))) asc");
                while($row = $payment_qry->fetch_assoc()):    
                ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td><?= date("M d, Y h:i A", strtotime($row['date_created'])) ?></td>
                    <td><?= date("F, Y", strtotime($row['pmonth'])) ?></td>
                    <td class="text-rigth"><?= format_num($row['amount'], 2) ?></td>
                    <td align="center">
                            <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Action
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                            </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mx-1 mt-3">
    <div class="text-right">
        <button class="btn btn-flat btn-sm btn-light bg-gradient-light border" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
<script>
	$(document).ready(function(){
        $('#uni_modal').on('shown.bs.modal', function(){

            $('.edit_data').click(function(){
                uni_modal("<i class='fa fa-ceredit-card'></i> Update Payment Details", 'accounts/manage_payment.php?id='+$(this).attr('data-id'))
            })
            $('.delete_data').click(function(){
                _conf("Are you sure to delete this payment details?", 'delete_payment', [$(this).attr('data-id')])
            })
            if ( $.fn.DataTable.isDataTable( '#payment-histpry-table' ) ) {
                $('#payment-histpry-table').dataTable().fnDestroy();
            }
            $('#payment-histpry-table').dataTable({
                columnDefs: [
                        { orderable: false, targets: [4] }
                ],
                order:[0,'asc']
            });
            $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')

        })
	})
    function delete_payment($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_payment",
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
                    $('.modal').modal('hide')
					alert_toast(resp.msg, resp.status)
                    end_loader()
                    setTimeout(() => {
                        uni_modal("<i class='fa fa-money-check-alt'></i> Payment History", "accounts/payment_history.php?account_id=<?= isset($_GET['account_id']) ? $_GET['account_id'] : '' ?>", 'modal-lg')
                    }, 500);
                    
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>