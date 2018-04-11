<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="language" content="en-us" />

<style type="text/css">

/* set table header to a fixed position. WinIE 6.x only                                       */
/* In WinIE 6.x, any element with a position property set to relative and is a child of       */
/* an element that has an overflow property set, the relative value translates into fixed.    */
/* Ex: parent element DIV with a class of tableContainer has an overflow property set to auto */
thead.fixedHeader tr {
	position: relative;
	/* expression is for WinIE 5.x only. Remove to validate and for pure CSS solution      */
	top: expression(document.getElementById("tableContainer").scrollTop);
}

/* set THEAD element to have block level attributes. All other non-IE browsers            */
/* this enables overflow to work on TBODY element. All other non-IE, non-Mozilla browsers */
/* Filter out Opera 5.x/6.x and MacIE 5.x                                                 */
head:first-child+body thead[class].fixedHeader tr {
	display: block;
}

/* make the A elements pretty. makes for nice clickable headers                */
/*thead.fixedHeader a, thead.fixedHeader a:link, thead.fixedHeader a:visited {
	color: #FFF;
	display: block;
	text-decoration: none;
	width: 100%
}*/

head:first-child+body tbody[class].scrollContent {
	display: block;
	height: 190px;
	overflow: auto;
	width: 100%
}
head:second-child+body tbody[class].scrollContent {
	display: block;
	height: 262px;
	overflow: auto;
	width: 100%
}

head:first-child+body tbody[class].scrollIndustryContent {
	display: block;
	height: 293px;
	overflow: auto;
	width: 100%
}
head:second-child+body tbody[class].scrollIndustryContent {
	display: block;
	height: 293px;
	overflow: auto;
	width: 100%
}

</style>

<h3> Summary of the numbers </h3>
<?php
$headdateObj = DateTime::createFromFormat('!m', date('m', strtotime($limit)));
$headmonthName = $headdateObj->format('M');
echo
$this->Html->link("<i class= 'fa fa-chevron-circle-left'></i>", array(
	'controller' => 'adminreports',
	'action' => 'index',
	date('Y-m', strtotime('-1 month', strtotime($limit))) ),
array('escape' => false,'style' => 'font-size: 20px;')
).' '.
$this->Html->link(date('Y', strtotime($limit)).'-'.
	$headmonthName,
	array('controller' => 'adminreports', 'action' => 'index'
		),array('style' => 'font-size: 20px;')
	).' '.
$this->Html->link("<i class='fa fa-chevron-circle-right'></i>", array(
	'controller' =>'adminreports',
	'action' => 'index',
	date('Y-m', strtotime('+1 month',strtotime($limit)))),
array('escape' =>false,'style' => 'font-size: 20px;')
);
?>

<div style = "overflow-x:auto;"><br>
	<table border = "0">
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable gradienttable">
					<thead class="fixedHeader" id="fixedHeader">
					<tr>
						<th><p style = "width: 173px; height: 33px;"></p></th>
						<?php for ($i = 1; $i <= 31; $i++) : ?>
							<th><p class="header-size"> <?php echo $i; ?> </p></th>
						<?php endfor; ?>
						<th><p></p></th>
					</tr>
					</thead>
					<tbody class="scrollContent">
					<tr>
						<th><p style='padding: 10px;width: 173px;'>Registered Companies </p></td>
						<?php for ($q = 1; $q <= 31; $q++) : ?>
							<?php $num_length = strlen((string)$q); ?>
							<?php if ($num_length == 1) : ?>
								<?php $q = '0'.$q ; ?>
							<?php else: ?>
								<?php $q = (string)$q; ?>
							<?php endif; ?>
							<td>
								<p>
									<?php echo !empty($company[$q]) ? $company[$q] : '' ?>
								</p>
							</td>
						<?php endfor; ?>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>Registered Headhunters</p></td>
						<?php for ($hh = 1; $hh <= 31 ; $hh++) : ?>
							<?php $num_length = strlen((string)$hh); ?>
							<?php if ($num_length == 1) : ?>
								<?php $hh = '0'.$hh ; ?>
							<?php else: ?>
								<?php $hh = (string)$hh; ?>
							<?php endif; ?>
							<td>
								<p>
									<?php echo !empty($headhunter[$hh]) ? $headhunter[$hh] : '' ?>
								</p>
							</td>
						<?php endfor; ?>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>Registered Jobs</p></td>
						<?php for ($occ = 1; $occ <= 31; $occ++) : ?>
							<?php $num_length = strlen((string)$occ); ?>
							<?php if ($num_length == 1) : ?>
								<?php $occ = '0'.$occ ; ?>
							<?php else: ?>
								<?php $occ = (string)$occ; ?>
							<?php endif; ?>
							<td>
								<p>
									<?php echo !empty($occupation[$occ]) ? $occupation[$occ] : '' ?>
								</p>
							</td>
						<?php endfor; ?>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>Registered Customers</p></td>
						<?php for ($cus = 1; $cus <= 31; $cus++) : ?>
							<?php $num_length = strlen((string)$cus); ?>
							<?php if ($num_length == 1) : ?>
								<?php $cus = '0'.$cus ; ?>
							<?php else: ?>
								<?php $cus = (string)$cus; ?>
							<?php endif; ?>
							<td>
								<p>
									<?php echo !empty($customer[$cus]) ? $customer[$cus] : '' ?>
								</p>
							</td>
						<?php endfor; ?>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>Successful Customers</p></td>
						<?php for ($success = 1; $success <= 31; $success++) : ?>
							<?php $num_length = strlen((string)$success); ?>
							<?php if ($num_length == 1) : ?>
								<?php $success = '0'.$success ; ?>
							<?php else: ?>
								<?php $success = (string)$success; ?>
							<?php endif; ?>
							<td>
								<p>
									<?php echo !empty($scustomer[$success]) ? $scustomer[$success] : '' ?>
								</p>
							</td>
						<?php endfor; ?>
					</tr>
					</tbody>
				</table>
			</td>
			<td style = "width: 10px; padding-left: 24px;"></td>
			<td>
				<table class = "gradienttable" style = "float:right">
					<thead>
						<tr>
							<th><p style = "width: 176px;height: 33px;"></p></th>
							<?php
							$mon = explode('-', $limit) ;
							$dateObj = DateTime::createFromFormat('!m', $mon[1]);
							$monthName = $dateObj->format('M');
							$prevdateObj = DateTime::createFromFormat('!m', date('m', strtotime($limit." -1 month")));
							$prevmonthName = $prevdateObj->format('M');
							?>
							<th><p> <?php echo $prevmonthName.'.' ; ?> </p></th>
							<th><p> <?php echo $monthName.'.' ; ?> </p></th>
						</tr>
					</thead>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>Registered Companies</p></th>
							<td><p><?php echo $previous_company['total']; ?></p></td>
							<td><p><?php echo $company['total']; ?></p></td>
						</tr>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>Registered headhunters</p></th>
							<td><p><?php echo $previous_headhunter['total']; ?></p></td>
							<td><p><?php echo $headhunter['total']; ?></p></td>
						</tr>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>Registered jobs</p></th>
							<td><p><?php echo $previous_occupation['total']; ?></p></td>
							<td><p><?php echo $occupation['total']; ?></p></td>
						</tr>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>Registered Customers</p></th>
							<td><p><?php echo $previous_customer['total']; ?></p></td>
							<td><p><?php echo $customer['total']; ?></p></td>
						</tr>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>	Successful Customers</p></th>
							<td><p><?php echo $previous_scustomer['total']; ?></p></td>
							<td><p><?php echo $scustomer['total']; ?></p></td>
						</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<br/>
<br/>

<h3> Registered Job (detail) </h3>
<?php
$headdateObj = DateTime::createFromFormat('!m', date('m', strtotime($limit)));
$headmonthName = $headdateObj->format('M');
echo
$this->Html->link("<i class= 'fa fa-chevron-circle-left'></i>", array(
	'controller' => 'adminreports',
	'action' => 'index',
	date('Y-m', strtotime('-1 month', strtotime($limit))) ),
array('escape' => false,'style' => 'font-size: 20px;')
).' '.
$this->Html->link(date('Y', strtotime($limit)).'-'.
	$headmonthName,
	array('controller' => 'adminreports', 'action' => 'index'
		),array('style' => 'font-size: 20px;')
	).' '.
$this->Html->link("<i class='fa fa-chevron-circle-right'></i>", array(
	'controller' =>'adminreports',
	'action' => 'index',
	date('Y-m', strtotime('+1 month',strtotime($limit)))),
array('escape' =>false,'style' => 'font-size: 20px;')
);
?>
<div style = "overflow-x:auto;"><br>
	<table border="0">
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable gradienttable">
					<thead class="fixedHeader" id="fixedHeader">
						<tr>
							<th><p style = "width: 176px;height: 33px;">Industry</p></th>
							<th><p style = "width: 176px;height: 33px;">Sub-Industry</p></th>
							<?php for ($j = 1; $j <= 31; $j++) : ?>
								<th><p class="header-size"><?php echo $j; ?></p></th>
							<?php endfor; ?>
							<th><p></p></th>
						</tr>
					</thead>
					<tbody class="scrollIndustryContent" >
						<?php foreach ($big as $bigkey => $bigvalue) : ?>
							<?php $size = sizeof($bigvalue['IndustrySmall']); ?>
							<tr>
								<th rowspan= <?php echo $size; ?> style='padding: 10px;background: #2A3F54;width:178px;'>
									<span style='padding: 10px;color:#fff;'><?php echo $bigvalue['IndustryBig']['label']; ?></span>
								</th>

								<?php foreach ($bigvalue['IndustrySmall'] as $bkey => $bvalue) : ?>
									<?php if ($bkey != 0) : ?><tr> <?php endif; ?>
									<th style="height: 38px;background:  #2A3F54;color:#fff;padding: 5px;width: 176px;"><?php echo $bvalue['label']; ?></th>
									<?php for ($indus = 1; $indus <= 31; $indus++) : ?>
										<?php $num_length = strlen((string)$indus); ?>
										<?php if ($num_length == 1) : ?>
											<?php $indus = '0'.$indus ; ?>
										<?php else: ?>
											<?php $indus = (string)$indus; ?>
										<?php endif; ?>
										<td>
											<p><?php echo !empty($industry[$bvalue['id']][$indus]) ? $industry[$bvalue['id']][$indus] : '' ?></p>
										</td>
									<?php endfor; ?>
								</tr>
							<?php endforeach; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
			<td style = "width: 10px;padding-left: 24px;"></td>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable gradienttable" float="right">
				<thead class="fixedHeader" id="fixedHeader">
					<tr>
						<th><p style = "width: 176px;height: 33px;">Industry</p></th>
							<th><p style = "width: 176px;height: 33px;">Sub-Industry</p></th>
						<?php
						$mon = explode('-', $limit) ;
						$dateObj = DateTime::createFromFormat('!m', $mon[1]);
						$monthName = $dateObj->format('M');
						$prevdateObj = DateTime::createFromFormat('!m', date('m', strtotime($limit." -1 month")));
						$prevmonthName = $prevdateObj->format('M');
						?>
						<th><p class="header-size"> <?php echo $prevmonthName.'.'; ?> </p></th>
						<th><p class="header-size"> <?php echo $monthName.'.'; ?> </p></th>
						<th><p></p></th>
					</tr>
				</thead>
				<tbody class="scrollIndustryContent scrollContent">
					<?php foreach ($big as $bigkey => $bigvalue) : ?>
						<?php $size = sizeof($bigvalue['IndustrySmall']); ?>
						<tr>
							<th rowspan= <?php echo $size; ?> style='padding: 10px;width:178px;background:#2A3F54;color: #fff;'><?php echo $bigvalue['IndustryBig']['label']; ?></th>
							<?php foreach ($bigvalue['IndustrySmall'] as $bkey => $bvalue) : ?>
								<?php if ($bkey != 0) { ?> <tr> <?php } ?>
								<th style="height: 38px;width: 176px;background:#2A3F54;color:#fff;padding-left: 10px;"><?php echo $bvalue['label']; ?></th>
								<td><p>
									<?php echo !empty($previous_industry[$bvalue['id']]['total']) ? $previous_industry[$bvalue['id']]['total'] : '' ?>
								</p></td>
								<td><p>
									<?php echo !empty($industry[$bvalue['id']]['total']) ? $industry[$bvalue['id']]['total'] : '' ?>
								</p></td>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</tbody>
				</table>
			</td>
		</tr>
	</table>
</div>
<br/></br>

<h3> Registered Customers (detail) </h3>
<?php
$headdateObj = DateTime::createFromFormat('!m', date('m', strtotime($limit)));
$headmonthName = $headdateObj->format('M');
echo
$this->Html->link("<i class= 'fa fa-chevron-circle-left'></i>", array(
	'controller' => 'adminreports',
	'action' => 'index',
	date('Y-m', strtotime('-1 month', strtotime($limit))) ),
array('escape' => false,'style' => 'font-size: 20px;')
).' '.
$this->Html->link(date('Y', strtotime($limit)).'-'.
	$headmonthName,
	array('controller' => 'adminreports', 'action' => 'index'
		),array('style' => 'font-size: 20px;')
	).' '.
$this->Html->link("<i class='fa fa-chevron-circle-right'></i>", array(
	'controller' =>'adminreports',
	'action' => 'index',
	date('Y-m', strtotime('+1 month',strtotime($limit)))),
array('escape' =>false,'style' => 'font-size: 20px;')
);
?>
<div style="overflow-x:auto;"><br>
	<table border="0">
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable gradienttable">
					<thead class="fixedHeader" id="fixedHeader">
						<th><p style="width: 173px;height: 33px;padding-top: 1px;">Final education</p></th>
						<?php for ($j = 1; $j <= 31; $j++) : ?>
							<th><p class="header-size"> <?php echo $j; ?> </p></th>
						<?php endfor; ?>
						<th><p></p></th>
					</tr>
					</thead>
					<tbody class="scrollContent">
						<tr>
							<th><p style='padding: 10px;width: 173px;'>University (Doctor)</p></th>
							<?php for ($d = 1; $d <= 31; $d++) : ?>
								<?php $num_length = strlen((string)$d); ?>
								<?php if ($num_length == 1) : ?>
									<?php $d = '0'.$d ; ?>
								<?php else: ?>
									<?php $d = (string)$d; ?>
								<?php endif; ?>
								<td><p> <?php echo !empty($doctor[$d]) ? $doctor[$d] : '' ?> </p></td>
							<?php endfor; ?>
						</tr>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>University (MBA)</p></th>
							<?php for ($m = 1; $m <= 31; $m++) : ?>
								<?php $num_length = strlen((string)$m); ?>
								<?php if ($num_length == 1) : ?>
									<?php $m = '0'.$m ; ?>
								<?php else: ?>
									<?php $m = (string)$m; ?>
								<?php endif; ?>
								<td><p> <?php echo !empty($MBA[$m]) ? $MBA[$m] : '' ?> </p></td>
							<?php endfor; ?>
						</tr>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>University (Master)</p></th>
							<?php for ($mas = 1; $mas <= 31; $mas++) : ?>
								<?php $num_length = strlen((string)$mas); ?>
								<?php if ($num_length == 1) : ?>
									<?php $mas = '0'.$mas ; ?>
								<?php else: ?>
									<?php $mas = (string)$mas; ?>
								<?php endif; ?>
								<td><p> <?php echo !empty($master[$mas]) ? $master[$mas] : '' ?> </p></td>
							<?php endfor; ?>
						</tr>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>University (Bachelor)</p></th>
							<?php for ($bac = 1; $bac <= 31; $bac++) : ?>
								<?php $num_length = strlen((string)$bac); ?>
								<?php if ($num_length == 1) : ?>
									<?php $bac = '0'.$bac ; ?>
								<?php else: ?>
									<?php $bac = (string)$bac; ?>
								<?php endif; ?>
								<td><p> <?php echo !empty($bachelor[$bac]) ? $bachelor[$bac] : '' ?> </p></td>
							<?php endfor; ?>
						</tr>
						<tr>
							<th><p style='padding: 10px;width: 173px;'>Others</p></th>
							<?php for ($other = 1; $other <= 31; $other++) : ?>
								<?php $num_length = strlen((string)$other); ?>
								<?php if ($num_length == 1) : ?>
									<?php $other = '0'.$other ; ?>
								<?php else: ?>
									<?php $other = (string)$other; ?>
								<?php endif; ?>
								<td><p> <?php echo !empty($eduother[$other]) ? $eduother[$other] : '' ?> </p></td>
							<?php endfor; ?>
						</tr>
					</tbody>
				</table>
			</td><td style = "width: 10px; padding-left: 24px;"></td>
			<td>
				<table class = "gradienttable " style = "float:right" >
					<tr>
						<th><p style = "width: 176px;height: 33px;">Final Educaiton</p></th>
						<?php
							$mon = explode('-', $limit) ;
							$dateObj = DateTime::createFromFormat('!m', $mon[1]);
							$monthName = $dateObj->format('M');
							$prevdateObj = DateTime::createFromFormat('!m', date('m', strtotime($limit." -1 month")));
							$prevmonthName = $prevdateObj->format('M');
						?>
						<th><p><?php echo $prevmonthName.'.'; ?> </p></th>
						<th><p> <?php echo $monthName.'.'; ?> </p></th>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>University (Doctor)</p></th>
						<td><p><?php echo $previous_doctor['total']; ?></p></td>
						<td><p><?php echo $doctor['total']; ?></p></td>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>University (MBA)</p></th>
						<td><p><?php echo $previous_MBA['total']; ?></p></td>
						<td><p><?php echo $MBA['total']; ?></p></td>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>University (Master)</p></th>
						<td><p><?php echo $previous_master['total']; ?></p></td>
						<td><p><?php echo $master['total']; ?></p></td>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>University (Bachelor)</p></th>
						<td><p><?php echo $previous_bachelor['total']; ?></p></td>
						<td><p><?php echo $bachelor['total']; ?></p></td>
					</tr>
					<tr>
						<th><p style='padding: 10px;width: 173px;'>Others</p></th>
						<td><p><?php echo $previous_eduother['total']; ?></p></td>
						<td><p><?php echo $eduother['total']; ?></p></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>