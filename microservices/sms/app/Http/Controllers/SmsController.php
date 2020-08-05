<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Sendchamp;

class SmsController extends Controller
{
    protected $champ;

    public function __construct(Sendchamp $champ)
    {
        $this->champ = $champ;
    }

    public function send()
    {
        return $this->champ->send();
    }
}
