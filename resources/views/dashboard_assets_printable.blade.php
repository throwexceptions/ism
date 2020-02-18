<table border="1">
<thead>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Price</th>
</thead>
<tbody>
    @foreach ($supply as $item)
    <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->selling_price }}</td>
    </tr>
    @endforeach
</tbody>
</table>