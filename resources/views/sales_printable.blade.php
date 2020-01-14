<p>&nbsp;</p>
<div>
    <table>
        <tbody>
        <tr>
            <td><img src="{{ asset('app/public/logo/logo.jpg') }}" width="200"></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td></td>
        </tr>
        <tr>
            <td>Statement Type</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><strong>{{ $sales_order->status }}</strong></td>
        </tr>
        <tr>
            <td>Project</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><strong>{{ $sales_order->customer_name }}</strong></td>
        </tr>
        <tr>
            <td>Location:</td>
            <td>&nbsp;</td>
            <td><strong>{{ $sales_order->address }}</strong></td>
        </tr>
        <tr>
            <td>Contact Person:</td>
            <td>&nbsp;</td>
            <td><strong>{{ $sales_order->agent }}</strong></td>
        </tr>
        <tr>
            <td>Date:</td>
            <td>&nbsp;</td>
            <td><strong>{{ \Carbon\Carbon::now()->format('F j, Y') }}</strong></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Subject:</td>
            <td>&nbsp;</td>
            <td><strong>{{ $sales_order->subject }}</strong></td>
        </tr>
        </tbody>
    </table>
</div>
<div>
    <p>&nbsp;</p>
</div>
<div>
    <table style="border: 2px solid black; border-collapse: collapse;" border="1" width="100%">
        <tbody>
        <tr style="background-color: #bdd6ee;">
            <td style="text-align: center;"><strong>Description</strong></td>
            <td style="text-align: center;"><strong>Quantity</strong></td>
            <td style="text-align: center;"><strong>Notes</strong></td>
            <td style="text-align: center;"><strong>Discount</strong></td>
            <td style="text-align: center;"><strong>(Material) <br> Unit Cost</strong></td>
            <td style="text-align: center;"><strong>(Material) <br> Total Cost</strong></td>
            <td style="text-align: center;"><strong>(Labor) <br> Unit cost</strong></td>
            <td style="text-align: center;"><strong>(Labor) <br> Total Cost</strong></td>
            <td style="text-align: center;"><strong>TOTAL ITEM COST</strong></td>
        </tr>
        @foreach($product_details as $value)
            @if(count($value) == 1)
                <tr style="background-color: #fefb04;">
                    <td style="text-align: left; font-weight: bold;">{{ $value['category'] }}</td>
                    <td style="text-align: center;">&nbsp;</td>
                    <td style="text-align: center;">&nbsp;</td>
                    <td style="text-align: center;">&nbsp;</td>
                    <td style="text-align: center;">&nbsp;</td>
                    <td style="text-align: center;">&nbsp;</td>
                    <td style="text-align: center;">&nbsp;</td>
                    <td style="text-align: center;">&nbsp;</td>
                    <td style="text-align: center;">&nbsp;</td>
                </tr>
            @else
                <tr>
                    <td>{{ $value['product_name'] }}</td>
                    <td style="text-align: center;">{{ (int) $value['qty'] }}</td>
                    <td style="text-align: center;">{{ $value['notes'] }}</td>
                    <td style="text-align: center;">{{ $value['discount_item'] }}</td>
                    <td style="text-align: center;">{{ number_format($value['selling_price'], 2, '.', '') }}</td>
                    <td style="text-align: center;">{{ $value['qty'] * $value['selling_price'] }}</td>
                    <td style="text-align: center;">{{ number_format($value['labor_cost'], 2, '.', '') }}</td>
                    <td style="text-align: center;">{{ $value['qty'] * $value['labor_cost'] }}</td>
                    <td style="text-align: center;">{{ number_format(($value['qty'] * $value['labor_cost']) + (($value['qty'] * $value['selling_price'])-(($value['qty'] * $value['selling_price'])*($value['discount_item']/100))), 2, '.', '')}}</td>
                </tr>
            @endif
        @endforeach
        <tr style="background-color: #bdd6ee;">
            <td style="text-align: right;">Sub-total</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;"><strong>{{ number_format($summary->sub_total, 2, '.', '') }}</strong></td>
        </tr>
        </tbody>
    </table>
</div>
<div>
    <p>&nbsp;</p>
</div>
<div>
    <table>
        <tbody>
        <tr>
            <td><strong>Terms and Conditions:</strong></td>
        </tr>
        <tr>
            <td>{{ $sales_order->tac }}</td>
        </tr>
        </tbody>
    </table>
</div>
<div>
    <p>&nbsp; &nbsp;</p>
</div>
<div>
    <table width="100%">
        <tbody>
        <tr>
            <td>
                <table align="left">
                    <tbody>
                    <tr>
                        <td><strong>Mode of Payment:</strong></td>
                    </tr>
                    <tr>
                        <td>Method:</td>
                        <td>{{ $sales_order->payment_method }}</td>
                    </tr>
                    <tr>
                        <td>Account Name:</td>
                        <td>{{ $sales_order->account_name }}</td>
                    </tr>
                    <tr>
                        <td>Account No:</td>
                        <td>{{ $sales_order->account_no }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table style="border: 1px solid black;" >
                    <tbody>
                    <tr>
                        <td><strong>SUMMARY:</strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @foreach($sections as $section)
                        @foreach($section as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><strong>{{ number_format($value, 2 ,'.', '') }}</strong></td>
                            </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>DISCOUNT</td>
                        <td><strong>{{ number_format($summary->discount, 2 ,'.', '') }}</strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>SHIPPING</td>
                        <td><strong>{{ $summary->shipping }}</strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>SUB-TOTAL</td>
                        <td><strong>{{ $summary->sub_total }}</strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>SALES TAX</td>
                        <td><strong>{{ $summary->sales_tax }}</strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>GRAND TOTAL</td>
                        <td><strong>{{ ($summary->sales_tax + $summary->sub_total + $summary->shipping) - (($summary->sales_tax + $summary->sub_total + $summary->shipping) * $summary->discount / 100) }}</strong></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div>
    <p>&nbsp;</p>
</div>
<div>
    <p>&nbsp;</p>
</div>