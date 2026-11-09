<?php
// LISTADO DE ANUNCIOS
$anuncios = [
    1 => [
        'id' => 1,
        'tipo_anuncio' => 'Venta',
        'tipo_vivienda' => 'Piso',
        'foto_principal' => 'img/pisoSanvi.jpg',
        'alt_foto_principal' => 'Piso en San Vicente del Raspeig',
        'titulo' => 'Piso en San Vicente',
        'precio' => '80.000 €',
        'texto' => 'Piso con buenas vistas a San Vicente, con buena iluminación natural y el supermercado cerca.',
        'fecha' => '20/12/2025',
        'ciudad' => 'Alicante',
        'pais' => 'España',
        'caracteristicas' => [
            'superficie' => '90 m²',
            'habitaciones' => '3 habitaciones',
            'banos' => '2 baños',
            'planta' => '2ª planta con ascensor',
            'ano_construccion' => '2005'
        ],
        'fotos' => [
            [
                'src' => 'img/salon.jpg',
                'alt' => 'Salón luminoso con acceso al balcón'
            ],
            [
                'src' => 'img/foto1.jpg',
                'alt' => 'Dormitorio principal amueblado'
            ]
        ],
        'usuario' => 'carlos'
    ],
    2 => [
        'id' => 2,
        'tipo_anuncio' => 'Alquiler',
        'tipo_vivienda' => 'Apartamento',
        'foto_principal' => 'img/pisoAlcorcon.webp',
        'alt_foto_principal' => 'Apartamento moderno en Alcorcón',
        'titulo' => 'Apartamento en Alcorcón',
        'precio' => '750 € al mes',
        'texto' => 'Acogedor apartamento recién reformado, totalmente amueblado y equipado, cerca de transporte público.',
        'fecha' => '15/01/2026',
        'ciudad' => 'Alcorcón',
        'pais' => 'España',
        'caracteristicas' => [
            'superficie' => '65 m²',
            'habitaciones' => '2 habitaciones',
            'banos' => '1 baño',
            'planta' => '4ª planta',
            'ano_construccion' => '2012'
        ],
        'fotos' => [
            [
                'src' => 'img/foto2.jpg',
                'alt' => 'Cocina americana equipada'
            ],
            [
                'src' => 'img/foto5.jpg',
                'alt' => 'Habitación luminosa'
            ]
        ],
        'usuario' => 'aitor'
    ]
];

