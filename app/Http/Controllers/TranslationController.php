<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslationService;

class TranslationController extends Controller
{
    protected $translationService;
    public function __construct(TranslationService $translationService) {
        $this->translationService = $translationService;
        
    }
}
