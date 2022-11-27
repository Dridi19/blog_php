<?php /** @var App\Entity\User $user */ ?>
<a href="/login">Log in</a>
<a href="/logout">Logout</a>
<h1><?= $trucs; ?></h1>
    <?php if ($_SESSION["id"]){
    echo '<form action="" method="POST">
        <input type="text" placeholder="content" name="content">
        <button class="btn" type="submit" name="post_btn" >Create</button>
        </form>';
    };?>
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


