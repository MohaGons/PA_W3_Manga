<form method="<?= $config["config"]["method"]??"POST" ?>"
      action="<?= $config["config"]["action"]??""?>"
      id="<?= $config["config"]["id"]??""?>"
      enctype="<?= $config["config"]["enctype"]??""?>"
      class="<?= $config["config"]["class"]??""?>">


    <?php App\Core\Builder::renderInstaller($config); ?>



    <input type="submit" id="submit-button" value="<?= $config["config"]["submit"]??"Envoyer"?>">
</form>