<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Visible;
use App\Models\AccessToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\AccessGrantMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AccessTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAccessToken(Product $product)
    {
        $adminEmail = config('mail.from.address');
        $admin = User::whereEmail('zoli.szabok@gmail.com')->first();
        $token = Str::random(40); // Generate a unique token
        $user_id = auth()->user()->id;
        // Store the token in the database
        $accessToken = AccessToken::firstOrCreate([
            'user_id' => $user_id,
            'product_id' => $product->id,
            'used' => 0,
            // Mark the token as not used
        ]);

        $accessToken->update(['token' => $token, 'used' => false]);
        $accessToken->save();
        $user = auth()->user();
        Mail::to('cegem360@gamil.com')->cc($admin)->send(new AccessGrantMail($token, $user->name));
        return redirect()->route('products.myproducts')->with('success', __('Succesfuly send an email to administrator who will grant an access to private datas, please wait until is access in grant.'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function activateAccessToken($token)
    {
        $accessToken = AccessToken::with('user')->where('token', $token)->first();
        if (!$accessToken->used) {
            $accessToken->update(['used' => 1]);
            $visibility = Visible::firstOrNew([
                'product_id' => $accessToken->product_id,
                'user_id' => $accessToken->user_id,
            ]);
            $visibility->update(['isVisible' => 1]);
            return redirect()->route('products.index')->with('success', 'access grated to ' . $accessToken->user->name);
        }
        return redirect()->route('products.index')->with('error', 'access token is expired or used');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccessToken $accessToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccessToken $accessToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccessToken $accessToken)
    {
        //
    }
}
