<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;


class Blog extends Model
{
    use HasFactory,LaravelVueDatatableTrait;
    protected $fillable = [
        'title', 
        'url', 
        'category',
        'description'
    ];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'title' => [
            'searchable' => true,
        ],
        'category' => [
            'searchable' => true,
        ],
        'description' => [
            'searchable' => true,
        ]
    ];

    protected $dataTableRelationships = [
        //
    ];
}