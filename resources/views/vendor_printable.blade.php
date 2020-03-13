<style>
    thead {
        display: table-header-group
    }

    tfoot {
        display: table-row-group
    }

    tr {
        page-break-inside: avoid
    }
</style>

<h2>{{ \Carbon\Carbon::now()->format('F j, Y') }}</h2>

<h3>Vendor List</h3>
<table border="1">
    <thead>
    <th>Customer ID</th>
    <th>Name</th>
    <th>Contact Person</th>
    <th>Landline</th>
    <th>Mobile Phone</th>
    <th>E-mail</th>
    </thead>
    <tbody>
    @foreach ($vendors as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->contact_person }}</td>
            <td>{{ $item->landline }}</td>
            <td>{{ $item->mobile_phone }}</td>
            <td>{{ $item->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>