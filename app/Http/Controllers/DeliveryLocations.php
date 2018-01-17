<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;

class DeliveryLocations extends Controller
{
  public function cmsIndex()
  {
    $locations = App\DeliveryLocation::latest('updated_at')->get();
    return view('cms.locations', compact('locations'));
  }

  public function store(Requests\AddLocation $request)
  {
    $location = App\DeliveryLocation::create($request->all());
    return $this->locationsTable();
  }

  public function update(Requests\UpdateLocation $request, $id)
  {
    App\DeliveryLocation::where(compact('id'))->update($request->all());
    return $this->locationsTable();
  }

  public function destroy(App\DeliveryLocation $location)
  {
    $location->delete();
    return $this->locationsTable();
  }

  private function locationsTable()
  {
    $locations = App\DeliveryLocation::latest('updated_at')->get();
    return view('cms.tables.locations_table', compact('locations'));
  }

}
