<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tables</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }

        h1 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
            max-width: 500px;
        }

        li {
            background: #fff;
            margin-bottom: 10px;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            background: #28a745;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: #218838;
        }
    </style>
</head>

<body>

    <h1>📋 All Tables</h1>

    <ul>
        @forelse($tableNames as $table)
            <li>
                <span>{{ $table }}</span>

                <a class="btn" href="{{ route('tables.show', $table) }}">
                    Show
                </a>
            </li>
        @empty
            <li>لا يوجد جداول</li>
        @endforelse
    </ul>

</body>
</html>
