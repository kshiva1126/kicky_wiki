<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteTmpImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:tmp-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete temporary images on public/tmp/ directory';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start to delete temporary images');
        
        // public/tmp/にファイルがあるかどうか
        $tmp_images = public_path(). '/tmp/*.png';
        if (shell_exec("ls {$tmp_images}; echo $?") == 0) {
            $command = "rm {$tmp_images}";
            exec($command);
            $this->info('Success to delete temporary images');
        } else {
            $this->info('Not exist temporary images');
        }

        $this->info('End to delete temporary images');
    }
}
