<style>
    thead { display: table-header-group }
    tfoot { display: table-row-group }
    tr { page-break-inside: avoid }
</style>
<h2>{{ \Carbon\Carbon::now()->format('F j, Y') }}</h2>

<h3>Purchase Order</h3>
<table border="1">
    <thead>
        <th>PO #</th>
        <th>Vendor Name</th>
        <th>Date Created</th>
        <th>Grand Total</th>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->po_no }}</td>
            <td>{{ $item->vendor_name }}</td>
            <td>{{ \Carbon\Carbon::parse($item->date_created)->format('F j, Y') }}</td>
            <td>{{ $item->grand_total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>