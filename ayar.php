<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=ajaxchat", "root", "");
} catch ( PDOException $e ){
     print $e->getMessage();
}
?> 