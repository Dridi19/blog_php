<?php /** @var App\Entity\User $user */ ?>
<h1><?= $trucs; ?></h1>

    <form action="" method="POST">
        <input type="text" placeholder="content" name="content">
        <button class="btn" type="submit" name="post_btn" >Create</button>
    </form>
<?php
/** @var App\Entity\Post[] $posts */
foreach ($posts as $post) {
    echo '<div>'. $post->getContent().'</div>';
    if ( $post->getAuthor() == $_SESSION["id"]) {
        $id = $post->getId();
        echo '<button class="btn" type="submit" name="post_btn"><a href="/post/'.$id.'/delete">delete</a></button>';
        echo '<button class="btn" type="submit" name="post_btn"><a href="/post/'.$id.'/update">Update</a></button>';
    }
}


