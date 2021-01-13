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
                    $resultsProvider = new ResultsProvider($con);
                    $pageSize = 1;
                    $numResults = $resultsProvider->getNumResults();
                    echo $resultsProvider->getResultsHtml($page, $pageSize);

                    ?>
                </table>
                <!-- PAGINATION -->
                <nav class="ml-4">
                    <ul class="pagination">
                        <?php
                        $pageToShow = 5;
                        $numPages = ceil($numResults / $pageSize);
                        $pagesLeft = min($pageToShow, $numPages);

                        $currentPage = $page - floor($pageToShow / 2);
                        if ($currentPage < 1) {
                            $currentPage = 1;
                        }
                        if ($currentPage + $pagesLeft > $numPages + 1) {
                            $currentPage = $numPages + 1 - $pagesLeft;
                        }


                        ?>
                        <li class="page-item <?php if ($page == 1) {
                                                    echo 'disabled';
                                                }  ?>">
                            <a href="result.php?page=<?php echo $page - 1 ?>" class="page-link">Previous</a>
                        </li>
                        <?php
                        while ($pagesLeft != 0 && $currentPage <= $numPages) {
                            if ($currentPage == $page) {
                                echo "<li class='page-item active'><a href='result.php?page=$currentPage' class='page-link'>$currentPage</a></li>";
                            } else {
                                echo "<li class='page-item'><a href='result.php?page=$currentPage' class='page-link'>$currentPage</a></li>";
                            }
                            $pagesLeft--;
                            $currentPage++;
                        }
                        ?>
                        <li class="page-item <?php if ($page == $numPages) {
                                                    echo 'disabled';
                                                }  ?>">
                            <a href="result.php?page=<?php echo $page + 1 ?>" class="page-link">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>