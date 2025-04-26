<?php

use App\Jobs\ElasticReindex;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new ElasticReindex())->weekly();
