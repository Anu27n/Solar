<?php
$output = shell_exec('php -l d:/Solar/database/seeders/SolarProductSeeder.php 2>&1');
file_put_contents('d:/Solar/error_clean.txt', $output);
