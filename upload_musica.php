<?php

// Pasta onde as músicas serão enviadas
$pasta = "uploads_musicas/";

// Criar a pasta se não existir
if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
}

// Verificar se enviou arquivo
if (isset($_FILES["musica"])) {

    $arquivo = $_FILES["musica"];
    $nomeTemp = $arquivo["tmp_name"];
    $nomeOriginal = basename($arquivo["name"]);

    // Extensão permitida
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    if ($extensao !== "mp3") {
        die("Erro: Apenas arquivos .mp3 são permitidos!");
    }

    // Caminho final
    $destino = $pasta . $nomeOriginal;

    // Mover arquivo
    if (move_uploaded_file($nomeTemp, $destino)) {
        echo "<script>alert('Música enviada com sucesso!'); window.location.href='Músicas.html';</script>";
    } else {
        echo "Erro ao enviar o arquivo.";
    }

} else {
    echo "Nenhum arquivo enviado.";
}

?>
