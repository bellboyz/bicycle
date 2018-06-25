<style type="text/css">
	body {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
		background-color: #FAFAFA;
		font: 12pt "Tahoma";
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
								<td><center><?= $s->total_number; ?></center></td>
								<td><center><?= $s->unit; ?></center></td>
							</tr>
							<?php $i++; ?>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</div>
</body>