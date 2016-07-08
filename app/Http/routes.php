<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use App\Models\Lrs;
use App\Models\Site;
//use Auth;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    if (Auth::check()) {
        $site = Site::first();

        //if super admin, show site dashboard, otherwise show list of LRSs can access
        if (Auth::user()->role == 'super') {
            return Redirect::route('site.index');
        } else {
            $lrs = Lrs::where('users._id', Auth::user()->_id)->get();
            return View::make('partials.lrs.list', array('lrs' => $lrs, 'list' => $lrs, 'site' => $site));
        }
    } else {
        $site = Site::first();
        if (isset($site)) {
            return View::make('system.forms.login', array('site' => $site));
        } else {
            return View::make('system.forms.register');
        }
    }
});

/*
|------------------------------------------------------------------
| Login
|------------------------------------------------------------------
*/
Route::get('login', array(
    'middleware' => 'guest',
    'uses' => 'LoginController@create',
    'as' => 'login.create'
));
Route::post('login', array(
    'middleware' => 'guest',
    'uses' => 'LoginController@login',
    'as' => 'login.store'
));
Route::get('logout', array(
    'uses' => 'LoginController@destroy',
    'as' => 'logout'
));

/*
|------------------------------------------------------------------
| Register
|------------------------------------------------------------------
*/
Route::get('register', array(
    'middleware' => 'guest',
    'uses' => 'RegisterController@index',
    'as' => 'register.index'
));
Route::post('register', array(
    'middleware' => 'guest',
    'uses' => 'RegisterController@store',
    'as' => 'register.store'
));

/*
|------------------------------------------------------------------
| Password reset
|------------------------------------------------------------------
*/
Route::get('password/reset', array(
    'uses' => 'PasswordController@remind',
    'as' => 'password.remind'
));
Route::post('password/reset', array(
    'uses' => 'PasswordController@request',
    'as' => 'password.request'
));
Route::get('password/reset/{token}', array(
    'uses' => 'PasswordController@reset',
    'as' => 'password.reset'
));
Route::post('password/reset/{token}', array(
    'uses' => 'PasswordController@postReset',
    'as' => 'password.update'
));

/*
|------------------------------------------------------------------
| Email verification
|------------------------------------------------------------------
*/
Route::post('email/resend', function () {
    \Event::fire(new \App\Events\UserEmailResend(\Auth::user()));
    return \Redirect::back()->with('success', \Lang::get('users.verify_request'));
});
Route::get('email/verify/{token}', array(
    'uses' => 'EmailController@verifyEmail',
    'as' => 'email.verify'
));
Route::get('email/invite/{token}', array(
    'uses' => 'EmailController@inviteEmail',
    'as' => 'email.invite'
));

/*
|------------------------------------------------------------------
| Site (this is for super admin users only)
|------------------------------------------------------------------
*/
Route::get('site', array(
    'as' => 'site.index',
    'uses' => 'SiteController@index',
));
Route::get('site/settings', array(
    'uses' => 'SiteController@settings',
));
Route::get('site/apps', array(
    'uses' => 'SiteController@apps',
));
Route::get('site/stats', array(
    'uses' => 'SiteController@getStats',
));
Route::get('site/graphdata', array(
    'uses' => 'SiteController@getGraphData',
));
Route::get('site/lrs', array(
    'uses' => 'SiteController@lrs',
));
Route::get('site/users', array(
    'uses' => 'SiteController@users',
));
Route::get('site/invite', array(
    'uses' => 'SiteController@inviteUsersForm',
    'as' => 'site.invite'
));
Route::post('site/invite', array(
    'uses' => 'SiteController@inviteUsers',
));
Route::get('site/plugins', array(
    'uses' => 'PluginController@index',
));
Route::resource('site', 'SiteController');
Route::put('site/users/verify/{id}', array(
    'uses' => 'SiteController@verifyUser',
    'as' => 'user.verify'
));

/*
|------------------------------------------------------------------
| Lrs
|------------------------------------------------------------------
*/
Route::get('lrs/{id}/statements', array(
    'uses' => 'LrsController@statements',
));
Route::get('lrs/{id}/users', array(
    'uses' => 'LrsController@users',
));
Route::get('lrs/{id}/stats/{segment?}', array(
    'uses' => 'LrsController@getStats',
));
Route::get('lrs/{id}/graphdata', array(
    'uses' => 'LrsController@getGraphData',
));
Route::put('lrs/{id}/users/remove', array(
    'uses' => 'LrsController@usersRemove',
    'as' => 'lrs.remove'
));
Route::put('lrs/{id}/users/{user}/changeRole/{role}', array(
    'uses' => 'LrsController@changeRole',
    'as' => 'lrs.changeRole'
));
Route::get('lrs/{id}/users/invite', array(
    'uses' => 'LrsController@inviteUsersForm',
));
Route::get('lrs/{id}/api', array(
    'uses' => 'LrsController@api',
));

Route::resource('lrs', 'LrsController');

/*
|------------------------------------------------------------------
| Exporting
|------------------------------------------------------------------
*/

// Pages.
Route::get('lrs/{id}/exporting', array(
    'uses' => 'ExportingController@index',
));

/*
|------------------------------------------------------------------
| Lrs client
|------------------------------------------------------------------
*/
Route::get('lrs/{id}/client/manage', array(
    'middleware' => 'auth',
    'uses' => 'ClientController@manage',
    'as' => 'client.manage'
));

Route::delete('lrs/{lrs_id}/client/{id}/destroy', array(
    'middleware' => 'auth',
    'uses' => 'ClientController@destroy',
    'as' => 'client.destroy'
));

Route::get('lrs/{lrs_id}/client/{id}/edit', array(
    'middleware' => 'auth',
    'uses' => 'ClientController@edit',
    'as' => 'client.edit'
));

Route::post('lrs/{id}/client/create', array(
    'middleware' => ['auth', 'csrf'],
    'uses' => 'ClientController@create',
    'as' => 'client.create'
));

Route::put('lrs/{lrs_id}/client/{id}/update', array(
    'middleware' => ['auth', 'csrf'],
    'uses' => 'ClientController@update',
    'as' => 'client.update'
));

/*
|------------------------------------------------------------------
| Reporting
|------------------------------------------------------------------
*/

//index and create pages
Route::get('lrs/{id}/reporting', array(
    'uses' => 'ReportingController@index',
    'as' => 'reporting.index'
));
Route::get('lrs/{id}/reporting/{report_id}/statements', array(
    'uses' => 'ReportingController@statements',
));
Route::get('lrs/{id}/reporting/typeahead/{segment}/{query}', array(
    'uses' => 'ReportingController@typeahead',
));


/*
|------------------------------------------------------------------
| Users
|------------------------------------------------------------------
*/
Route::resource('users', 'UserController');
Route::put('users/update/password/{id}', array(
    'as' => 'users.password',
    'middleware' => 'csrf',
    'uses' => 'PasswordController@updatePassword'
));
Route::put('users/update/role/{id}/{role}', array(
    'as' => 'users.role',
    'uses' => 'UserController@updateRole'
));
Route::get('users/{id}/add/password', array(
    'as' => 'users.addpassword',
    'uses' => 'PasswordController@addPasswordForm'
));
Route::put('users/{id}/add/password', array(
    'as' => 'users.addPassword',
    'before' => 'csrf',
    'uses' => 'PasswordController@addPassword'
));
Route::get('users/{id}/reset/password', array(
    'as' => 'users.resetpassword',
    'uses' => 'UserController@resetPassword'
));

/*
|------------------------------------------------------------------
| Statements
|------------------------------------------------------------------
*/
Route::get('lrs/{id}/statements/generator', 'StatementController@create');
Route::get('lrs/{id}/statements/explorer/{extra?}', 'ExplorerController@explore')
    ->where(array('extra' => '.*'));
Route::get('lrs/{id}/statements/{extra}', 'ExplorerController@filter')
    ->where(array('extra' => '.*'));

Route::resource('statements', 'StatementController');

//temp for people running the dev version pre v1.0 to migrate statements
//can only be run by super admins.
Route::get('migrate', array(
    'as' => 'users.addpassword',
    'middleware' => 'auth.super',
    'uses' => 'MigrateController@runMigration'
));
Route::post('migrate/{id}', array(
    'middleware' => 'auth.super',
    'uses' => 'MigrateController@convertStatements'
));

/*
|------------------------------------------------------------------
| Information pages e.g. terms, privacy
|------------------------------------------------------------------
*/

Route::get('terms', function () {
    return View::make('partials.pages.terms');
});
//tools
Route::get('tools', array(function () {
    return View::make('partials.pages.tools', array('tools' => true));
}));
Route::get('help', array(function () {
    return View::make('partials.pages.help', array('help' => true));
}));
Route::get('about', array(function () {
    return View::make('partials.pages.about');
}));

/*
|------------------------------------------------------------------
| Statement API
|------------------------------------------------------------------
*/

Route::get('data/xAPI/about', function () {
    return Response::json([
        'X-Experience-API-Version' => Config::get('xapi.using_version'),
        'version' => [\Config::get('xapi.using_version')]
    ]);
});

Route::group(array('prefix' => 'data/xAPI', 'middleware' => 'auth.statement'), function () {

    Config::set('xapi.using_version', '1.0.1');

    // Statement API.
    Route::get('statements/grouped', array(
        'uses' => 'xAPI\StatementController@grouped',
    ));
    Route::any('statements', [
        'uses' => 'xAPI\StatementController@selectMethod',
        'as' => 'xapi.statement'
    ]);

    // Agent API.
    Route::any('agents/profile', [
        'uses' => 'xAPI\AgentController@selectMethod'
    ]);
    Route::get('agents', [
        'uses' => 'xAPI\AgentController@search'
    ]);

    // Activiy API.
    Route::any('activities/profile', [
        'uses' => 'xAPI\ActivityController@selectMethod'
    ]);
    Route::get('activities', [
        'uses' => 'xAPI\ActivityController@full'
    ]);

    // State API.
    Route::any('activities/state', [
        'uses' => 'xAPI\StateController@selectMethod'
    ]);

    //Basic Request API
    Route::post('Basic/request', array(
        'uses' => 'xAPI\BasicRequestController@store',
    ));

});

Route::group(['prefix' => 'api/v2', 'middleware' => 'auth.statement'], function () {
    Route::get('statements/insert', ['uses' => 'API\Statements@insert']);
    Route::get('statements/void', ['uses' => 'API\Statements@void']);
});

/*
|------------------------------------------------------------------
| Learning Locker RESTful API
|------------------------------------------------------------------
*/

Route::group(array('prefix' => 'api/v1', 'middleware' => 'auth.statement'), function () {

    Config::set('api.using_version', 'v1');

    Route::get('/', function () {
        return Response::json(array('version' => Config::get('api.using_version')));
    });
    Route::get('query/analytics', array(
        'uses' => 'API\Analytics@index'
    ));
    Route::get('query/statements', array(
        'uses' => 'API\Statements@index'
    ));

    Route::resource('exports', 'API\Exports');

    Route::get('exports/{id}/show', array(
        'uses' => 'API\Exports@showJson'
    ));

    Route::get('exports/{id}/show/csv', array(
        'uses' => 'API\Exports@showCsv'
    ));

    // Adds routes for reports.
    Route::resource('reports', 'API\Reports');
    Route::get('reports/{id}/run', array(
        'uses' => 'API\Reports@run'
    ));
    Route::get('reports/{id}/graph', array(
        'uses' => 'API\Reports@graph'
    ));

    // Adds routes for statements.
    Route::get('statements/where', [
        'uses' => 'API\Statements@where'
    ]);
    Route::get('statements/aggregate', [
        'uses' => 'API\Statements@aggregate'
    ]);
    Route::get('statements/aggregate/time', [
        'uses' => 'API\Statements@aggregateTime'
    ]);
    Route::get('statements/aggregate/object', [
        'uses' => 'API\Statements@aggregateObject'
    ]);

});

/*
|----------------------------------------------------------------------
| oAuth handling
|----------------------------------------------------------------------
*/
Route::post('oauth/access_token', 'Controllers\API\OauthApiController@getAccessToken');

//Add OPTIONS routes for all defined xAPI and api routes
foreach (Route::getRoutes()->getIterator() as $route) {
    if ($route->getPrefix() === 'data/xAPI' || $route->getPrefix() === 'api/v1') {
        Route::options($route->getUri(), 'Controllers\API\Base@CORSOptions');
    }
}