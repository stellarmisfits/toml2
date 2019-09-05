<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Yosymfony\Toml\TomlBuilder;

class TomlController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
//        $account = Account::where(\DB::raw('LOWER(public_key)'), strtolower($key))
//            ->with('assets')->first();
//
//        if(!$account){
//            $account = Account::where(\DB::raw('LOWER(slug)'), strtolower($key))
//                ->with('assets')->firstOrFail();
//        }
//
        $tb = new TomlBuilder();
        $tb->addValue('ACCOUNTS',[$slug]);
//
//        $account->assets->each(function ($asset) use ($tb) {
//            $tb->addArrayTables('CURRENCIES');
//            if($asset->code) $tb->addValue('code', $asset->code);
//            if($asset->display_decimals) $tb->addValue('display_decimals', $asset->display_decimals);
//            if($asset->name) $tb->addValue('name', $asset->name);
//            if($asset->description) $tb->addValue('desc', $asset->description);
//            if($asset->conditions) $tb->addValue('conditions', $asset->conditions);
//            if($asset->image) $tb->addValue('image', $asset->image);
//        });
//
//        $tb
//            ->addTable('ACCOUNT_DETAILS')
//            ->addComment('The properties contained this section are specific to astrapass.com and might not be recognized by other wallets. The expanded toml specification used by astrapass can be found at https://astrapass.com/toml.')
//            ->addValue('name', $account->name)
//            ->addValue('public_key', $account->public_key);
//        if($account->description) $tb->addValue('desc', $account->description);
//        if($account->details) $tb->addValue('details', $account->details);
//        if($account->avatar_url) $tb->addValue('avatar_url', $account->avatar_url);
//        if($account->hero_url) $tb->addValue('hero_url', $account->hero_url);
//        // ->addValue('address', $account->address->address_string);
//        // ->addValue('contact', $account->contact->contact_string); // email, phone number

        return response($tb->getTomlString(), 200)
            ->header('Content-Type', 'text/plain');
    }
}
