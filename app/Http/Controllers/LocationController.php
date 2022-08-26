<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use App\Models\Location;
use App\Models\User;

class LocationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $location = Location::where("user_id", $user->id)->first();

        return view('locations.index', compact('location', 'user'));
    }

    public function store(Request $request)
    {
        $ip = @unserialize(file_get_contents('http://ip-api.com/php'));
        $user = auth()->user();

        $newLocation = [
            'query' => $ip['query'],
            'status' => $ip['status'],
            'country' => $ip['country'],
            'regionName' => $ip['regionName'],
            'city' => $ip['city'],
            'lat' => $ip['lat'],
            'lon' => $ip['lon'],
            'timezone' => $ip['timezone'],
            'zip' => $ip['zip'],
            'user_id' => $user->id
        ];

        $repeated = Location::where("user_id", $user->id)->first();

        if(empty($repeated)) {
            if (Location::create($newLocation)) {
                $request->session()->flash('msg', 'Gravação feita com sucesso!');
            }
            return redirect()->route('locations.index');
        } else {
            return redirect()->route('locations.update');
        }
    }

    public function update($id)
    {
        $ip = @unserialize(file_get_contents('http://ip-api.com/php'));

        if (!$location = Location::where('user_id', $id)->first()) {
            return redirect()->route('locations.index');
        }

        $newLocation = [
            'query' => $ip['query'],
            'status' => $ip['status'],
            'country' => $ip['country'],
            'regionName' => $ip['regionName'],
            'city' => $ip['city'],
            'lat' => $ip['lat'],
            'lon' => $ip['lon'],
            'timezone' => $ip['timezone'],
            'zip' => $ip['zip'],
            'user_id' => $id
        ];

        $location->update($newLocation);

        return redirect()->route('locations.index')->with('msg', 'Atualização concluída com sucesso!');
    }
}
