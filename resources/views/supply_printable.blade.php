@if( $type== "PO")
    <table border="1">
        <thead>
        <th>PO NUMBER</th>
        <th>VENDOR NAME</th>
        <th>RECEIVED DATE</th>
        </thead>
        <tbody>

        @foreach($results as $value)
            <tr>
                <td>{{ $value->po_no ?? '' }}</td>
                <td>{{ $value->vendor_name ?? '' }}</td>
                <td>{{ $value->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <table border="1">
        <thead>
        <th>SO NUMBER</th>
        <th>CUSTOMER NAME</th>
        <th>RECEIVED DATE</th>
        </thead>
        <tbody>
        @foreach($results as $value)
            <tr>
                <td>{{ $value->so_no }}</td>
                <td>{{ $value->customer_name }}</td>
                <td>{{ $value->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
