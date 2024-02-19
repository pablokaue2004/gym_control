<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Usuário</title>
    <style>
        /* Adicione estilos CSS conforme necessário */
    </style>
</head>

<body>
    <h1>Dados do Usuário</h1>
    <table>
        @foreach ($data as $label => $value)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
