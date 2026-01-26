<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dahsboard</title>
</head>
<body>
    <button>
        <a href="/logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="/logout" method="POST" class="d-none">
            @csrf
        </form>
    </button>
</body>
</html>