<a href="../utilisateurs"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
<?php
   if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:red'>" . $message . "</h2><br>";
    }
   }
   $this->includePartial("form", $user->updateUser());
 ?>

