<?php

include("SitesSearch.php");
include("ImagesSearch.php");

if(isset($_GET["searchTerm"]))
{
    $term = $_GET["searchTerm"];
}

$type = isset($_GET["searchType"]) ? $_GET["searchType"] : 'sites';
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
?>
<html>

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" href="assets/images/nroub.com-favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/images/nroub.com-favicon.png" type="image/x-icon">
	<meta property="og:url" content="https://nroub.com">
	<meta property="og:type" content="search engine">
	<meta property="og:title" content="Nroub">
	<meta property="og:description" content="NROUB is a search engine and web portal. NROUB offers internet search and other services. Search the world's information, including web pages, images, videos and more. NROUB has many special features to help you find exactly what you're looking.  NROUB helps you turn information into action, making it faster and easier to go from searching to doing. You get more out of the web, you get more out of life. NROUB empowers you to seamlessly take control of your personal information online, without any tradeoffs.">
	<meta property="article:author" content="https://www.facebook.com/zihadultalukder9900/" />
	<meta property="article:author" content="https://www.youtube.com/channel/UC4GAc0RBcNqSlC22pTwtVQw" />
	<meta property="article:author" content="https://www.instagram.com/zihadultalukder9900/" />
	<meta property="article:author" content="https://twitter.com/ZihadulTalukder" />
	<meta property="article:author" content="https://www.linkedin.com/in/zihadul-talukder-66371a240/" />
	<meta property="article:author" content="https://github.com/zihadulislam99" />
	<meta name="description" content="NROUB is a search engine and web portal. NROUB offers internet search and other services. Search the world's information, including web pages, images, videos and more. NROUB has many special features to help you find exactly what you're looking.  NROUB helps you turn information into action, making it faster and easier to go from searching to doing. You get more out of the web, you get more out of life. NROUB empowers you to seamlessly take control of your personal information online, without any tradeoffs.">
	<meta name="keywords" content="nroub, nroub images, nroub image search, nroub search engine, nroub web search, nroub video search, make nroub default search engine, ranking search engine, first search engine in the world, name any two popular search engines, top 5 search engine in the world, most used search engine in the world, old search engines, 5 search engine, most used search engines, a search engine, Start page search engine, most popular search engines, best image search engine, top 5 search engines, most power full search engine in the world,">
	<meta name="author" content="Zihadul Talukder">

    <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo $term; ?> - Nroub Search</title>
</head>

<body>
    <div class="wrapper">
        <div class="headerSection">
            <div class="headercontent">
                <div class="image_container">
                    <a href="index.php">
                        <img src="assets/images/nroub.com_main-logo.png" />
                    </a>
                </div>
                <div class="textbox_container">
                    <form action='results.php' method='GET'>
                        <div class="search_box">
                            <span class="material-icons"> mic </span>
                            <input value="<?php echo $type; ?>" type="hidden" name="searchType" />
                            <input value="<?php echo $term; ?>" type="text" class="search_textbox" name="searchTerm" />
                            <button class="search_textbtn">
                                <span class="material-icons"> search </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="headerlist">
                <ul class="tablist">
                    <li class="<?php echo $type == 'sites' ? 'active' : ''?>">
                        <a href="<?php echo "results.php?searchTerm=$term&searchType=sites"?>">All Web</a>
                    </li>
                    <li class="<?php echo $type == 'images' ? 'active' : ''?>">
                        <a href="<?php echo "results.php?searchTerm=$term&searchType=images"?>">Images</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="resultsSection">
        <?php 
        $resultInstance = $type == 'images' ? new ImagesSearch() : new SitesSearch();
        $resultRequired = $type == 'images' ? 20 : 15;
        $results = $resultInstance->getResults($page,$resultRequired,$term);

        echo $results[1];
        ?>
        </div>
        <div class="pageSection">
            <div class="pageButtons">
                <div class="pageImageContainer">
                    <img src="assets/images/1page_start.png">
                </div>
                <?php                 
                $maxPages = 10;
                $pagesRequired = ceil($results[0]/$resultRequired);
                $pagesToShow = min($pagesRequired,$maxPages);
                $currentPage = $page - ($maxPages/2);
                if($currentPage <=0){
                    $currentPage = 1;
                }
                if($currentPage + $pagesToShow >= $pagesRequired){
                    $currentPage =  $pagesRequired - $pagesToShow + 1;
                }
                while($pagesToShow !=0){
                    
                    if($currentPage == $page){
                        echo "<div class='pageImageContainer'>
                                <img src='assets/images/1page_selected.png'>
                                <span class='pageNumber'>$currentPage</span>
                            </div>";
                    }
                    else{
                    echo "<div class='pageImageContainer'>
                            <a href='results.php?searchType=$type&searchTerm=$term&page=$currentPage'>
                                <img src='assets/images/1page_other.png'>
                                <span class='pageNumber'>$currentPage</span>
                            </a>
                        </div>";
                    }

                    $pagesToShow--;
                    $currentPage++;
                }
                ?>
                <div class="pageImageContainer">
                    <img src="assets/images/1page_end.png">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/scripts/script.js"></script>
</body>

</html>