<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ourStoresController extends Controller
{
    public function index()
    {
        $stores = [
            [
                'number'    => 1,
                'name'      => 'ALMACÉN COROZAL',
                'addres'    => 'CR 26 No. 32-55 BRR San Juan Centro',
                'city'      => 'COROZAL - SUCRE',
                'telephone' => '(5) 2841374'
            ],
            [
                'number'    => 4,
                'name'      => 'ALMACÉN SINCELEJO',
                'addres'    => 'CL 21 No.21-82',
                'city'      => 'SINCELEJO - SUCRE',
                'telephone' => '(5)2821181'
            ],
            [
                'number'    => 5,
                'name'      => 'ALMACÉN GRANADA',
                'addres'    => 'CR 13 No.22-30',
                'city'      => 'GRANADA - META',
                'telephone' => '(8)6582415'
            ],
            [
                'number'    => 7,
                'name'      => 'ALMACÉN VILLAVICENCIO',
                'addres'    => 'CR 29 No. 37-16/18',
                'city'      => 'VILLAVICENCIO - META',
                'telephone' => '(8)6627721-(8) 6627337-(8)6623952'
            ],
            [
                'number'    => 8,
                'name'      => 'ALMACÉN PUERTO BOYACA',
                'addres'    => 'CR 2 con CL 13 ESQ No. 12-79 CENTRO',
                'city'      => 'PUERTO BOYACA - BOYACA',
                'telephone' => '(8)7381543-(8)7384532'
            ],
            [
                'number'    => 9,
                'name'      => 'ALMACÉN PUERTO LOPEZ',
                'addres'    => 'CL 5 No. 7-17',
                'city'      => 'PUERTO LOPEZ - META',
                'telephone' => '(8)6452085'
            ],
            [
                'number'    => 10,
                'name'      => 'ALMACÉN CHINCHINÁ',
                'addres'    => 'CR 8 No. 8-19',
                'city'      => 'CHINCHINÁ - CALDAS',
                'telephone' => '(6)8503315'
            ],
            [
                'number'    => 11,
                'name'      => 'ALMACÉN AGUACHICA',
                'addres'    => 'CL 5 No. 22-33',
                'city'      => 'AGUACHICA - CESAR',
                'telephone' => '(5)5652549'
            ],
            [
                'number'    => 12,
                'name'      => 'ALMACÉN BARRANCABERMEJA',
                'addres'    => 'CL 49 No. 11ª-47 Edificio Los Balcones (Sector Comercial)',
                'city'      => 'BARRANCABERMEJA - SANTANDER',
                'telephone' => '(7)6115188'
            ],
            [
                'number'    => 13,
                'name'      => 'ALMACÉN TULUÁ',
                'addres'    => 'CL 25 No. 22-60',
                'city'      => 'TULUÁ - VALLE DEL CAUCA',
                'telephone' => '(2) 2245051-(2)2246998'
            ],
            [
                'number'    => 14,
                'name'      => 'ALMACÉN PEREIRA',
                'addres'    => 'CR 8 No. 20-51',
                'city'      => 'PEREIRA - RISARALDA',
                'telephone' => '(6)3350470–(6)3344985'
            ],
            [
                'number'    => 15,
                'name'      => 'ALMACÉN PEREIRA II',
                'addres'    => 'CR 8 No. 21-18',
                'city'      => 'PEREIRA - RISARALDA',
                'telephone' => '(6)3355949-(6)3343296'
            ],
            [
                'number'    => 16,
                'name'      => 'ALMACÉN LA VIRGINIA',
                'addres'    => 'LC Comercial CR. 7 No. 8-28',
                'city'      => 'LA VIRGINIA - RISARALDA',
                'telephone' => '(6)3677868-(6)3680131'
            ],
            [
                'number'    => 17,
                'name'      => 'ALMACÉN SANTA ROSA',
                'addres'    => 'CR 14 No. 15 – 63',
                'city'      => 'SANTA ROSA - RISARALDA',
                'telephone' => '(6)3642875'
            ],
            [
                'number'    => 18,
                'name'      => 'ALMACÉN ARMENIA',
                'addres'    => 'CR 17 No. 19-48',
                'city'      => 'ARMENIA - QUINDIO',
                'telephone' => '(6)7444522'
            ],
            [
                'number'    => 19,
                'name'      => 'ALMACÉN GIRARDOT',
                'addres'    => 'CL 16 No. 10 – 41 BRR CEN',
                'city'      => 'GIRARDOT - CUNDINAMARCA',
                'telephone' => '(1)8889933'
            ],
            [
                'number'    => 20,
                'name'      => 'ALMACÉN MANIZALES',
                'addres'    => 'CR. 22 No. 23-51',
                'city'      => 'MANIZALES - CALDAS',
                'telephone' => '(6)8847374-(6)8847176-(6)8847407'
            ],
            [
                'number'    => 21,
                'name'      => 'ALMACÉN LA DORADA',
                'addres'    => 'CR. 2 No. 14 – 35/37',
                'city'      => 'LA DORADA - CALDAS',
                'telephone' => '(6) 8391341'
            ],
            [
                'number'    => 22,
                'name'      => 'ALMACÉN MAGANGUÉ',
                'addres'    => 'Sector Centro CL 11 No.3-11Calle del Colegio Piso 1',
                'city'      => 'MAGANGUÉ - BOLIVAR',
                'telephone' => '(5)6875343'
            ],
            [
                'number'    => 23,
                'name'      => 'ALMACÉN VILLANUEVA',
                'addres'    => 'CL 11 No. 10-03',
                'city'      => 'VILLANUEVA - CASANARE',
                'telephone' => '(8)6243060'
            ],
            [
                'number'    => 24,
                'name'      => 'ALMACÉN IBAGUÉ',
                'addres'    => 'CR. 2 No. 15-42',
                'city'      => 'IBAGUÉ - TOLIMA',
                'telephone' => '(8)2618937-(8)2636013'
            ],
            [
                'number'    => 25,
                'name'      => 'ALMACÉN SINCELEJO',
                'addres'    => 'CL 22 No.18 - 04 LCl 103 CEN',
                'city'      => 'SINCELEJO - SUCRE',
                'telephone' => '(5)2809103-(5)2820989'
            ],
            [
                'number'    => 26,
                'name'      => 'ALMACÉN MONTERÍA',
                'addres'    => 'CL 30 No. 2-28',
                'city'      => 'MONTERÍA - CÓRDOBA',
                'telephone' => '(4) 7822769(4)7822536(4)7824131'
            ],
            [
                'number'    => 27,
                'name'      => 'ALMACÉN ACACIAS',
                'addres'    => 'CR 18 No. 13-35 BRR CEN',
                'city'      => 'ACACIAS - META',
                'telephone' => '(8)6567803'
            ],
            [
                'number'    => 28,
                'name'      => 'ALMACÉN PITALITO',
                'addres'    => 'CL 7 No. 5- 41 Primer piso',
                'city'      => 'PITALITO - HUILA',
                'telephone' => '(8) 8351380'
            ],
            [
                'number'    => 29,
                'name'      => 'ALMACÉN CERETÉ',
                'addres'    => 'CR15 No. 9A-30 LC 6 AV. Santader',
                'city'      => 'CERETÉ - CORDOBA',
                'telephone' => '(4)7745401'
            ],
            [
                'number'    => 30,
                'name'      => 'ALMACÉN GARZON',
                'addres'    => 'CR 11 No. 8-36 LC Comercial',
                'city'      => 'GARZON - HUILA',
                'telephone' => '(8) 8331314'
            ],
            [
                'number'    => 31,
                'name'      => 'ALMACÉN ARMENIA',
                'addres'    => 'CR 18 No. 20-00',
                'city'      => 'ARMENIA - QUINDIO',
                'telephone' => '(6)7442320'
            ],
            [
                'number'    => 32,
                'name'      => 'ALMACCEN SAHAGUN',
                'addres'    => 'CL 14 No. 8-58',
                'city'      => 'SAHAGUN - CÓRDOBA',
                'telephone' => '(4) 7776990'
            ],
            [
                'number'    => 33,
                'name'      => 'ALMACÉN LORICA',
                'addres'    => 'CL 4 A No.23-19',
                'city'      => 'LORICA - CORDOBA',
                'telephone' => '(4) 7735718'
            ],
            [
                'number'    => 34,
                'name'      => 'ALMACÉN YOPAL',
                'addres'    => 'CR 21 No. 8-31',
                'city'      => 'SAN BORJA - LIMA',
                'telephone' => '(8)6354497-(8)6354978'
            ],
            [
                'number'    => 35,
                'name'      => 'ALMACÉN AGUAZUL',
                'addres'    => 'CL 10 No.15-49',
                'city'      => 'AGUAZUL - CASANARE',
                'telephone' => '(8) 6383431-(8)6387096'
            ],
            [
                'number'    => 36,
                'name'      => 'ALMACÉN ESPINAL',
                'addres'    => 'CR 4 No. 8-25',
                'city'      => 'ESPINAL - TOLIMA',
                'telephone' => '(8)2484459-(8)2484550'
            ],
            [
                'number'    => 37,
                'name'      => 'ALMACÉN MARIQUITA',
                'addres'    => 'CR 4 No. 7-28/30',
                'city'      => 'MARIQUITA - TOLIMA',
                'telephone' => '(8)2522919-(8)2524912'
            ]
        ];

        return view('menuItems.ourStores', [
            'stores' => $stores
        ]);
    }

    public function create()
    { }

    public function store(Request $request)
    { }

    public function show($id)
    { }

    public function edit($id)
    { }

    public function update(Request $request, $id)
    { }

    public function destroy($id)
    { }
}
