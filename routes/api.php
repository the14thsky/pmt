<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('license', function(){
//     $response =[
//         "ok"=> true,
//         "errorCode"=> 0,
//         "validUntil"=> "2080-07-11T15:53:29.274Z",
//         "registeredDomains"=> [
//         "localhost",
//         "localhost:8000"
//         ],
//         "internalLicenseId"=> "1620966867337-b808c9a2c92311f4-mqjl-0050",
//         "origin"=> "ptrack.koollab.com",
//         "token"=> "38a4142359cdb2a45302b60dc5233f66adf748344bd273c4f94d2766e9bf882ebab699790eb41694f70706cfaa4d81f62ffbf8c222f457ed329d6e1716c01d9d",
//         "licenseKey"=> "====BEGIN LICENSE KEY====\nkmlx46DXRuPxTvFNK7MHv+noYu6cUJ8iWWaD2BfZO+o9+Afhr7A7Ova8cVu7A5PvDGylfsoORLh08OcGH+Z1S0pQGArdclHTTvLH6B5lgYbsu+KBQpfVuNwxTpAYUYerQoLfTidcqHY7eXTzfXePdVsCHYBlUGu8rpGw+fId0GdnnMqK9pQfn9nt8o83Hlwe1OPiIXcrYXActpJvV+ji6qunU9H/gWVGyCgp6xy+eVu8lSyb9c6RRvoJVi4ceuX6Bxe8QwNyKvPDcZCjhVLq4/gwkqbAfaYCt12bML6zo+pbHI39HjmZ5VnW37TvRCk3xS+DELA3nxnpKQmuw4nQEQ==||U2FsdGVkX1+/DIZ36Q7q/52irgJrpzCWbMzUnmyA4/JXOALygQQ4Zj6fzltOC1XSaPeYalBrZJ/QOlXFi2bUx2Ff4HXC96aC8SClntbu/N8=\nodWhiqTWF7ImSaLX95o3HGx9daoeTaJkSyuLAZlt4w0akNMhNw1z1OIf+Nb1oQl/z1mOpElZ/pp0m1iCZ8BJPMdpqFp/IZDfFyRo5MkJzwSTLsf3vR7LfCxHMl+EmUAmBwOG+vYK4V4ixbk4GOWlGK2c2e4+TM6k91SsT8/HDKjjJCJzt+dpKyGHNhXDOl/sih8queq3qdYj0NfLs0hefHzoiZOF0sdWNqhZi8UQtl98ok8ODL5IyMMdYyVNXz8xJM8psevrvMb6I8udMxXGm5ngu2KnxyWix9Kte3xLZ3g9U/eutn2B4stZKZQPTLeTVkLW9mtnb6wVezBN6pv+wg==\n====END LICENSE KEY====",
//         "inputLicenseKey"=> "====BEGIN LICENSE KEY====\nkmlx46DXRuPxTvFNK7MHv+noYu6cUJ8iWWaD2BfZO+o9+Afhr7A7Ova8cVu7A5PvDGylfsoORLh08OcGH+Z1S0pQGArdclHTTvLH6B5lgYbsu+KBQpfVuNwxTpAYUYerQoLfTidcqHY7eXTzfXePdVsCHYBlUGu8rpGw+fId0GdnnMqK9pQfn9nt8o83Hlwe1OPiIXcrYXActpJvV+ji6qunU9H/gWVGyCgp6xy+eVu8lSyb9c6RRvoJVi4ceuX6Bxe8QwNyKvPDcZCjhVLq4/gwkqbAfaYCt12bML6zo+pbHI39HjmZ5VnW37TvRCk3xS+DELA3nxnpKQmuw4nQEQ==||U2FsdGVkX1+/DIZ36Q7q/52irgJrpzCWbMzUnmyA4/JXOALygQQ4Zj6fzltOC1XSaPeYalBrZJ/QOlXFi2bUx2Ff4HXC96aC8SClntbu/N8=\nodWhiqTWF7ImSaLX95o3HGx9daoeTaJkSyuLAZlt4w0akNMhNw1z1OIf+Nb1oQl/z1mOpElZ/pp0m1iCZ8BJPMdpqFp/IZDfFyRo5MkJzwSTLsf3vR7LfCxHMl+EmUAmBwOG+vYK4V4ixbk4GOWlGK2c2e4+TM6k91SsT8/HDKjjJCJzt+dpKyGHNhXDOl/sih8queq3qdYj0NfLs0hefHzoiZOF0sdWNqhZi8UQtl98ok8ODL5IyMMdYyVNXz8xJM8psevrvMb6I8udMxXGm5ngu2KnxyWix9Kte3xLZ3g9U/eutn2B4stZKZQPTLeTVkLW9mtnb6wVezBN6pv+wg==\n====END LICENSE KEY====",
//         "gstcVersion"=> "3.6.6",
//         "ip"=> "47.9.114.27"];
//     return response()->json($response);
// });


Route::prefix('administration')->group(function () {

    Route::get('deliverableTemplates/{id}', 'Administration\DeliverableTemplateApiController@show');
    Route::post('holidayscount', 'Administration\HolidayAPIController@countHolidays');
});



Route::group(['middleware' => ['auth:sanctum']], function () {



    Route::group(['prefix' => 'sales/projects'], function () {
        Route::get('deliverables/{projectId}', 'Sales\DeliverableAPIController@getDeliverables');
        Route::get('deliverablesByTitle/{projectId}/{title}', 'Sales\DeliverableAPIController@getDeliverablesByTitle');
        Route::post('timeChargingByUser', 'Sales\DeliverableAPIController@getTimeChargeByUser');
        Route::post('deliverables/update/{id}', 'Sales\DeliverableAPIController@updateDeliverable');
        Route::post('timeCharge/update', 'Sales\DeliverableAPIController@updateTimeCharge');
    });




});




