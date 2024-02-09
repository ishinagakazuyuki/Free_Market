<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\buyer;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class Payment_status extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Payment Status';

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
        Stripe::setApiKey(config('stripe.stripe_secret_key'));
        $buyers = buyer::get();
        $sessions = Session::all(['limit' => 100]);
        foreach($buyers as $buyer){
            if($buyer['pay_flg'] == '1'){
                foreach($sessions as $session){
                    if($session['id'] == $buyer['session_id']){
                        if($session['payment_status'] == 'paid'){
                            buyer::where('id','=',$buyer['id'])->first()->update([
                                'pay_flg' => 0,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
