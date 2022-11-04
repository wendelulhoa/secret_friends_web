<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amigo Sorteado</title>
</head>
<body>
    <div>
        <div class="table-responsive mb-3">
            <table class="table row table-borderless w-100 m-0">
                <tbody class="col-lg-6 p-0">
                    <tr>
                        <td><strong>Nome :</strong> {{$chosenFriend['name']}}</td>
                    </tr>
                </tbody>
                <tbody class="col-lg-6 p-0">
                    <tr>
                        <td><strong>Categorias :</strong> {{$chosenFriend['categories']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h4><strong>Observações</strong></h4>
        <p class="description">{!! $chosenFriend['observation'] !!}</p>
    </div>
</body>
</html>