<?php

namespace App\Console\Commands;

use App\Models\Charge;
use Illuminate\Console\Command;
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\Transactions\Search\Code;
use App\Helpers\NumberHelper;

class PagSeguroPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkPayment:boleto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check payment in API';

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
     * @return int
     */
    public function handle()
    {
        \PagSeguro\Library::initialize();

        $charges = Charge::where('status', '=', 'Pending')->get();
        foreach ($charges as $charge) {
            if (is_null($charge->referenceId)) {
                continue;
            }
            $code = $charge->referenceId;

            try {
                $response = Code::search(
                    Configure::getAccountCredentials(),
                    $code
                );

                if($response->getStatus() == 3){
                    $charge->status = 'Paid';
                    $charge->paidedAt = NumberHelper::formatDate(new \DateTime());
                    $charge->save();
                }

            } catch (\Exception $e) {
                die($e->getMessage());
            }

        }
        return 0;
    }
}
