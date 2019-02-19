<?php
if(isset($_GET['search']))
{
    include_once 'includes/connection.php';
    $search=mysqli_real_escape_string($conn,$_GET['search']);
    $sql="SELECT * FROM articles WHERE theme LIKE '%$search%' OR title LIKE '%$search%' OR content LIKE '%$search%'";
    $result=mysqli_query($conn,$sql);
    $queryResult=mysqli_num_rows($result);

    if($queryResult > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<div class="card mb-4">';
            //echo '<img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">';
            echo '<div class="card-body">';
            echo '<h2 class="card-title">'. $row['title'].'</h2>';
            echo '<p class="card-text">'.$row['content'].'</p>';
            echo '</div>';
            echo '<div class="card-footer text-muted">';
            echo 'Posted on '.$row['created'];
            //If admin
            if($_SESSION['adminE']==1)
            {
                echo '<a href="modify_article.php?id='.$row['article_id'].'">Módosítás</a>';
            }
            echo '</div>
            </div>';
        }
    }
    else
    {
        echo 'Nincs megfelelő találat';
    }
}
else
{
    header('Location: ../index.php');
    exit();
}