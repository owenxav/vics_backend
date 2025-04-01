<?php

namespace App\Helpers\V1;

class States
{
    private const test_states = [
        'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 
        'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 
        'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 
        'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 
        'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 
        'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 
        'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 
        'Zamfara'
    ];

    private const test_north_central = [
        'Benue', 'Kogi', 'Kwara', 'Nasarawa', 'Niger', 'Plateau', 'Federal Capital Territory'
    ];
 
    private const test_north_east = [
        'Adamawa', 'Bauchi', 'Borno', 'Gombe', 'Taraba', 'Yobe'
    ];
 
    private const test_north_west = [
        'Kaduna', 'Katsina', 'Kano', 'Kebbi', 'Sokoto', 'Jigawa', 'Zamfara'
    ];
 
    private const test_south_east = [
        'Abia', 'Anambra', 'Ebonyi', 'Enugu', 'Imo'
    ];
 
    private const test_south_west = [
        'Ondo', 'Osun', 'Oyo', 'Ekiti', 'Lagos', 'Ogun'
    ];
 
    private const test_south_south = [
        'Akwa Ibom', 'Bayelsa', 'Cross River', 'Delta', 'Edo', 'Rivers'
    ];

    public const ABIA = 'Abia';
    public const ADAMAWA = 'Adamawa';
    public const AKWA_IBOM = 'Akwa Ibom';
    public const ANAMBRA = 'Anambra';
    public const BAUCHI = 'Bauchi';
    public const BAYELSA = 'Bayelsa';
    public const BENUE = 'Benue';
    public const BORNO = 'Borno';
    public const CROSS_RIVER = 'Cross River';
    public const DELTA = 'Delta';
    public const EBONYI = 'Ebonyi';
    public const EDO = 'Edo';
    public const EKITI = 'Ekiti';
    public const ENUGU = 'Enugu';
    public const GOMBE = 'Gombe';
    public const IMO = 'Imo';
    public const JIGAWA = 'Jigawa';
    public const KADUNA = 'Kaduna';
    public const KANO = 'Kano';
    public const KATSINA = 'Katsina';
    public const KEBBI = 'Kebbi';
    public const KOGI = 'Kogi';
    public const KWARA = 'Kwara';
    public const LAGOS = 'Lagos';
    public const NASARAWA = 'Nasarawa';
    public const NIGER = 'Niger';
    public const OGUN = 'Ogun';
    public const ONDO = 'Ondo';
    public const OSUN = 'Osun';
    public const OYO = 'Oyo';
    public const PLATEAU = 'Plateau';
    public const RIVERS = 'Rivers';
    public const SOKOTO = 'Sokoto';
    public const TARABA = 'Taraba';
    public const YOBE = 'Yobe';
    public const ZAMFARA = 'Zamfara';
    public const FCT = 'Federal Capital Territory';

    public const NORTH_CENTRAL = [
        self::BENUE, self::KOGI, self::KWARA, self::NASARAWA, self::NIGER, self::PLATEAU, self::FCT
    ];

    public const NORTH_EAST = [
        self::ADAMAWA, self::BAUCHI, self::BORNO, self::GOMBE, self::TARABA, self::YOBE
    ];

    public const NORTH_WEST = [
        self::KADUNA, self::KATSINA, self::KANO, self::KEBBI, self::SOKOTO, self::JIGAWA, self::ZAMFARA
    ];

    public const SOUTH_EAST = [
        self::ABIA, self::ANAMBRA, self::EBONYI, self::ENUGU, self::IMO
    ];

    public const SOUTH_WEST = [
        self::ONDO, self::OSUN, self::OYO, self::EKITI, self::LAGOS, self::OGUN
    ];

    public const SOUTH_SOUTH = [
        self::AKWA_IBOM, self::BAYELSA, self::CROSS_RIVER, self::DELTA, self::EDO, self::RIVERS
    ];
    
    public const STATES = [
        SELF::ABIA,
        SELF::ADAMAWA,
        SELF::AKWA_IBOM,
        SELF::ANAMBRA,
        SELF::BAUCHI,
        SELF::BAYELSA,
        SELF::BENUE,
        SELF::BORNO,
        SELF::CROSS_RIVER,    
        SELF::DELTA,
        SELF::EBONYI,
        SELF::EDO,
        SELF::EKITI,
        SELF::ENUGU,
        SELF::GOMBE,
        SELF::IMO,
        SELF::JIGAWA,
        SELF::KADUNA,
        SELF::KANO,
        SELF::KATSINA,
        SELF::KEBBI,
        SELF::KOGI,
        SELF::KWARA,
        SELF::LAGOS,
        SELF::NASARAWA,
        SELF::NIGER,
        SELF::OGUN,
        SELF::ONDO,
        SELF::OSUN,
        SELF::OYO,
        SELF::PLATEAU,
        SELF::RIVERS,
        SELF::SOKOTO,
        SELF::TARABA,
        SELF::YOBE,
        SELF::ZAMFARA,
        SELF::FCT
    ];

    public const STATE_IDS = [
        "01JNK2BSDEVRZ2JKACWRZ81R52",
        "01JNK2BSDTGKZB5N70YDHSN75Y",
        "01JNK2BSE07AEMMEAHFDEJJB6M",
        "01JNK2BSE3G5C692BMBKP3MEQ2",
        "01JNK2BSE88MM4J0VW5RGW8X7D",
        "01JNK2BSECCQT9VPTGW9A01XYE",
        "01JNK2BSEH5NG98469F004QRPW",
        "01JNK2BSENXG46QBD8G1QHR2QA",
        "01JNK2BSFHZK9MZZ946KG19T95",    
        "01JNK2BSFNJ0JQWE8HASFP9GSV",
        "01JNK2BSFT7DEWAY592XMYMBJD",
        "01JNK2BSFY1HDFKQ0WN4ER59VT",
        "01JNK2BSG23D0NMNWW8BM5YW7Z",
        "01JNK2BSG6S62YDK7CSJQNGJAR",
        "01JNK2BSGAAJP4NM5ZQK8GCSKJ",
        "01JNK2BSGFZAAT8N3XQ5DAM0NM",
        "01JNK2BSGJ31M59QBR0DYY6AH7",
        "01JNK2BSGR10M38Q9AHATQZ1KY",
        "01JNK2BSGW18W3EANNVA01803K",
        "01JNK2BSH2GWRFSHGGMNYQKZ6N",
        "01JNK2BSH66G8VZBQXWCCN8MRF",
        "01JNK2BSHCJ8Q0P6NYHPM4GZE4",
        "01JNK2BSHGYEADNHMGSW404412",
        "01JNK2BSHP0QS95KV030JTCA5F",
        "01JNK2BSHVXX18VP8573GXWNVT",
        "01JNK2BSJ1QSJCNDXDTFXW572C",
        "01JNK2BSJ517DD2QKTFVRQ2DJK",
        "01JNK2BSJA7SBTTT9DK4HSY1HS",
        "01JNK2BSJGEJ6JV66DJRT11JYE",
        "01JNK2BSJM8W73K8N6DPRCZWB8",
        "01JNK2BSJRSECJ94H24NGRJDC1",
        "01JNK2BSJYSXGSB31DJPFPJDJP",
        "01JNK2BSK2T82DBNPQB11XX5TR",
        "01JNK2BSK6YHMBFXKQBPVM3K8B",
        "01JNK2BSKAVQF2A8Z5AA4YWNJW",
        "01JNK2BSKH70ZF8WVKD1FVF16J",
        "01jngsm04sh9bf4btpnyzdnn5z",
    ];

    public static function getStateId($stateName, $states, $stateIds) {
        $index = array_search($stateName, $states);
        if ($index !== false) {
            return $stateIds[$index];
        }
        return null;
    }

    public static function getStateName($stateId, $states, $stateIds) {
        $index = array_search($stateId, $stateIds);
        if ($index !== false) {
            return $states[$index];
        }
        return null;
    }

    public static function getStatesByZone($stateName) {
        switch (true) {
            case in_array($stateName, self::NORTH_CENTRAL):
                return self::NORTH_CENTRAL;
            case in_array($stateName, self::NORTH_EAST):
                return self::NORTH_EAST;
            case in_array($stateName, self::NORTH_WEST):
                return self::NORTH_WEST;
            case in_array($stateName, self::SOUTH_EAST):
                return self::SOUTH_EAST;
            case in_array($stateName, self::SOUTH_WEST):
                return self::SOUTH_WEST;
            case in_array($stateName, self::SOUTH_SOUTH):
                return self::SOUTH_SOUTH;
            default:
                return [];
        }
    }
}