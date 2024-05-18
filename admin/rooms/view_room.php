<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT r.*, d.name as `dorm`,(r.slots - coalesce((SELECT COUNT(id) FROM account_list where room_id = r.id), 0)) as `available` from `room_list` r inner join dorm_list d on r.dorm_id = d.id where r.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
	<dl>
        <dt class="text-muted">Dorm</dt>
        <dd class="pl-4"><?= isset($dorm) ? $dorm : "" ?></dd>
        <dt class="text-muted">Name</dt>
        <dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
        <dt class="text-muted">Bed/s</dt>
        <dd class="pl-4"><?= isset($slots) ? format_num($slots) : "" ?></dd>
        <dt class="text-muted">Available Slots</dt>
        <dd class="pl-4"><?= isset($available) ? format_num($available) : "" ?></dd>
        <dt class="text-muted">Price per Month</dt>
        <dd class="pl-4"><?= isset($price) ? format_num($price, 2) : "" ?></dd>
        <dt class="text-muted">Status</dt>
        <dd class="pl-4">
            <?php if($status == 1): ?>
                <span class="badge badge-maroon bg-gradient-maroon px-3 rounded-pill">Active</span>
            <?php else: ?>
                <span class="badge badge-light bg-gradient-light border text-dark px-3 rounded-pill">Inactive</span>
            <?php endif; ?>
        </dd>
    </dl>
    <div class="clear-fix my-3"></div>
    <div class="text-right">
        <button class="btn btn-sm btn-dark bg-gradient-dark btn-flat" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>