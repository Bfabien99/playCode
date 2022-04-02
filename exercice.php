<?php
    require "dbconnect.php";
    $msg ="";
    $exercice = $connect->prepare("SELECT * FROM exercice WHERE enable = 1");
    $exercice->execute();
    $exercice = $exercice->fetch();

    if (isset($_POST["submit"])) {
        $id = $exercice->id;
        if (!empty($_POST["code"])) {
            if ($_POST["code"] == $exercice->correction) {
                $msg = "Correct";
                if ($id != 3) {
                    $update = $connect->prepare("UPDATE `exercice` SET `enable` = 0 WHERE `exercice`.`id` = $id");
                    $update->execute();
                    $update2 = $connect->prepare("UPDATE `exercice` SET `enable` = 1 WHERE `exercice`.`id` = ($id+1)");
                    $update2->execute();
                }
                else {
                    $msg = "Bravo, vous avez terminé tous les exercices";
                    $update = $connect->prepare("UPDATE `exercice` SET `enable` = 0 WHERE `exercice`.`id` = $id");
                    $update->execute();
                    $update2 = $connect->prepare("UPDATE `exercice` SET `enable` = 1 WHERE `exercice`.`id` = 1");
                    $update2->execute();
                }
                
            }
            else {
                $msg = "Incorrect";
            }
        }else {
            $msg = "Aucun code soumis";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        em{
            color: tomato;
            font-weight: 700;
        }
    </style>
</head>
<body>
<?php ?>
    <div class="container">
        <form action="" method="post">
            <div class="group">
                <?php if(!empty($exercice)):?>
                    <h2><?= "Exercice ".$exercice->id ?></h2>
                    <h3><?= $exercice->titre?></h3>
                    <h3><?= $exercice->enonce?></h3>
                <?php endif; ?>
            </div>

            <div class="group">
                <textarea name="code" id="" cols="30" rows="10" placeholder="Ecrivez votre code ici..." required><?php if(!empty($_POST['code'])){echo $_POST['code'];}?></textarea>
            </div>
            <button type="button" id="hint">
            </button>
            <?php if(!empty($msg) && $msg =="Correct"):?>
                <button type="button" id="reload">Suivant</button>
                <?php $_POST["code"] = "";?>
            <?php elseif(!empty($msg) && $msg =="Bravo, vous avez terminé tous les exercices"):?>
                <button type="button" id="reload">Reprendre</button>
            <?php elseif(!empty($msg)):?>
                <input type="submit" value="verifier" name="submit">
            <?php else:?>
                <input type="submit" value="verifier" name="submit">
            <?php endif;?>
        </form>
        <?php if(!empty($msg)) echo $msg?>
    </div>
</body>
<script>
   let hint = document.getElementById("hint");
   hint.textContent ="Aide";

   hint.addEventListener("click", function(){
       hint.innerHTML = "<?=$exercice->aide?>";
   })

   document.getElementById("reload").addEventListener("click", function(){
       window.location.href = "http://localhost/" ;
   })



</script>
</html>