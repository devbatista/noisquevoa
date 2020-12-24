<?php

$array = ['image/jpeg', 'image/jpg', 'image/png'];

if (in_array($_FILES['arquivo']['type'], $array)) {
    
    $arquivo = 'arquivos_teste/'.$_FILES['arquivo']['name'];
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivo);

    $width = 500;
    $heigth = 500;
    $finalX = 0;
    $finalY = 0;

    list($larguraOriginal, $alturaOriginal) = getimagesize($arquivo);

    $ratio = $larguraOriginal / $alturaOriginal;
    $ratioDest = $width / $heigth;

    if ($ratioDest > $ratio) {
        $finalWidth = $heigth * $ratio;
        $finalHeight = $heigth;

        $finalY = -(($finalHeight - $heigth) / 2);
    } else {
        $finalHeight = $width / $ratio;
        $finalWidth = $width;

        $finalX = -(($finalWidth - $width) / 2);
    }

    if($finalWidth < $width) {
        $finalWidth = $width;
        $finalHeight = $width / $ratio;
    } else {
        $finalHeight = $heigth;
        $finalWidth = $heigth * $ratio;
    }

    $imagem = imagecreatetruecolor($width, $heigth);
    $originalImg = imagecreatefromjpeg($arquivo);

    imagecopyresampled($imagem, $originalImg, $finalX, $finalY, 0, 0, $finalWidth, $finalHeight, $larguraOriginal, $alturaOriginal);

    header("Content-type: image/jpeg");
    imagejpeg($imagem, null, 100);
    exit;

    $nome = $_FILES['arquivo']['name'];
    move_uploaded_file($_FILES['arquivo']['tmp_name'], 'arquivos_teste/' . $nome);

    echo "Arquivo enviado";
} else {
    echo "Arquivo não suportado";
}
