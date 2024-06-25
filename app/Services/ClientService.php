<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{

  public function createClient(array $data): Client
  {
    $client = Client::create($data);

    if (array_key_exists('photo', $data) && $data['photo']->isValid()) {
        $this->handlePhotoUpload($client, $data['photo']);
    }

    return $client;
  }

  public function updateClient($data, $id)
  {
    $client = Client::findOrFail($id);
    $client->update($data);

    if (array_key_exists('photo', $data) && $data['photo']->isValid()) {
      $this->handlePhotoUpload($client, $data['photo']);
    }

    return $client;
  }

  public function destroyClient($id)
  {
    $client = Client::findOrFail($id);
    $client->delete();
  }

  public function bulkDeleteClients($ids)
  {
    Client::destroy($ids);
  }

  protected function handlePhotoUpload(Client $client, $photo): void
  {
      $clientId = $client->id;
      $filename = uniqid() . '.' . $photo->getClientOriginalExtension();
      $directory = public_path('storage/images/clients/' . $clientId);

      if (!file_exists($directory)) {
          mkdir($directory, 0777, true);
      }

      $photo->move($directory, $filename);
      $photoPath = 'storage/images/clients/' . $clientId . '/' . $filename;

      $client->photo = $photoPath;
      $client->save();
  }


  public function fetchAllClients($page)
  {
    $perPage = 10;
    $clients = Client::orderBy('created_at', 'DESC')->paginate($perPage, ['*'], 'page', $page);

    return [
      
      'clients' => $clients,
      'links' => $clients->links(),
      'count' => Client::all()->count(),
      'meta' => [
        'currentPage' => $clients->currentPage(),
        'lastPage' => $clients->lastPage(),
        'totalItems' => $clients->total(),
        'perPage' => $clients->perPage(),
      ],
    ];
  }

  public function searchClients($keywords)
  {
    return Client::where('name', 'like', '%' . $keywords . '%')->get();
  }

  public function findClientBySlug($slug)
  {
    return Client::where('slug', $slug)->with(['pets.species', 'pets.breed'])->firstOrFail();
  }
}