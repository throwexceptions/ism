
<h1 style="margin-top: 20px"> PURCHASE ORDER</h1>
<table border="1">
    <thead>
    <th>PO NUMBER</th>
    <th>PRODUCT NAME</th>
    <th>STATUS</th>
    <th>TOTAL</th>
    </thead>
    <tbody>
    <?php $total_po = 0; ?>
    <?php $received = 0; ?>
    <?php $others = 0; ?>
    @foreach($po as $value)
        <tr>
            <td>{{ $value->po_no ?? '' }}</td>
            <td>{{ $value->product_name ?? '' }}</td>
            <td>{{ $value->status }}</td>
            <?php
            if($value->status == 'Received') {
                $received += $value->total;
            } else {
                $others += $value->total;
            }
            ?>
            <td>{{ $value->total }}</td>
            <?php $total_po += $value->total ?>
        </tr>
    @endforeach
    <tr>
        <td colspan="3"></td>
        <td>Final: {{ $total_po }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Received: {{ $received }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Quote: {{ $others }}</td>
    </tr>
    </tbody>
</table>
<h1 style="margin-top: 20px"> SALES ORDER</h1>
<table border="1" >
    <thead>
    <th>SO NUMBER</th>
    <th>PRODUCT NAME</th>
    <th>STATUS</th>
    <th>TOTAL</th>
    </thead>
    <tbody>
    <?php $total_so = 0; ?>
    <?php $shipped = 0; ?>
    <?php $others = 0; ?>
    @foreach($so as $value)
        <tr>
            <td>{{ $value->so_no }}</td>
            <td>{{ $value->product_name ?? '' }}</td>
            <td>{{ $value->status }}</td>
            <?php
                if($value->delivery_status == 'Shipped') {
                    $shipped += $value->total;
                } else {
                    $others += $value->total;
                }
            ?>
            <td>{{ $value->total }}</td>
            <?php $total_so += $value->total; ?>
        </tr>
    @endforeach
    <tr>
        <td colspan="3"></td>
        <td>Final: {{ $total_so }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Shipped: {{ $shipped }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Others: {{ $others }}</td>
    </tr>
    </tbody>
</table>
<h2 style="margin-top: 20px">QUANTITY:  {{ $received }} Received - {{ $shipped }} Shipped = {{ $received - $shipped }}</h2>
