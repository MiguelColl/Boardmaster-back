<?php

namespace App\Console\Commands;

use App\Models\ProductModel;
use App\Services\Elasticsearch;
use Illuminate\Console\Command;

class ElasticIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:elastic-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert an index to elasticsearch';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $elastic = new Elasticsearch();

        foreach (ProductModel::cursor() as $model) {
            $elastic->insert($model);
            $this->output->write('.');
        }

        $this->output->write(PHP_EOL);
    }
}
