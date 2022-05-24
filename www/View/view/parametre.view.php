<style>
    .form__group {
        position: relative;
        padding: 15px 0 0;
        margin-top: 10px;
        width: 50%;
    }

    .input {
        font-family: inherit;
        width: 50%;
        border: 0;
        border-bottom: 2px solid gray;
        outline: 0;
        font-size: 1.3rem;
        color: black;
        padding: 7px 0;
        margin: 5px;
        background: transparent;
        transition: border-color 0.2s;

    }
    .input:focus {
        padding-bottom: 6px;
        font-weight: 700;
        border-width: 3px;
        border-image: linear-gradient(to right, red,blue);
        border-image-slice: 1;
    }

    .btn {
        padding: 15px 100px;
        margin: 10px 4px;
        cursor: pointer;
        text-transform: uppercase;
        text-align: center;
        position: relative;
    }
    .btn:hover {
        opacity: 0.5;
    }
</style>
<h1>Bonjour <?= strtoupper($data['gender']) ?> . <?= $data['firstname'] ?> <?= $data['lastname'] ?></h1>
<h2>Nom : MonSitedeouf</h2>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<h2 style='color:red'>".$error. "</h2>";
    }
}?>
<?php if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:green'>".$message. "</h2>";
    }
}?>
<div class="form__group field">
<input class="input" type="email" value="aminecheriguifr@gmail.com" disabled>
<?php $this->includePartial("form", $user->getParamForm($data));?>
<button class="btn"><a href="deletecompte?email=<?= $data['email'] ?>">Supprimer mon compte</a></button>
</div>

  


