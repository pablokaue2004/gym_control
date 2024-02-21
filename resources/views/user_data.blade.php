<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Usuário</title>
    <style>
        .main: {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100vw;
            font-size: 1.2em;
        }
    </style>
</head>

<body>
    <div class="main ">
        <h1 style="color: #4677A2">Dados do Usuário</h1>
        <table>
            @foreach ($data as $label => $value)
                <tr>
                    <td style="color: #4677A2">{{ $label }}</td>
                    <td style="color: #4074A4">{{ $value }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
