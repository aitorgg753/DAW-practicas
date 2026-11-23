<?php
// LISTADO DE ANUNCIOS
$anuncios = [
    1 => [
        'id' => 1,
        'tipo_anuncio' => 'Venta',
        'tipo_vivienda' => 'Piso',
        'foto_principal' => 'img/foto1.jpg',
        'alt_foto_principal' => 'Piso en Alicante',
        'titulo' => 'Piso en Alicante',
        'precio' => '225000 €',
        'texto' => 'Amplio piso en Alicante con buena iluminación natural, terraza y todos los servicios cercanos.',
        'fecha' => '20/09/2025',
        'ciudad' => 'Alicante',
        'pais' => 'España',
        'caracteristicas' => [
            'superficie' => '95 m²',
            'habitaciones' => '3 habitaciones',
            'banos' => '2 baños',
            'planta' => '3ª planta con ascensor',
            'ano_construccion' => '2008'
        ],
        'fotos' => [
            [
                'src' => 'img/salon.jpg',
                'alt' => 'Salón luminoso del piso en Alicante'
            ],
            [
                'src' => 'img/pisoSanvi.jpg',
                'alt' => 'Vista exterior del edificio'
            ]
        ],
        'usuario' => 'carlos'
    ],
    2 => [
        'id' => 2,
        'tipo_anuncio' => 'Alquiler',
        'tipo_vivienda' => 'Apartamento',
        'foto_principal' => 'img/foto2.jpg',
        'alt_foto_principal' => 'Apartamento en Valladolid',
        'titulo' => 'Apartamento en Valladolid',
        'precio' => '600 € al mes',
        'texto' => 'Acogedor apartamento en Valladolid totalmente amueblado y equipado, cercano a transporte público.',
        'fecha' => '16/07/2026',
        'ciudad' => 'Valladolid',
        'pais' => 'España',
        'caracteristicas' => [
            'superficie' => '60 m²',
            'habitaciones' => '2 habitaciones',
            'banos' => '1 baño',
            'planta' => '2ª planta',
            'ano_construccion' => '2011'
        ],
        'fotos' => [
            [
                'src' => 'img/salon.jpg',
                'alt' => 'Zona de estar amueblada'
            ],
            [
                'src' => 'img/foto1.jpg',
                'alt' => 'Dormitorio principal'
            ]
        ],
        'usuario' => 'aitor'
    ],
    3 => [
        'id' => 3,
        'tipo_anuncio' => 'Alquiler',
        'tipo_vivienda' => 'Piso',
        'foto_principal' => 'img/foto3.jpg',
        'alt_foto_principal' => 'Pisito en Madrid centro',
        'titulo' => 'Pisito en Madrid centro',
        'precio' => '2000 € al mes',
        'texto' => 'Piso reformado en pleno centro de Madrid, con balcón exterior, aire acondicionado y excelente conexión de metro.',
        'fecha' => '19/06/2025',
        'ciudad' => 'Madrid',
        'pais' => 'España',
        'caracteristicas' => [
            'superficie' => '75 m²',
            'habitaciones' => '2 habitaciones',
            'banos' => '2 baños',
            'planta' => '4ª planta con ascensor',
            'ano_construccion' => '2016'
        ],
        'fotos' => [
            [
                'src' => 'img/salon.jpg',
                'alt' => 'Salón moderno en el centro de Madrid'
            ],
            [
                'src' => 'img/foto4.jpg',
                'alt' => 'Cocina equipada'
            ]
        ],
        'usuario' => 'carlos'
    ],
    4 => [
        'id' => 4,
        'tipo_anuncio' => 'Venta',
        'tipo_vivienda' => 'Piso',
        'foto_principal' => 'img/foto4.jpg',
        'alt_foto_principal' => 'Piso en Albacete',
        'titulo' => 'Piso en Albacete',
        'precio' => '234300 €',
        'texto' => 'Piso familiar en zona tranquila de Albacete, con plaza de garaje incluida, trastero y zonas verdes.',
        'fecha' => '12/10/2023',
        'ciudad' => 'Albacete',
        'pais' => 'España',
        'caracteristicas' => [
            'superficie' => '110 m²',
            'habitaciones' => '4 habitaciones',
            'banos' => '2 baños',
            'planta' => '1ª planta con ascensor',
            'ano_construccion' => '2014'
        ],
        'fotos' => [
            [
                'src' => 'img/salon.jpg',
                'alt' => 'Salón comedor amplio'
            ],
            [
                'src' => 'img/foto3.jpg',
                'alt' => 'Habitación principal'
            ]
        ],
        'usuario' => 'aitor'
    ],
    5 => [
        'id' => 5,
        'tipo_anuncio' => 'Venta',
        'tipo_vivienda' => 'Apartamento',
        'foto_principal' => 'img/foto5.jpg',
        'alt_foto_principal' => 'Apartamento en Alcorcón',
        'titulo' => 'Apartamento en Alcorcón',
        'precio' => '310000 €',
        'texto' => 'Apartamento recién reformado en Alcorcón con acabados de calidad, piscina comunitaria y cerca de cercanías.',
        'fecha' => '27/03/2024',
        'ciudad' => 'Alcorcón',
        'pais' => 'España',
        'caracteristicas' => [
            'superficie' => '85 m²',
            'habitaciones' => '2 habitaciones',
            'banos' => '2 baños',
            'planta' => '5ª planta con ascensor',
            'ano_construccion' => '2018'
        ],
        'fotos' => [
            [
                'src' => 'img/pisoAlcorcon.webp',
                'alt' => 'Interior del apartamento en Alcorcón'
            ],
            [
                'src' => 'img/salon.jpg',
                'alt' => 'Salón luminoso'
            ]
        ],
        'usuario' => 'carlos'
    ],
    6 => [
        'id' => 6,
        'tipo_anuncio' => 'Venta',
        'tipo_vivienda' => 'Apartamento',
        'foto_principal' => 'img/foto6.jpg',
        'alt_foto_principal' => 'Apartamento en La Vega Baja',
        'titulo' => 'Apartamento en La Vega Baja',
        'precio' => '220000 €',
        'texto' => 'Luminoso apartamento en La Vega Baja con amplia terraza soleada, ideal para disfrutar todo el año.',
        'fecha' => '27/03/2023',
        'ciudad' => 'La Vega Baja',
        'pais' => 'España',
        'caracteristicas' => [
            'superficie' => '80 m²',
            'habitaciones' => '2 habitaciones',
            'banos' => '1 baño',
            'planta' => 'Bajo con terraza',
            'ano_construccion' => '2015'
        ],
        'fotos' => [
            [
                'src' => 'img/bungalowAlicante.jpg',
                'alt' => 'Terraza y exterior soleado'
            ],
            [
                'src' => 'img/salon.jpg',
                'alt' => 'Salón conectado a la terraza'
            ]
        ],
        'usuario' => 'aitor'
    ]
];
