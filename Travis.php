<?php

/*
 * MyMoney is licensed under the BoxOfDevs license 1.1.2
 *
 * By using MyMoney you automatically agree to the license.
 */

$server = proc_open(PHP_BINARY.' src/pocketmine/PocketMine.php --no-wizard --disable-readline', [
    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w'],
], $pipes);
fwrite($pipes[0], "version\nmakeplugin MyMoney\nstop\n\n");
while (!feof($pipes[1])) {
    echo fgets($pipes[1]);
}
fclose($pipes[0]);
fclose($pipes[1]);
fclose($pipes[2]);
echo "\n\nReturn value: ".proc_close($server)."\n";
if (count(glob('plugins/DevTools/MyMoney*.phar')) === 0) {
    echo "Failed to create MyMoney phar!\n";
    exit(1);
} else {
    echo "MyMoney phar created!\n";
    exit(0);
}
