<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApiTokens extends Component
{
    public $tokenName = '';

    public $plainTextToken = null;

    protected $rules = [
        'tokenName' => 'required|string|max:255',
    ];

    public function createToken()
    {
        $this->validate();

        $token = Auth::user()->createToken($this->tokenName);

        $this->plainTextToken = $token->plainTextToken;
        $this->tokenName = '';

        session()->flash('message', 'API Token created successfully. Please copy it now, as it will not be shown again.');
    }

    public function deleteToken($tokenId)
    {
        Auth::user()->tokens()->where('id', $tokenId)->delete();
        session()->flash('message', 'API Token deleted.');
    }

    public function render()
    {
        return view('livewire.settings.api-tokens', [
            'tokens' => Auth::user()->tokens()->orderBy('created_at', 'desc')->get(),
        ])->layout('layouts.app');
    }
}
