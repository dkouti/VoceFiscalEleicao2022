<?php
 include 'ImageResize.php';
 if ((!empty($_FILES)|| (!empty($_POST['g-recaptcha-response'])))) {


    $url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = "6Le_pJkiAAAAAOmVaS6Yhw1WQxs4FNbiF4otCpjt";
    $response = $_POST['g-recaptcha-response'];
    $variaveis = "secret=".$secret."&response=".$response;
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$variaveis);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $resposta = curl_exec($ch);
    
    $resultado = json_decode($resposta);
    
 
    if ($resultado->success== 1){
    
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $sourcePath = $_FILES['userImage']['tmp_name'];
        $targetPath = "./images/" . $_FILES['userImage']['name'];
        if (move_uploaded_file($sourcePath, $targetPath)) {

            $usuario_banca = "vocefisc_voce";  // lembrar de alterar o tipo de usuario, criar um usuario sem permiss達o de deletar
            $senha_banco = "pfRZ{itY5rL]";
           
            try {
               $conn = new PDO('mysql:host=localhost;dbname=vocefisc_voce', $usuario_banca, $senha_banco);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           } catch(PDOException $e) {
               echo 'ERRO: ' . $e->getMessage();
           }// transforma a data em padr達o americano (MYSQL)
           
            

            $final = "https://vocefiscal.com.br/v2/images/".$_FILES['userImage']['name']."";
            $arquivo = "./images/".$_FILES['userImage']['name'];
        
            $data = date('Y-m-d');
            $hora = date('H:i:s');
            
            $file = new SplFileInfo($targetPath);
            $extension  = strtoupper($file->getExtension());
            
           if ($extension == "JPG" || $extension == "JPEG" || $extension == "PNG"){
         
        $imagem_Pz = "./images/thumb_".$_FILES['userImage']['name'];
        $image_resize = new \Gumlet\ImageResize($targetPath);
        $image_resize->resize(200, 300);
        $image_resize->save($imagem_Pz);
        $thumb = "https://vocefiscal.com.br/v2/".$imagem_Pz;

               $image = new \Gumlet\ImageResize($targetPath);
             $image->quality_jpg = 50;
             $image->save($targetPath);
              

            }

             $salvar = $conn->query("INSERT INTO `ocorrencias` (`id`, `nome`, `data`, `time`, `estado`, `cidade`, `descricao`, `arquivo`, `thumb`, `otimizado`, `status`, `zona`, `secao`, `extensao`)
              VALUES (NULL, '".$_REQUEST["nome"]."', '".$data."', '".$hora."', '".$_REQUEST["estados"]."', '".$_REQUEST["cidades"]."', '".$_REQUEST["descricao"]."', '".$final."', '".$thumb."', '0', '0', '".$_REQUEST["zona"]."', '".$_REQUEST["secao"]."', '".$extension."');");
            ?>
 
<h3 class="h3">Ocorrência enviada com sucesso!</h3>
<?php
        }
    }
}
 }
?>