<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Рейтинг сайта</title>
<style>
    * {
      margin: 0;
      padding: 0;
    }
    .post {
        margin:5%;
    }
    .image {
        width: 30%;
    }
    .image img {
        width: 100%;
    }
    .rating {
        position: relative;
        margin-top: 2%;
        width: 55%;
    }
    .ratingDefault {
        position: absolute;
        width: 160px;
        height: 32px;
        background-image: url(/public/screenshots/icons/main/default.png);
        z-index: 3;

    }
    .ratingResult {
        position: absolute;
        max-width: 160px;
        height: 32px;
        background-image: url(/public/screenshots/icons/main/rating.png);
        z-index: 5;
    }
    .ratingVote {
        position: relative;
        display: block;
        width: 160px;
        height: 32px;
        z-index: 7;
    }
    .vote li {
        width: 32px;
        height: 32px;
        display: inline-block;
        z-index: 7;
    }
    .vote li:hover {
        cursor:pointer;
    }
    .choise {
        background-image: url(/public/screenshots/icons/main/choose.png);
        width: 32px;
        height: 32px;
        z-index: 8;
    }
    .voters {
        display: block;
        margin-top: 2%;
        padding-top: 1%;
    }
    .showMessage {
        display: block;
        margin-top: 1%;
    }
    .showMessage p {
        padding-bottom: 2%;
    }
    .showMessage a {
        text-decoration: none;
        padding: 1%;
        border-radius: 4px;
        box-shadow: 1px 1px 4px #777;
        background: #415d93;
        color: #ffffff;
    }
    .showMessage a:hover {
        box-shadow: 1px 1px 2px rgba(119, 119, 119, 0.63);
    }
</style>
</head>
<body>
<div class="post">
<div class="image">
<img src="/public/screenshots/usersFiles/Nikolay-Drozdov/posts/1/31.jpg">
</div>
<div class="rating">
<div class="ratingDefault"></div>
<div class="ratingResult"></div>
<div class="ratingVote">
<ul class="vote">
<li class="one"></li>
<li class="two"></li>
<li class="three"></li>
<li class="four"></li>
<li class="five"></li>
</ul>
</div>
<div class="voters"></div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="Application.js"></script>
</body>
</html>