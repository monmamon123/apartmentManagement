<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php $month = isset($_GET['month']) ? $_GET['month'] : date("Y-m"); ?>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title">Monthly Report</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid mb-3">
            <fieldset class="px-2 py-1 border">
                <legend class="w-auto px-3">Filter</legend>
                <div class="container-fluid">
                    <form action="" id="filter-form">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="month" class="control-label">Choose Date</label>
                                    <input type="month" class="form-control form-control-sm rounded-0" name="month" id="month" value="<?= $month ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm bg-gradient-maroon rounded-0"><i class="fa fa-filter"></i> Filter</button>
                                    <button class="btn btn-light btn-sm bg-gradient-light rounded-0 border" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>
		</div>
        <div class="container-fluid" id="printout">
			<table class="table table-hover table-striped table-bordered">
                <colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>DateTime Added</th>
						<th>Account Code</th>
						<th>Student</th>
						<th>Dorm</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    $total = 0;
					$i = 1;
                    $qry = $conn->query("SELECT p.*, a.code, s.code as student_code, concat(s.firstname, ' ', coalesce(concat(s.middlename,' '), ''), s.lastname) as `student`, d.name as dorm, r.name as `room` from payment_list p inner join account_list a on p.account_id = a.id inner join student_list s on a.student_id = s.id inner join room_list r on a.room_id = r.id inner join dorm_list d on r.dorm_id = d.id where (p.month_of) = '{$month}' order by student asc ");
                    while($row = $qry->fetch_assoc()):
                        $total += $row['amount'];
					?>
						<tr>
                            <td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d h:i A",strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['code'] ?></td>
							<td>
								<div style="line-height:1em">
									<div><?= $row['student'] ?></div>
									<div><?= $row['student_code'] ?></div>
								</div>
							</td>
							<td>
								<div style="line-height:1em">
									<div><?= $row['dorm'] ?></div>
									<div><?= $row['room'] ?></div>
								</div>
							</td>
							<td class="text-right"><?php echo number_format($row['amount']) ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
                <tfoot>
                    <th class="py-1 text-center" colspan="5">Total Collections</th>
                    <th class="py-1 text-right"><?= format_num($total,2) ?></th>
                </tfoot>
			</table>
		</div>
	</div>
</div>
<noscript id="print-header">
    <div>
    <div class="d-flex w-100">
        <div class="col-2 text-center">
            <img style="height:.8in;width:.8in!important;object-fit:cover;object-position:center center" src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="w-100 img-thumbnail rounded-circle">
        </div>
        <div class="col-8 text-center">
            <div style="line-height:1em">
                <h4 class="text-center mb-0"><?= $_settings->info('name') ?></h4>
                <h3 class="text-center mb-0"><b>Monthly Collection Report</b></h3>
                <div class="text-center">as of</div>
                <h4 class="text-center mb-0"><b><?= date("F, Y", strtotime($month."-01")) ?></b></h4>
            </div>
        </div>
    </div>
    <hr>
    </div>
</noscript>
<script>
	$(document).ready(function(){
		$('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = "./?page=reports/daily_collection_report&"+$(this).serialize()
        })
        $('#print').click(function(){
            var h = $('head').clone()
            var ph = $($('noscript#print-header').html()).clone()
            var p = $('#printout').clone()
            h.find('title').text('Daily Court Rentals Report - Print View')
            h.append("<style>html, body{ min-height:unset !important }</style>")
            start_loader()
            var nw = window.open("", "_blank", "width="+($(window).width() * .8)+", height="+($(window).height() * .8)+", left="+($(window).width() * .1)+", top="+($(window).height() * .1))
                     nw.document.querySelector('head').innerHTML = h.html()
                     nw.document.querySelector('body').innerHTML = ph.html()
                     nw.document.querySelector('body').innerHTML += p[0].outerHTML
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                             nw.close()
                             end_loader()
                         }, 300);
                     }, 300);
        })
	})
	
</script>