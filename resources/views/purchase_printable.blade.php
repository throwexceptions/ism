<!DOCTYPE html>
<html>
<head>
<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	rel="stylesheet">
<style>
html * {
	font-size: 12px !important;
}

td, th {
	padding: 0 !important;
}

.header-content {
	font-weight: bold;
}

.bg-aliceblue {
	background-color: #c4ddf3;
}

.bg-category {
	background-color: #f3c927;
}

body {
	font-size: 12px !important;
}

[scope="col"] {
	text-align: center;
}

.iden {
	font-size: 15px !important;
	font-weight: 900 !important;
	text-align: center;
}
.title {
	font-size: 25px !important;
	font-weight: 900 !important;
	text-align: center;
}
</style>
</head>
<body>


<body>
	{{--STATEMENT TTILE--}}
	<table style="width: 100%">
		<tbody>
			<tr>
				<td class="title">Purchase Order</td>
			</tr>
			<tr>
				<td class="iden">{{ $purchase_info->po_no }}</td>
			</tr>
		</tbody>
	</table>
	{{--PURCHASE ORDER--}}
	<table style="width: 100%">
		<tbody>
			<tr>
				<td>
					<table>
						<tbody>
							<tr>
								<td>Subject:</td>
								<td class="header-content">{{ $purchase_info->subject }}</td>
							</tr>
							<tr>
								<td>Project:</td>
								<td class="header-content">{{ $purchase_info->vendor_name }}</td>
							</tr>
							<tr>
								<td>Statement Type:</td>
								<td class="header-content">{{ $purchase_info->status }}</td>
							</tr>
							<tr>
								<td>Location:</td>
								<td class="header-content">{{ $purchase_info->address }}</td>
							</tr>
							<tr>
								<td>Date:</td>
								<td class="header-content">{{ \Carbon\Carbon::now()->format('F
									j, Y') }}</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td width="150"><img src="{{ asset('app/public/logo/logo.jpg') }}"
					width="150" height="150"></td>
			</tr>
		</tbody>
	</table>
	{{--PRODUCT DETAILS--}}
	<table class="table table-bordered">
		<thead class="bg-aliceblue">
			<tr>
				<th scope="col">Description</th>
				<th scope="col">Quantity</th>
				<th scope="col">Unit</th>
				<th scope="col">(Material)<br> Unit Cost
				</th>
				<th scope="col">(Material)<br> Total Cost
				</th>
				<th scope="col">(Labor)<br> Unit Cost
				</th>
				<th scope="col">(Labor)<br> Total Cost
				</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
		<tbody>
			@foreach($product_details as $product)
			@if(isset($product['product_name']))
			<tr>
				<td>{{ $product['product_name'] }}</td>
				<td>{{ $product['qty'] }}</td>
				<td>{{ $product['unit'] }}</td>
				<td>{{ number_format($product['selling_price'], 2, '.', '') }}</td>
				<td>{{ number_format($product['qty'] * $product['selling_price'], 2,
					'.', '') }}</td>
				<td>{{ number_format($product['labor_cost'], 2, '.', '') }}</td>
				<td>{{ number_format($product['qty'] * $product['labor_cost'], 2,
					'.', '') }}</td>
				<td>{{ number_format(($product['qty'] * $product['labor_cost']) +
					($product['qty'] * $product['selling_price']), 2, '.', '') }}</td>
			</tr>
			@else
			<tr class="bg-category">
				<td colspan="8"><strong>{{ $product['category'] }}</strong></td>
			</tr>
			@endif @endforeach
			<tr class="bg-aliceblue">
				<td colspan="6"></td>
				<td><strong>Sub-Total</strong></td>
				<td>{{ $summary->sub_total }}</td>
			</tr>
		</tbody>
	</table>
	{{--SUMMARY--}}

	<table>
		<tbody>
			<tr>
				<td style="width: 50%;">
					<table>
						<tbody>
							<tr>
								<td style="padding-bottom: 5px;"><strong>Terms and Conditions</strong></td>
							</tr>
							<tr>
								<td>{{ $purchase_info->tac }}</td>
							</tr>
							<tr>
								<td style="padding-bottom: 5px;"><strong>Description</strong></td>
							</tr>
							<tr>
								<td>{{ $purchase_info->description }}</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td>
					<table
						style="border: 1px solid black; padding-left: 5%; width: 100%">
						<tbody>
							<tr>
								<td colspan="2" style="padding-bottom: 8px"><strong>SUMMARY:</strong></td>
							</tr>
							@foreach($sections as $section) @foreach($section as $key =>
							$value)
							<tr>
								<td>{{ $key }}</td>
								<td style="padding-left: 10px !important;">{{ $value }}</td>
							</tr>
							@endforeach @endforeach
							<tr>
								<td align="right" style="padding-top: 10px !important;"><strong>DISCOUNT</strong></td>
								<td
									style="padding-left: 10px !important; padding-top: 10px !important;">{{
									$summary->discount }}</td>
							</tr>
							<tr>
								<td align="right"><strong>SUB-TOTAL</strong></td>
								<td style="padding-left: 10px !important;">{{
									$summary->sub_total }}</td>
							</tr>
							<tr>
								<td align="right"><strong>SHIPPING</strong></td>
								<td style="padding-left: 10px !important">{{ $summary->shipping
									}}</td>
							</tr>
							<tr>
								<td align="right"><strong>SALES TAX</strong></td>
								<td style="padding-left: 10px !important">{{ $summary->sales_tax
									}}</td>
							</tr>
							<tr>
								<td align="right"><strong>GRAND TOTAL</strong></td>
								<td style="padding-left: 10px !important">{{
									($summary->sub_total +
									$summary->shipping)*(1+($summary->sales_tax/100)) }}</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	{{-- CONFORME--}}
	<table style="margin-top: 50px;">
		<tbody>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;<strong>Received By:</strong>
				</td>
				<td>&nbsp;&nbsp;&nbsp;<strong>Date:</strong>
				</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;___________________</td>
				<td pad>&nbsp;&nbsp;&nbsp;___________________</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;<i>Owner's Signature</i>
				</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>
</html>