<style>
    .formparam{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }

</style>
<a href="/admin/utilisateurs"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
<?php
if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:red'>" . $message . "</h2><br>";
    }
}
$this->includePartial("form", $user->updateUser($userData));
?>
