<style>
    thead { display: table-header-group }
    tfoot { display: table-row-group }
    tr { page-break-inside: avoid }
</style>
<h2>{{ \Carbon\Carbon::now()->format('F j, Y') }}</h2>

<h3>Quote</h3>
<table border="1">
    <thead>
        <th>QTN #</th>
        <th>Customer</th>
        <th>Date Created</th>
        <th>Grand Total</th>
    </thead>
    <tbody>
        @foreach ($data as $item)
         @if($item->status == 'Quote')
            <tr>
                <td>{{ str_replace('SO', 'QTN', $item->so_no) }}</td>
                <td>{{ $item->customer_name }}</td>
                <td>{{ \Carbon\Carbon::parse($item->date_created)->format('F j, Y') }}</td>
                <td>{{ $item->grand_total }}</td>
            </tr>
        @endif
        @endforeach
    </tbody>
</table>