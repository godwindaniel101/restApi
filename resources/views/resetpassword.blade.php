<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email</title>
</head>

<body>
    <div>
        <a href="{{ URL('https://vanceprojectmanagement.herokuapp.com/reset/'.$token )}}" target="_blank"> password token is {{$token}} </a>
    </div>
</body>

</html>