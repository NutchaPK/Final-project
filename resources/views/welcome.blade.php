<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Tracking Nutrition of CKD patient Project</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    body{
        background-color: #D9F8C4;
    }
    .card{
        height: 300px;
        width: 500px;
        border-radius: 25px;
        position:fixed;
        top:50%;
        left: 50%;
        margin-top: -150px; /* Negative half of height. */
        margin-left: -250px; /* Negative half of width. */
        text-align: center;
        padding-top: 5%;
        
    }
    button{
        border: 0px;
        background-color: #F9F9C5;
        border-radius: 40px; 
        font-size: 150%;
        height: 50px;
        width: 100px;
    }
    button:hover {
        background-color: #D9F8C4;
        padding-right: 25px;
    }

</style>
<body>
    <div class="card">
        <div class="card-body">
            <h1>Tracking Nutrition for CKD Patient</h1>
            <h1>Web Application</h1><br>
            <button  onclick="location.href='{{ route('login') }}'" >Start</button>
        </div>
    </div>
</body>
</html>