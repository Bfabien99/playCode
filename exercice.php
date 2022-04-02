<?php
    require "dbconnect.php";
    require "Judge0.php";
    $judge = new Judge0();
    $languages = $judge->getLanguage();

    $msg ="";
    $exercice = $connect->prepare("SELECT * FROM exercice WHERE enable = 1");
    $exercice->execute();
    $exercice = $exercice->fetch();

    if (isset($_POST["submit"])) {
        $id = $exercice->id;
        if (!empty($_POST["source"])) {
            $source = $_POST['source'];
                $language_id = $_POST['language'];
                $datas = $judge->sendCode($source,$language_id);
                if (!empty($datas['token'])) {
                    $token = $datas['token'];
                    $response = $judge->getResponse($token);
                }
            if ($_POST["source"] == $exercice->correction) {
                $msg = "<p class='success'>Correct</p>";
                if ($id != 3) {
                    $update = $connect->prepare("UPDATE `exercice` SET `enable` = 0 WHERE `exercice`.`id` = $id");
                    $update->execute();
                    $update2 = $connect->prepare("UPDATE `exercice` SET `enable` = 1 WHERE `exercice`.`id` = ($id+1)");
                    $update2->execute();
                }
                else {
                    $msg = "<p class='success'>Bravo, vous avez terminé tous les exercices</p>";
                    $update = $connect->prepare("UPDATE `exercice` SET `enable` = 0 WHERE `exercice`.`id` = $id");
                    $update->execute();
                    $update2 = $connect->prepare("UPDATE `exercice` SET `enable` = 1 WHERE `exercice`.`id` = 1");
                    $update2->execute();
                }
                
            }
            else {
                $msg = "<p class='error'>Incorrect</p>";
            }
        }else {
            $msg = "<p class='error'>Aucun code soumis</p>";
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
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #f5f5f5;
            width: 100vw;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .container{
            width: 90%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2em;
            padding: 10px 10px;
            min-height: 90vh;
        }

        .retour{
            text-decoration: none;
            text-align: center;
            color: #333;
            background-color: white;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #333;
        }

        .title{
            text-decoration: underline;
        }

        form{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5em;
            padding: 10px 10px;
        }

        .group{
            display: flex;
            flex-direction: column;
            min-width: 100px;
            width: 500px;
            gap: 1em;
            justify-content: center;
        }

        .group input{
            width: 30%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        input[type="submit"]{
            cursor: pointer;
            background-color: #4CAF50;
            color: #fff;
            transition: all 0.1s;
            width: 30%;
            padding: 10px;
            outline: none;
            border: none;
            font-size: 1.3rem;
        }

        input[type="submit"]:hover{
            background-color: #45a049;
        }

        textarea{
            min-width: 100px;
            width: 500px;
            height: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            resize: none;
            overflow: auto;
        }

        .content{
            display: flex;
            flex-direction: column;
            min-width: 100px;
            width: 500px;
            height: 300px;
            background-color: #333;
            color: white;
            font-style: italic;
            min-height: 200px;
            align-items: flex-start;
            padding: 5px 5px;
            overflow: auto;
        }

        pre{
            text-align: left;
        }

        .error{
            font-style: italic;
            color: red;
        }

        .success{
            font-style: italic;
            color: green;
        }

        strong,em{
            font-weight: bolder;
            color: tomato;
        }

        #hint{
            min-width: 100px;
            width: 200px;
            padding: 10px;
            outline: none;
            border: 1px solid #333;
            cursor: pointer;
        }

        #reload{
            min-width: 100px;
            width: 200px;
            padding: 10px;
            background-color: #5c9df8;
            color: white;
            outline: none;
            cursor: pointer;
            border: none;
            transition: 0.1s;
        }

        #reload:hover{
            background-color: #5d8df9;
        }
    </style>
</head>
<body>
<?php ?>
    <div class="container">
        <a href="../PlayCode/" class="retour">Editeur</a>
        <form action="" method="post">
            <div class="group">
                <?php if(!empty($exercice)):?>
                    <h2><?= "Exercice ".$exercice->id ?></h2>
                    <h3><?= $exercice->titre?></h3>
                    <h3><?= $exercice->enonce?></h3>
                <?php endif; ?>
            </div>

            <div class="group">
                <textarea name="source" id="" cols="30" rows="10" placeholder="Ecrivez votre code ici..." required><?php if(!empty($_POST['source'])){echo $_POST['source'];}?></textarea>
            </div>
            <?php if(!empty($msg)) echo $msg?>
            <div class="group">
                <select name="language" id="language" required>
                        <option value="<?= $languages['id'] ?>"><?=$languages['name'] ?></option>
                </select>
            </div>

            <div class="content">
            <?php if(!empty($response)):?>

                <?php if(!empty($response["stdout"])):?>
                    <?php $resp = trim(str_replace('"',"",$response["stdout"]));?>
                    <pre><?=$resp?></pre>
                <?php elseif(!empty($response["compile_output"])):?>
                    <?php echo $response["compile_output"];?>
                <?php endif;?>

            <?php else:?>

                <pre>Le resultat apparaitra ici...</pre>

            <?php endif;?>

            </div>

            <button type="button" id="hint">
            </button>

            <?php if(!empty($msg) && $msg =="<p class='success'>Correct</p>"):?>
                <button type="button" id="reload">Suivant</button>
            <?php elseif(!empty($msg) && $msg =="<p class='success'>Bravo, vous avez terminé tous les exercices</p>"):?>
                <button type="button" id="reload">Reprendre</button>
            <?php elseif(!empty($msg)):?>
                <input type="submit" value="verifier" name="submit">
            <?php else:?>
                <input type="submit" value="verifier" name="submit">
            <?php endif;?>

        </form>
    </div>
</body>
<script>
   let hint = document.getElementById("hint");
   hint.textContent ="Aide";

   hint.addEventListener("click", function(){
       hint.innerHTML = "<?=$exercice->aide?>";
   })

   document.getElementById("reload").addEventListener("click", function(){
       window.location.href = "../PlayCode/exercice.php" ;
   })

</script>
</html>