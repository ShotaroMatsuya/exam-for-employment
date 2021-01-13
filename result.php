<?php
require_once("includes/header.php");
require_once("includes/classes/ResultsProvider.php");

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

?>
<header id="main-header" class="py-2 bg-danger text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><i class="fas fa-chart-bar mr-2"></i> 回答一覧ページ</h1>
            </div>
        </div>
    </div>
</header>

<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <p class="lead">アンケートの結果一覧ページです</p>
                </div>
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>回答者氏名</th>
                            <th>(回答日時)</th>
                            <th>詳細ページ</th>
                        </tr>
                    </thead>
                    <?php
                    $pageSize = 6;
                    $resultsProvider = new ResultsProvider($con);
                    echo $resultsProvider->getResultsHtml($page, $pageSize);
                    ?>
                </table>
                <!-- PAGINATION -->
                <nav class="ml-4">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a href="#" class="page-link">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a href="#" class="page-link">1</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>