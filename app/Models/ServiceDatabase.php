<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Symfony\Component\Yaml\Yaml;

class ServiceDatabase extends BaseModel
{
    use HasFactory;
    protected $guarded = [];

    public function type()
    {
        return 'service';
    }
    public function documentation()
    {
        return data_get(Yaml::parse($this->service->docker_compose_raw), "services.{$this->name}.documentation", 'https://coolify.io/docs');
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function persistentStorages()
    {
        return $this->morphMany(LocalPersistentVolume::class, 'resource');
    }
}
