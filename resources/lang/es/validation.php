<?php

return [
    'custom' => [
        'title' => [
            'required' => 'El campo título es obligatorio.',
            'unique' => 'Ya existe una tarea con este título.',
        ],
        'email' => [
            'required' => 'El campo emial es obligatorio.',
            'unique' => 'Ya existe una cuenta con este email.',
        ],
    ],
];
