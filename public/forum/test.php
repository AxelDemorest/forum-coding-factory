<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-xs-12">

                <nav aria-label="Page navigation example">
                    <ul class="pagination">

                        <?php
                        $currentPage = (isset($_GET["page"])) ? $_GET["page"] : 1;
                        $perPage = 5;
                        $totalItems = 1500;

                        $totalPages = ceil($totalItems / $perPage);
                        $currentPage = min(max(1, $currentPage), $totalPages);
                        $firstHalf = ($currentPage < $totalPages / 2) ? 'true' : 'false';
                        ?>

                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="/forum-coding-factory/public/forum/test.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>

                        <!-- <li class="disabled"><a>...</a></li> -->

                        <?php for ($i = 1; $i < $currentPage; ++$i) { ?>
                            <?php if ($i < 3 || $i > $currentPage - 3 || $totalPages < 10) { ?>
                                <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php } elseif ($i == $currentPage - 3) { ?>
                                <li class="disabled"><a class="page-link">...</a></li>
                            <?php } ?>
                        <?php } ?>

                        <li class="page-item disabled"><a class="page-link"><?= $currentPage ?></a></li>

                        <?php for ($i = $currentPage + 1; $i <= $totalPages; ++$i) { ?>
                            <?php if ($i < $currentPage + 3 || $i > $totalPages - 2 || $totalPages < 10) { ?>
                                <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php } elseif ($i == $currentPage + 3) { ?>
                                <li class="disabled"><a class="page-link">...</a></li>
                            <?php } ?>
                        <?php } ?>

                        <li class="page-item <?= ($currentPage == $totalPages) ? "disabled" : "" ?>">
                            <a href="/forum-coding-factory/public/forum/test.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="label label-danger"><?= $currentPage ?></span> Current Page
                    </li>
                    <li class="list-group-item">
                        <span class="label label-warning"><?= $firstHalf ?></span> First Half
                    </li>
                    <li class="list-group-item">
                        <span class="label label-info"><?= $perPage ?></span> Per Page
                    </li>
                    <li class="list-group-item">
                        <span class="label label-info"><?= $totalItems ?></span> Total Items
                    </li>
                    <li class="list-group-item">
                        <span class="label label-info"><?= $totalPages ?></span> Total Pages
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>