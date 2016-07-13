<?php
namespace App\Repositories;


use League\Flysystem\Filesystem;
use Dropbox\Client;
use League\Flysystem\Dropbox\DropboxAdapter;

class DropboxStorageRepository{ //class create connection with dropbox

    protected $client;
    protected $adapter;
    public function __construct()
    {
        $this->client = new Client('kQvxk2zc3yAAAAAAAAAAGBVzy0-a8Qs3i5x0C6lwzlOnBcjgs9STYDD3SStlmFEt', 'mybogtestd', null);
        $this->adapter = new DropboxAdapter($this->client);
    }
    public function getConnection()
    {
        return new Filesystem($this->adapter);
    }
}