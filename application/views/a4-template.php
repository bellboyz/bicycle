<style type="text/css">
	body {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
		background-color: #FAFAFA;
		font: 16pt "Tahoma";
	}
	* {
		box-sizing: border-box;
		-moz-box-sizing: border-box;
	}
	.page {
		width: 210mm;
		min-height: 297mm;
		padding: 20mm;
		margin: 10mm auto;
		border: 1px #D3D3D3 solid;
		border-radius: 5px;
		background: white;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	}
	

	@page {
		size: A4;
		margin: 0;
	}
	@media print {
		html, body {
			width: 210mm;
			height: 297mm;        
		}
		.page {
			margin: 0;
			border: initial;
			border-radius: initial;
			width: initial;
			min-height: initial;
			box-shadow: initial;
			background: initial;
			page-break-after: always;
		}
	}

	#table {
		/*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
		border-collapse: collapse;
		width: 100%;
	}

	#table td, #table th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	/*#table tr:nth-child(even){background-color: #f2f2f2;}*/

	/*#table tr:hover {background-color: #ddd;}*/

	#table th {
		padding-top: 12px;
		padding-bottom: 12px;
		/*text-align: left;*/
		/*background-color: #4CAF50;*/
		/*color: white;*/
	}
</style>

<body>
	<div class="book">
		<div class="page">
			<?php if($report === 'stock'){ ?>
				<h1><center>รายงานยอดการผลิต</center></h1>
				<h3><center>
				<?php
				if($start_date && $end_date) echo 'ตั้งแต่วันที่ ' . $start_date . ' ถึงวันที่ ' . $end_date;
				else if($start_date && !$end_date) echo 'ตั้งแต่วันที่ ' . $start_date;
				else if(!$start_date && $end_date) echo 'ถึงวันที่ ' . $end_date;
				?>
				</center></h3>
				<table id="table">
					<thead>
						<tr>
							<th><center>ลำดับ</center></th>
							<th><center>ชื่อสินค้า</center></th>
							<th><center>สี</center></th>
							<th><center>ยอดผลิต</center></th>
							<th><center>หน่วย</center></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($stock as $s) { ?>
							<tr>
								<td><center><?= $i; ?></center></td>
								<td><center><?= $s->product; ?></center></td>
								<td><center><?= $s->color; ?></center></td>
								<td><center><?= number_format($s->total_number); ?></center></td>
								<td><center><?= $s->unit; ?></center></td>
							</tr>
							<?php $i++; ?>
						<?php } ?>
					</tbody>
				</table>
			<?php } else if($report === 'deposit') { ?>
				<h1><center>รายงานยอดการขาย</center></h1>
				<h3><center>
				<?php
				if($start_date && $end_date) echo 'ตั้งแต่วันที่ ' . $start_date . ' ถึงวันที่ ' . $end_date;
				else if($start_date && !$end_date) echo 'ตั้งแต่วันที่ ' . $start_date;
				else if(!$start_date && $end_date) echo 'ถึงวันที่ ' . $end_date;
				?>
				</center></h3>
				<table id="table">
					<thead>
						<tr>
							<th><center>ลำดับ</center></th>
							<th><center>ชื่อสินค้า</center></th>
							<th><center>สี</center></th>
							<th><center>ยอดขาย</center></th>
							<th><center>ยอดรวม</center></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($deposit as $d) { ?>
							<tr>
								<td><center><?= $i; ?></center></td>
								<td><center><?= $d->product; ?></center></td>
								<td><center><?= $d->color; ?></center></td>
								<td><center><?= number_format($d->number); ?></center></td>
								<td><center><?= number_format($d->price); ?></center></td>
							</tr>
							<?php $i++; ?>
						<?php } ?>
					</tbody>
				</table>
			<?php } else if($report === 'billing'){ ?>
				<h1><center>รายงานยอดการสั่งซื้อ</center></h1>
				<?php $name = $billing[0]->name; ?>
				<h3>นามลูกค้า : <?= $name; ?></h3>
				<?php
				if($start_date && $end_date) echo 'ตั้งแต่วันที่ ' . $start_date . ' ถึงวันที่ ' . $end_date;
				else if($start_date && !$end_date) echo 'ตั้งแต่วันที่ ' . $start_date;
				else if(!$start_date && $end_date) echo 'ถึงวันที่ ' . $end_date;
				else echo 'ตั้งแต่เริ่มต้น';
				?>
				<table id="table" style="margin-top: 10px;">
					<thead>
						<tr>
							<th><center>วันที่</center></th>
							<th><center>รายการ</center></th>
							<th><center>จำนวน</center></th>
							<th><center>หน่วย</center></th>
							<th><center>ราคาต่อหน่วย</center></th>
							<th><center>ราคา</center></th>
						</tr>
					</thead>
					<tbody>
					<?php $date = ''; ?>
					<?php $i = 1; ?>
					<?php $row = 1; ?>
					<?php $total = 0; ?>
					<?php foreach ($billing as $b) { ?>
						<?php if($date != $b->created_date && $i != 1){ ?>
							<tr>
								<td colspan="4"><center>รวม</center></td>
								<td><center><?php echo number_format($total); ?></center></td>
								<td><center>บาท</center></td>
							</tr>
							<?php $total = 0; ?>
						<?php } ?>
						<?php $date = $b->created_date; ?>
						<tr>
							<td><center><?php echo $date; ?></center></td>
							<td><center><?php echo $b->product . ' ' . $b->color; ?></center></td>
							<td><center><?php echo $b->number; ?></center></td>
							<td><center><?php echo $b->unit; ?></center></td>
							<td><center><?php echo $b->price_per_number; ?></center></td>
							<td><center><?php echo $b->price; ?></center></td>
						</tr>
						<?php $total += $b->price; ?>
						<?php $i++; ?>
					<?php } ?>
					<tr>
						<td colspan="3"><center>รวม</center></td>
						<td><center><?php echo number_format($total); ?></center></td>
						<td><center>บาท</center></td>
					</tr>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</div>
</body>