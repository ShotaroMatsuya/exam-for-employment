<?php
require_once("includes/header.php");

// if (!isset($_SESSION["isAnswered"])) {
//     header("Location: index.php");
// }

?>
<header id="main-header" class="py-2 bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><i class="fas fa-hand-holding-heart mr-2"></i></i>回答完了ページ</h1>
            </div>
        </div>
    </div>
</header>
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card card-default">
                <div class="card-header">
                    <h1 class="text-center my-5">おつかれさまでした</h1>
                </div>
                <div class="card-body text-center">
                    <p class="text-center lead my-5">アンケートの回答を受け付けました。</p>
                    <a href="/Exam" class="btn btn-lg btn-success m-2 w-50">Topに戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>