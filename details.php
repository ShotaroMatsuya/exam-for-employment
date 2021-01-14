<?php
require_once("includes/header.php");

if (!isset($_GET["id"])) {
    header("Location: 500.php");
}
$detail = new DetailProvider($con, $_GET["id"]);
?>
<header id="main-header" class="py-2 bg-warning text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><i class="fas fa-info-circle mr-2"></i> 回答詳細ページ</h1>
            </div>
        </div>
    </div>
</header>
<div class="container my-4">
    <div class="card card-default mb-5">
        <div class="card-header">
            <p class="lead">回答詳細</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 my-2">
                    <div class="card text-center">
                        <div class="card-header bg-dark text-white">
                            <p class="lead">氏名を教えて下さい</p>
                        </div>
                        <div class="card-body">
                            <h5>-><?php echo $detail->getName(); ?>さん</h5>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 my-2">
                    <div class="card text-center">
                        <div class="card-header bg-dark text-white">
                            <p class="lead">年齢を教えて下さい</p>
                        </div>
                        <div class="card-body">
                            <h5>-><?php echo $detail->getAge() ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-2">
                    <div class="card text-center">
                        <div class="card-header bg-dark text-white">
                            <p class="lead">性別を教えてください</p>
                        </div>
                        <div class="card-body">
                            <h5>-><?php echo $detail->getSex(); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col my-2">
                    <div class="card text-center">
                        <div class="card-header bg-dark text-white">
                            <p class="lead">希望物件種別を教えてください</p>
                        </div>
                        <div class="card-body">
                            <h5>->
                                <?php foreach ($detail->getProperty() as $prop) {
                                    echo "<span class='h4 mr-2'>" . $prop . ". </span>";
                                } ?>
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col my-2">
                    <div class="card text-center">
                        <div class="card-header bg-dark text-white">
                            <p class="lead">その他ご要望をご入力ください</p>
                        </div>
                        <div class="card-body">
                            <h5 style="white-space:pre-wrap">-><?php echo $detail->getComment(); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="result.php" class="btn btn-primary btn-lg">一覧へ戻る</a>
        </div>
    </div>
</div>