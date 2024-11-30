<?php

use App\Tasks\CalculateWateringTask;

Schedule::job(new CalculateWateringTask)->everyFifteenMinutes();
