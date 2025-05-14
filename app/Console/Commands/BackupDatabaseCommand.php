<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BackupDatabaseCommand extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup database weekly';

    public function handle()
    {
        $filename = 'backup-' . date('Y-m-d') . '.sql';
        $path = storage_path('backups/' . $filename);
        
        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists(storage_path('backups'))) {
            mkdir(storage_path('backups'), 0755, true);
        }
        
        // Thực hiện backup thủ công bằng cách export dữ liệu
        $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
        $output = "";
        
        foreach ($tables as $table) {
            $tableName = reset($table);
            $output .= "\n-- Table structure for table `$tableName`\n";
            $createTable = \Illuminate\Support\Facades\DB::select('SHOW CREATE TABLE ' . $tableName);
            $output .= $createTable[0]->{'Create Table'} . ";\n\n";
            
            $rows = \Illuminate\Support\Facades\DB::table($tableName)->get();
            if (count($rows) > 0) {
                $output .= "-- Dumping data for table `$tableName`\n";
                foreach ($rows as $row) {
                    $output .= 'INSERT INTO `' . $tableName . '` VALUES(';
                    $values = array_map(function($value) {
                        return is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
                    }, (array)$row);
                    $output .= implode(',', $values) . ");\n";
                }
            }
        }
        
        file_put_contents($path, $output);
        
        Log::info('Database backup created: ' . $filename);
        $this->info('Database backup created successfully!');
    }
}