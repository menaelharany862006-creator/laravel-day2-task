<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table: {{ $tableName }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }

        h1 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: right;
        }

        th {
            background: #28a745;
            color: #fff;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        a.back {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: #28a745;
        }
    </style>
</head>

<body>

    <a class="back" href="{{ route('tables.index') }}">
        ⬅ رجوع لكل الجداول
    </a>

    <h1>📄 Table: {{ $tableName }}</h1>

    @if($rows->count() > 0)

        <table>
            <tr>
                @foreach((array) $rows->first() as $col => $val)
                    <th>{{ $col }}</th>
                @endforeach
            </tr>

            @foreach($rows as $row)
                <tr>
                    @foreach((array) $row as $val)
                        <td>{{ $val }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>

    @else

        <p>لا يوجد بيانات في هذا الجدول.</p>

    @endif

</body>
</html>
