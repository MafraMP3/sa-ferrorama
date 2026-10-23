
<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php");
    exit;
}

include("../../../infra/database/conn.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../conta.php");
    exit;
}

if (
    !isset($_FILES["usuarioFoto"]) ||
    $_FILES["usuarioFoto"]["error"] === UPLOAD_ERR_NO_FILE
) {
    header("Location: ../../conta.php");
    exit;
}

$foto = $_FILES["usuarioFoto"];

if ($foto["error"] !== UPLOAD_ERR_OK) {
    exit("Erro ao enviar a imagem.");
}

if ($foto["size"] > 2 * 1024 * 1024) {
    exit("A imagem deve ter no máximo 2 MB.");
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$tipo = $finfo->file($foto["tmp_name"]);

$tiposPermitidos = [
    "image/jpeg" => "jpg",
    "image/png" => "png",
    "image/webp" => "webp"
];

if (!isset($tiposPermitidos[$tipo])) {
    exit("Formato de imagem inválido.");
}

$pasta = __DIR__ . "/../../assets/uploads/accounts/";

if (!is_dir($pasta) && !mkdir($pasta, 0755, true)) {
    exit("Não foi possível criar a pasta de imagens.");
}

$nomeArquivo = bin2hex(random_bytes(16))
    . "." . $tiposPermitidos[$tipo];

$caminhoCompleto = $pasta . $nomeArquivo;
$caminhoBanco = "assets/uploads/accounts/" . $nomeArquivo;

if (!move_uploaded_file($foto["tmp_name"], $caminhoCompleto)) {
    exit("Não foi possível salvar a imagem.");
}

$idUsuario = $_SESSION["usuario_id"];

$sql = "UPDATE usuarios SET usuarioFoto = ? WHERE idUsuario = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    unlink($caminhoCompleto);
    exit("Erro ao preparar a atualização.");
}

mysqli_stmt_bind_param($stmt, "si", $caminhoBanco, $idUsuario);

if (!mysqli_stmt_execute($stmt)) {
    unlink($caminhoCompleto);
    exit("Não foi possível atualizar a foto.");
}

$_SESSION["usuario_foto"] = "/sa-ferrorama/public/" . $caminhoBanco;

mysqli_stmt_close($stmt);

header("Location: ../../conta.php");
exit;
?>
