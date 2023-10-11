<?php 
require_once '../../navbar.php';
require_once '../admin/groups.php';
require_once '../../settings.php';

$groups=readJSONFile(APP_PATH.'/data/data.JSON');
print_r($groups);

$index=0;
?>
<!-- About section-->
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Guilds</h2>
                <p class="lead">Browse the guilds open to the public to find your perfect match:</p>
                <?php 
                foreach($groups as $guild){
                ?>
                <div>
                    <h1><?= $guild['name'] ?></h1>
                    <p>Group Type: <?= $guild['type'] ?> </p><br />
                    <p>Open to Join: <?= $guild['openToJoin'] ?> </p><br />
                    <a href="detail.php?index=<?= $index ?>">View Details</a> | 
                    <a href="edit.php?index=<?= $index ?>">Edit</a> | 
                    <a href="delete.php?index=<?= $index ?>">Delete</a>
                </div>
                <hr />
                <? php $index++;
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php 