<?php
function backupDb() {
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'semester project 2';
    $backup_file = 'E:/EPA/NTUA/ECE/FLOWS/FLOW L/Databases/Backup/SQLbackup.sql';

    $command = "mysqldump --user=$dbuser --password=$dbpass --host=$dbhost $dbname > $backup_file";
    $output = [];
    $return_var = NULL;
    exec($command, $output, $return_var);

    if ($return_var !== 0) {
        // handle the error
        return 'Failed to backup database';
    }
    return 'Database backup successful';
}
echo backupDb();
?>
