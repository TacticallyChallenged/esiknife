<?php

Route::match(['GET'],'/', 'PublicController@home')->name('home');
Route::match(['GET'],'/about', 'PublicController@about')->name('about');
Route::match(['GET'],'/donate', 'PublicController@donate')->name('donate');


Route::match(['GET'],'/login', 'AuthController@login')->name('auth.login')->middleware('guest');
Route::match(['GET'],'/logout', 'AuthController@logout')->name('auth.logout');


Route::match(['GET'],'/sso/callback', 'SSOController@callback')->name('sso.callback');
Route::match(['GET'],'/sso/revoke', 'SSOController@revoke')->name('sso.revoke');
Route::match(['GET'],'/sso/refresh', 'SSOController@refresh')->name('sso.refresh');

Route::group(['middleware' => ['auth']], function () {

    Route::match(['GET'], '/dashboard', 'PortalController@dashboard')->name('dashboard');
    Route::match(['GET', 'POST'], '/welcome', 'PortalController@welcome')->name('welcome');
    Route::match(['GET', 'POST'], '/switch', 'PortalController@switch')->name('switch');

    Route::match(['GET'], '/{member}/overview', 'PortalController@overview')->name('overview')->middleware("authorized");
    Route::match(['GET'], '/{member}/assets', 'PortalController@assets')->name('assets')->middleware("authorized:esi-assets.read_assets.v1");
    Route::match(['GET'], '/{member}/bookmarks', 'PortalController@bookmarks')->name('bookmarks')->middleware("authorized:esi-bookmarks.read_character_bookmarks.v1");
    Route::match(['GET'], '/{member}/clones', 'PortalController@clones')->name('clones')->middleware("authorized:esi-clones.read_clones.v1");
    Route::match(['GET'], '/{member}/contacts', 'PortalController@contacts')->name('contacts')->middleware("authorized:esi-characters.read_contacts.v1");
    Route::match(['GET'], '/{member}/contracts', 'PortalController@contracts')->name('contracts')->middleware("authorized:esi-contracts.read_character_contracts.v1");
    Route::match(['GET'], '/{member}/contract/{contract_id}', 'PortalController@contract')->name('contract.view')->middleware("authorized:esi-contracts.read_character_contracts.v1");
    Route::match(['GET'], '/{member}/contracts/interactions', 'PortalController@contractInteractions')->name('contracts.interactions')->middleware("authorized:esi-contracts.read_character_contracts.v1");
    Route::match(['GET'], '/{member}/mails', 'PortalController@mails')->name('mails')->middleware("authorized:esi-mail.read_mail.v1");
    Route::match(['GET'], '/{member}/mail/{mail_id}', 'PortalController@mail')->name('mail')->middleware("authorized:esi-mail.read_mail.v1");
    Route::match(['GET'], '/{member}/skills', 'PortalController@skills')->name('skillz')->middleware("authorized:esi-skills.read_skills.v1");
    Route::match(['GET'], '/{member}/skills/flyable', 'PortalController@flyable')->name('skillz.flyable')->middleware("authorized:esi-skills.read_skills.v1");
    Route::match(['GET'], '/{member}/skillqueue', 'PortalController@queue')->name('skillqueue')->middleware("authorized:esi-skills.read_skillqueue.v1");
    Route::match(['GET'], '/{member}/wallet/transactions', 'PortalController@wallet_transactions')->name('wallet.transactions')->middleware("authorized:esi-wallet.read_character_wallet.v1");
    Route::match(['GET'], '/{member}/wallet/journal', 'PortalController@wallet_journal')->name('wallet.journal')->middleware("authorized:esi-wallet.read_character_wallet.v1");

    Route::match(['GET'], '/settings', 'SettingController@index')->name('settings.index');
    Route::match(['GET', 'DELETE'], '/settings/token', 'SettingController@token')->name('settings.token');
    Route::match(['GET', 'POST'], '/settings/access', 'SettingController@access')->name('settings.access');
    Route::match(['GET', 'POST', "DELETE"], '/settings/group/{hash}', 'SettingController@group')->name('settings.group');
    Route::match(['GET', 'POST'], '/settings/groups', 'SettingController@groups')->name('settings.groups');
    Route::match(['GET', 'POST'], '/settings/grant/{grant}', 'SettingController@grant')->name('settings.grant');
    Route::match(['GET', 'POST', 'DELETE'], '/settings/urls', 'SettingController@urls')->name('settings.urls');
});


Route::match(['GET'], '/hack', 'HackingController@index');
