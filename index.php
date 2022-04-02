<?php
    require "Judge0.php";
    $judge = new Judge0();
    $languages = $judge->getLanguage();

    if (isset($_POST['submit'])) {
        if(!empty($_POST['source']) && !empty($_POST['language']))
        {
            $source = $_POST['source'];
            $language_id = $_POST['language'];
            $datas = $judge->sendCode($source,$language_id);
            if (!empty($datas['token'])) {
                $token = $datas['token'];
                $response = $judge->getResponse($token);
            }
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayCode</title>
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

        .exercice{
            text-decoration: none;
            text-align: center;
            color: #333;
            background-color: white;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #333;
        }

        footer{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1em;
            padding: 10px 10px;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <h3 class="title">Editeur de Code PHP</h3>
        <form action="index.php" method="post">

            <div class="group">
                <textarea name="source" id="" cols="30" rows="10" placeholder="Tapez le code ici..." required><?php if(!empty($source)){echo $source;} ?></textarea>
            </div>

            <div class="group">
                <select name="language" id="language" required>
                        <option value="<?= $languages['id'] ?>"><?=$languages['name'] ?></option>
                </select>

                <input type="submit" value="Executer" name="submit">
            </div>

        </form>
        
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

        <a href="exercice.php" class="exercice">Exercice PHP</a>

    </div>

    <footer>
        <p>&copy; 2022 - ProjetTest_NAN522 - BFabien99</p>
    </footer>

</body>
<script>
    setInterval(()=>{
        window.location.reload();
    },2000)
</script>
</html>