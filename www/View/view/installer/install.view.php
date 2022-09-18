<div class="flex flex-center flex-middle bg-lighter h-100 p-l">
    <div class="card flex-column p-l rounded h-100 scroll-y">
        <h1 class="text-center mt-m mb-l">Installation de Manga CMS</h1>

        <?php $this->includePartial("install", $install);?>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error. "<br>";
            }
        }?>

    </div>


</div>