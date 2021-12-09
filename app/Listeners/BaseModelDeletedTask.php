<?php

namespace App\Listeners;

use App\Events\BaseModelDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class BaseModelDeletedTask
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\=BaseModelDeleted  $event
     * @return void
     */
    public function handle(BaseModelDeleted $event)
    {
        $base_model = $event->getBaseModel();
        Log::info('base model deleted', $base_model->toArray());
    }
}
