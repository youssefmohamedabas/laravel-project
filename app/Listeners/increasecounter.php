<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class increasecounter
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VideoViewer $event): void
    {
        if(!session()->has('videoIsVisited')){  $this->updateviewer($event->video);}
     
    }
 function updateviewer($v){
    $v->viewer=$v->viewer+1;
    $v->save();
    session()->put('videoIsVisited',$v->id);
 }       //


}