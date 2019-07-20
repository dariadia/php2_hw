<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/App/public/css/styles.css">
    </link>
    <title>Document</title>
</head>

<body>
    <header class="alert alert-secondary">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Показать всех"><a href="?a=users">Пользователи</a></button>
            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Показать одного"> <a href="?a=user">Пользователь</a></button>
            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Удалить четвертого"><a href="?a=delete"> Удалить</a></button> <!-- удаляет четвертого -->
            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="обновить/добавить"><a href="?a=save"> обновить</a></button>

        </div>
    </header>

    <div class="content"><?= $content ?></div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="/App/public/js/js.js"> </script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>