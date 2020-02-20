<h2>{{ \Carbon\Carbon::now()->format('F j, Y') }}</h2>

<h3>Shipped</h3>
<table border="1">
    <thead>
        <th>SO #</th>
        <th>Customer</th>
        <th>Date Created</th>
        <th>Grand Total</th>
    </thead>
    <tbody>
        @foreach ($data as $item)
        @if($item->status == 'Shipped')
        <tr>
            <td>{{ $item->so_no }}</td>
            <td>{{ $item->customer_name }}</td>
            <td>{{ \Carbon\Carbon::parse($item->date_created)->format('F j, Y') }}</td>
            <td>{{ $item->grand_total }}</td>
           </tr>
       @endif
        @endforeach
    </tbody>
</table>

