<style>
thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>

<h2>{{ \Carbon\Carbon::now()->format('F j, Y') }}</h2>

<h3>Inventory Assets</h3>
<table border="1">
<thead>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Sub-total</th>
</thead>
<tbody>
    <?php $grand_total = 0 ?>
    @foreach ($supply as $item)
    <?php $grand_total += $item->quantity  * $item->selling_price ?>
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->selling_price, 2, '.', '') }}</td>
            <td>{{ $item->quantity  * $item->selling_price }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
  <tr>
    <td colspan="2"></td>
    <td><strong>Grand Total</strong></td>
    <td>{{ $grand_total }}</td>
  </tr>
</tfoot>
</table>