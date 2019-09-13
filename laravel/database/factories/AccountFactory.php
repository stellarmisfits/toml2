<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Account::class, function (Faker $faker) {
    $public_keys = [
        'GDCAX4O3INFGU2ETBZVE2UMDBGOA4IL5L2YT2RLFVGOTHW6KOZXDZUP2',
        'GDXAYL2P3V5MC43VIDSWNZOHJ4EZOJIGVQFD7A33GLSRZPYEY76AEH2B',
        'GBBK5B4WC6GWZZFWF6P5P6OK6R2RJ6GKCQI3YKNKQ23OX5ZRXQGXOIJN',
        'GCMQY76JGIKSZQRZ6JHEJESXOYPYEWFA6YBCDFCG64VB547PO7JBIGSE',
        'GAARLUHSYQRUIPGYZQEAF77XKXVMB4IQP2XHTJATOWTB4DGJVYG2VDR6',
        'GBYTKWXZBJX2LVY26HRJS6LVSY55OII7QKBO7GRSU4NE7CPTCSV5SLMQ',
        'GBFZIGZGS7YROWFAOSVWBJGQAUQOUPLXMOEJIVIMLDOW2GVQG3Z4APZB',
        'GAOYQH6RLJSZV7QVQHLVDTZE5SHT6547RIEAWP2VMBAW5TGQGGURZ4EF',
        'GBJPFYO5MAJDXIRQT62GW5R7Z7BCBFHZKNHIEKOUOZIX5KKXQXCJH6JF',
        'GAMJWIW54MQQKGOZBP7F5VNTSWL7IJXICKRB6UKSGIWXNILY4NWRXX74',
        'GAKQZ6PVCN2JRC2IFO67YB5DFUHLOUCQNFHR7AYATKEC6QRS7HUBDXEM',
        'GDUM27CE2WDSNVSCSJ7OFCIZ5HYUW27XIMI7CGCWA22FSOAERDO4UDA6',
        'GC4RWFQ7NYBE5DJXRNNTIJLDF5OICWIYLCPSHKM6QF7GO4Z2HB4P36OC',
        'GDK5XXQEVNVFOORK3J5P5NG5QGM433XYL2UZ3BZVKZIDBYNM5XUPVKGO',
        'GAYWVJ2P4JGBFWMEAOP2XZ45VYJXXXEGQCCQV6SX7IUUA7PU5CKDPLKC',
        'GCVVXAG2SDVWS2SJWEI2FFBT6GZF6RFUWVVGN776VEBB7DRRNW6A2V7D',
        'GBOK426KPA4ZZD3JQFZ74JO2IA2BIHRVI2IDJH3SRNZA5LVPOXFLMS37',
        'GA3NGTQ7FL6WZ5Z3BAJQWNUJ3PPC3AVQOWSOE474FJ4YPVSQDEV6CN3L'
    ];

    return [
        'alias' => substr(str_slug(str_random(15)), 0, 15),
        'public_key' => $faker->unique()->randomElement($public_keys),
        'verified' => false
    ];
});
