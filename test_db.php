<?php
require __DIR__ . '/config/database.php';

echo "PHP SAPI : " . php_sapi_name() . "<br>";
echo "php.ini chargé : " . (php_ini_loaded_file() ?: 'introuvable') . "<br>";
echo "Extension PDO : " . (extension_loaded('pdo') ? 'OK' : 'MANQUANTE') . "<br>";
echo "Extension pdo_pgsql : " . (extension_loaded('pdo_pgsql') ? 'OK' : 'MANQUANTE') . "<br><br>";

try {
	$pdo = \Database::getInstance();
	$stmt = $pdo->query("SELECT version()");
	$version = $stmt->fetch();
	echo "Connexion réussie ! Version PostgreSQL : " . $version['version'];
} catch (Throwable $e) {
	echo "Échec de connexion : " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
