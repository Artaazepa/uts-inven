<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-size: 18px;
      font-family: Arial, Helvetica, sans-serif;
      margin: 20px;
    }

    table.center {
      margin-left: auto;
      margin-right: auto;
      width: 80%;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid black;
      padding: 10px;
    }

    th {
      text-align: left;
      background-color: #f2f2f2;
    }

    .page-break {
      page-break-after: always;
    }
  </style>
</head>

<body>
  @foreach($commodities as $key => $commodity)
  <table class="center">
    <tr>
      <td colspan="2" style="text-align: center;">Barang Milik {{$sekolah}}</td>
    </tr>
    <tr>
      <th>Kode Barang:</th>
      <td>{{ $commodity->item_code }}</td>
    </tr>
    <tr>
      <th>Nama Barang:</th>
      <td>{{ $commodity->name }}</td>
    </tr>
    <tr>
      <th>Asal Perolehan:</th>
      <td>{{ optional($commodity->school_operational_assistance)->name ?? '-' }}</td>
    </tr>
  </table>
  <br>

  @if (($key + 1) % 4 == 0)
  <div class="page-break"></div>
  @endif

  @endforeach
</body>

</html>
