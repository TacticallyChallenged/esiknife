<?php

namespace ESIK\Jobs\ESI;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use ESIK\Traits\Trackable;
use ESIK\Http\Controllers\DataController;

class GetSystem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    public $id, $dataCont;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->id = $id;
        $this->dataCont = new DataController();
        $this->prepareStatus();
        $this->setInput(['id' => $this->id]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $getSystem = $this->dataCont->getSystem($this->id);
        $status = $getSystem->status;
        $payload = $getSystem->payload;
        if (!$status) {
            throw new \Exception($payload->message, 1);
        }
    }
}
