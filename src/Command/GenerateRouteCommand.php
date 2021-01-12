<?php


namespace PhpOne\LaravelAnnotation\Command;


use Illuminate\Console\Command;
use PhpOne\LaravelAnnotation\Parser;

class GenerateRouteCommand extends Command
{
    protected $signature = "annotation-route:generate
                        {--scanDirs=}
                        {--outFile=}
                        {--force=false}
    ";
    protected $description = "
                        sacn annotations dir and generate larael route
                        --scanDirs: your annotations dir , ex: app/Controllers,app/Api
                        --outFile: your route file
                        --force: cover route file, true will rewrite route file, false will append content 
    ";


    public function handle()
    {
        if (empty($this->option('scanDirs'))) {
            $this->error("scanDirs is needed");
            exit();
        }

        if (empty($this->option('outFile'))) {
            $this->error("outFile is needed");
            exit();
        }

        $parser = new Parser(explode(',', $this->option('scanDirs')));
        $parser->writeRoute($this->option('outFile'), $this->option('force'));

        $this->info("write route Success ");
    }

}