<?php
 include 'ImageResize.php';
if (! empty($_FILES)) {
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
            
            $file = new SplFileInfo($thumb);
            $extension  = $file->getExtension();
            
            if ($extension == "JPG" || $extension == "JPEG" || $extension == "PNG"){
         
        $imagem_Pz = "./images/thumb_".$_FILES['userImage']['name'];
        $image_resize = new \Gumlet\ImageResize($targetPath);
        $image_resize->resize(150, 100);
        $image_resize->save($imagem_Pz);
        $thumb = "https://vocefiscal.com.br/v2/".$imagem_Pz;
         
              
              
              
         
               $image = new \Gumlet\ImageResize($targetPath);
             $image->quality_jpg = 20;
             $image->save($targetPath);
              

            }

             $salvar = $conn->query("INSERT INTO `ocorrencias` (`id`, `nome`, `data`, `time`, `estado`, `cidade`, `descricao`, `arquivo`, `thumb`, `otimizado`, `status`, `zona`, `secao`, `extensao`)
              VALUES (NULL, '".$_REQUEST["nome"]."', '".$data."', '".$hora."', '".$_REQUEST["estados"]."', '".$_REQUEST["cidades"]."', '".$_REQUEST["descricao"]."', '".$final."', '".$thumb."', '0', '0', '".$_REQUEST["zona"]."', '".$_REQUEST["secao"]."', '".$extension."');");
            ?>
 
<img src="<?php echo $thumb; ?>" />
<?php
        }
    }
}
?>