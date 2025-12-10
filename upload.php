<?php
// upload.php — processa upload de imagens

// Criar pasta uploads se não existir
$dir = 'uploads/';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

// Verifica se um arquivo foi enviado
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {

    $arquivoTmp = $_FILES['imagem']['tmp_name'];
    $nomeOriginal = basename($_FILES['imagem']['name']);

    // Extensões permitidas
    $extensoes = ['jpg','jpeg','png','gif'];
    $ext = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    if (!in_array($ext, $extensoes)) {
        die('Formato não permitido. Envie JPG, PNG ou GIF.');
    }

    // Gera nome único
    $novoNome = uniqid('img_', true) . '.' . $ext;
    $destino = $dir . $novoNome;

    // Move arquivo
    if (move_uploaded_file($arquivoTmp, $destino)) {
        header('Location: Imagens.html');
        exit();
    } else {
        die('Falha ao salvar a imagem.');
    }

} else {
    die('Nenhum arquivo enviado.');
}
?>
