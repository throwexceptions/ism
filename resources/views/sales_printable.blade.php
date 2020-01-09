<p style="text-align: center;"><span style="font-family: &quot;Arial Black&quot;, Gadget, sans-serif; font-size: 30px;">QUOTATION</span>
    <br><span style="font-family: Helvetica; font-size: 18px;">Date: {{ \Carbon\Carbon::now()->format('F j, Y') }}</span></p>
<p style="text-align: center;">
    <br>
</p>
<p><u><span style="font-family: Impact, Charcoal, sans-serif; font-size: 18px;">Sales Order Information</span></u></p>
<table style="width: 100%;">
    <tbody>
    <tr>
        <td style="width: 33.3333%;">Subject: {{ $sales_order->subject }}</td>
        <td style="width: 33.3333%;">Agent: {{ $sales_order->agent }}</td>
        <td style="width: 33.3333%;">Fax: {{ $sales_order->fax }}</td>
    </tr>
    <tr>
        <td style="width: 33.3333%;">Phone: {{ $sales_order->phone }}</td>
        <td style="width: 33.3333%;">Customer: {{ $sales_order->customer_name }}</td>
        <td style="width: 33.3333%;">Sales Order: {{ $sales_order->so_no }}</td>
    </tr>
    </tbody>
</table>
<p><u><span style="font-family: Impact, Charcoal, sans-serif; font-size: 18px;">Address Information</span></u></p>
<table style="width: 100%;">
    <tbody>
    <tr>
        <td style="width: 100.0000%;">Location of Service:</td>
    </tr>
    <tr>
        <td style="width: 100.0000%;">{{ $sales_order->address }}</td>
    </tr>
    </tbody>
</table>
<p><u><span style="font-family: Impact, Charcoal, sans-serif; font-size: 18px;">Product Details</span></u></p>
<style>
    #product-main {
        border-collapse: collapse;
    }

    #product-main > tbody >  tr > td {
        border: 1px solid black;
    }

</style>
<table id="product-main" style="width: 100%;">
    <tbody>
    <tr>
        <td style="width: 12.5%; background-color: rgb(247, 218, 100); text-align: center;">Product</td>
        <td style="width: 12.5%; background-color: rgb(247, 218, 100); text-align: center;">Quantity</td>
        <td style="width: 12.5%; background-color: rgb(247, 218, 100); text-align: center;">Selling Price</td>
        <td style="width: 12.5%; background-color: rgb(247, 218, 100); text-align: center;">Discount</td>
        <td style="width: 12.5%; background-color: rgb(247, 218, 100); text-align: center;">Unit Total</td>
        <td style="width: 12.5%; background-color: rgb(247, 218, 100); text-align: center;">Labor Cost</td>
        <td style="width: 12.5%; background-color: rgb(247, 218, 100); text-align: center;">Labor Total</td>
        <td style="width: 12.5%; background-color: rgb(247, 218, 100); text-align: center;">
            <div style="text-align: center;">Total Cost</div>
        </td>
    </tr>
    @foreach($product_details as $item)
        @if(count($item) > 2)
            <tr>
                <td style="width: 12.5%; background-color: rgb(255, 255, 255);">{{ $item['product_name'] }}</td>
                <td style="width: 12.5%; background-color: rgb(255, 255, 255);">{{ $item['qty'] }}</td>
                <td style="width: 12.5%; background-color: rgb(255, 255, 255);">{{ $item['selling_price'] }}</td>
                <td style="width: 12.5%; background-color: rgb(255, 255, 255);">{{ $item['discount_item'] }}</td>
                <td style="width: 12.5%; background-color: rgb(255, 255, 255);">{{ $item['qty'] * $item['selling_price'] }}</td>
                <td style="width: 12.5%; background-color: rgb(255, 255, 255);">{{ $item['labor_cost'] }}</td>
                <td style="width: 12.5%; background-color: rgb(255, 255, 255);">{{ $item['labor_cost'] * $item['qty'] }}</td>
                <td style="width: 12.5%; background-color: rgb(255, 255, 255);">{{ ($item['labor_cost'] * $item['qty']) + ($item['qty'] * $item['selling_price']) }}</td>
            </tr>
        @else
            <tr>
                <td colspan="8" style="width: 12.5%; background-color: rgb(222, 217, 71);">{{ $item['category'] }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
<table style="width: 97%; margin-left: calc(3%);">
    <tbody>
    <tr>
        <td style="width: 87.4434%;  text-align: right;">
            <div data-empty="true" style="text-align: right;">Sub Total</div>
        </td>
        <td style="width: 12.4398%;">
            <div data-empty="true" style="text-align: left;">{{ $summary->sub_total }}</div>
        </td>
    </tr>
    <tr>
        <td style="width: 87.4434%;  text-align: right;">
            <div data-empty="true" style="text-align: right;">Shipping</div>
        </td>
        <td style="width: 12.4398%;">
            <div data-empty="true" style="text-align: left;">{{ $summary->shipping }}</div>
        </td>
    </tr>
    <tr>
        <td style="width: 87.4434%;  text-align: right;">
            <div data-empty="true" style="text-align: right;">Sales Tax</div>
        </td>
        <td style="width: 12.4398%;">
            <div data-empty="true" style="text-align: left;">{{ $summary->sales_tax }}</div>
        </td>
    </tr>
    <tr>
        <td style="width: 87.4434%;  text-align: right;">
            <div data-empty="true" style="text-align: right;">Grand Total</div>
        </td>
        <td style="width: 12.4398%;">
            <div data-empty="true" style="text-align: left;">{{ $summary->sales_tax + $summary->shipping + $summary->sub_total }}</div>
        </td>
    </tr>
    </tbody>
</table>
<p><u><span style="font-family: Impact, Charcoal, sans-serif; font-size: 18px;">Terms &amp; Conditions</span></u></p>
<table style="width: 100%;">
    <tbody>
    <tr>
        <td style="width: 100.0000%;">{{ $sales_order->tac }}</td>
    </tr>
    </tbody>
</table>
<p>
    <br>
</p>
<table style="width: 20%; margin-right: calc(80%);">
    <tbody>
    <tr>
        <td style="width: 100.0000%;">Prepared by:
            <br>
        </td>
    </tr>
    <tr>
        <td style="width: 100.0000%;">_____________________</td>
    </tr>
    <tr>
        <td style="width: 100%; text-align: left;"><span style="font-size: 14px;"><sub>Signature Over Printed Name</sub></span></td>
    </tr>
    </tbody>
</table>
<p>
    <br>
</p>
<table style="width: 20%; margin-right: calc(80%);">
    <tbody>
    <tr>
        <td style="width: 100.0000%;">Conforme:
            <br>
        </td>
    </tr>
    <tr>
        <td style="width: 100.0000%;">____________________</td>
    </tr>
    <tr>
        <td style="width: 100%; text-align: left;"><span style="font-size: 14px;"><sub>Signature Over Printed Name</sub></span>
            <br>
        </td>
    </tr>
    </tbody>
</table>