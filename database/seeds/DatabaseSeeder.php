<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\Shop;
use App\Models\Address;
use App\Models\Country;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ProductDetails;
use App\Models\Unit;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UserTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(ShopTableSeeder::class);
        $this->call(ProductTableSeeder::class);

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder
{
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();

        User::firstOrCreate( [
            'email' => 'micha@mihawk.org',
            'name' => 'micha',
            'password' => Hash::make( '1988link' ),
        ] );

        User::firstOrCreate([
           'email'  =>  'admin@mihawk.org',
            'name'  =>  'admin',
            'password'  => Hash::make('admin12345')
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $this->command->info('Die User wurden angelegt :-)');
    }
}

class UnitTableSeeder extends Seeder
{
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Unit::firstOrCreate([
            'name' => 'Kilogramm',
            'code' => 'kg'
        ]);

        Unit::firstOrCreate([
            'name' => 'Liter',
            'code' => 'l'
        ]);

        Unit::firstOrCreate([
            'name' => 'Packung',
            'code' => 'pg'
        ]);

        Unit::firstOrCreate([
            'name' => 'Stück',
            'code' => 'stk'
        ]);
    }
}

class CategoryTableSeeder extends Seeder
{
    public function run() {
        Category::firstOrCreate([
            'name' => 'Nahrungsmittel'
        ]);

        Category::firstOrCreate([
            'name' => 'Haushaltsmittel'
        ]);

        Category::firstOrCreate([
            'name' => 'Sonstiges'
        ]);
    }
}

class CountryTableSeeder extends Seeder
{
    public function run()
    {
        Country::firstOrCreate([
            'code' => 'US',
            'name' => 'United States']);
        Country::firstOrCreate([
            'code' => 'CA',
            'name' => 'Canada']);
        Country::firstOrCreate([
            'code' => 'AF',
            'name' => 'Afghanistan']);
        Country::firstOrCreate([
            'code' => 'AL',
            'name' => 'Albania']);
        Country::firstOrCreate([
            'code' => 'DZ',
            'name' => 'Algeria']);
        Country::firstOrCreate([
            'code' => 'DS',
            'name' => 'American Samoa']);
        Country::firstOrCreate([
            'code' => 'AD',
            'name' => 'Andorra']);
        Country::firstOrCreate([
            'code' => 'AO',
            'name' => 'Angola']);
        Country::firstOrCreate([
            'code' => 'AI',
            'name' => 'Anguilla']);
        Country::firstOrCreate([
            'code' => 'AQ',
            'name' => 'Antarctica']);
        Country::firstOrCreate([
            'code' => 'AG',
            'name' => 'Antigua and/or Barbuda']);
        Country::firstOrCreate([
            'code' => 'AR',
            'name' => 'Argentina']);
        Country::firstOrCreate([
            'code' => 'AM',
            'name' => 'Armenia']);
        Country::firstOrCreate([
            'code' => 'AW',
            'name' => 'Aruba']);
        Country::firstOrCreate([
            'code' => 'AU',
            'name' => 'Australia']);
        Country::firstOrCreate([
            'code' => 'AT',
            'name' => 'Austria']);
        Country::firstOrCreate([
            'code' => 'AZ',
            'name' => 'Azerbaijan']);
        Country::firstOrCreate([
            'code' => 'BS',
            'name' => 'Bahamas']);
        Country::firstOrCreate([
            'code' => 'BH',
            'name' => 'Bahrain']);
        Country::firstOrCreate([
            'code' => 'BD',
            'name' => 'Bangladesh']);
        Country::firstOrCreate([
            'code' => 'BB',
            'name' => 'Barbados']);
        Country::firstOrCreate([
            'code' => 'BY',
            'name' => 'Belarus']);
        Country::firstOrCreate([
            'code' => 'BE',
            'name' => 'Belgium']);
        Country::firstOrCreate([
            'code' => 'BZ',
            'name' => 'Belize']);
        Country::firstOrCreate([
            'code' => 'BJ',
            'name' => 'Benin']);
        Country::firstOrCreate([
            'code' => 'BM',
            'name' => 'Bermuda']);
        Country::firstOrCreate([
            'code' => 'BT',
            'name' => 'Bhutan']);
        Country::firstOrCreate([
            'code' => 'BO',
            'name' => 'Bolivia']);
        Country::firstOrCreate([
            'code' => 'BA',
            'name' => 'Bosnia and Herzegovina']);
        Country::firstOrCreate([
            'code' => 'BW',
            'name' => 'Botswana']);
        Country::firstOrCreate([
            'code' => 'BV',
            'name' => 'Bouvet Island']);
        Country::firstOrCreate([
            'code' => 'BR',
            'name' => 'Brazil']);
        Country::firstOrCreate([
            'code' => 'IO',
            'name' => 'British lndian Ocean Territory']);
        Country::firstOrCreate([
            'code' => 'BN',
            'name' => 'Brunei Darussalam']);
        Country::firstOrCreate([
            'code' => 'BG',
            'name' => 'Bulgaria']);
        Country::firstOrCreate([
            'code' => 'BF',
            'name' => 'Burkina Faso']);
        Country::firstOrCreate([
            'code' => 'BI',
            'name' => 'Burundi']);
        Country::firstOrCreate([
            'code' => 'KH',
            'name' => 'Cambodia']);
        Country::firstOrCreate([
            'code' => 'CM',
            'name' => 'Cameroon']);
        Country::firstOrCreate([
            'code' => 'CV',
            'name' => 'Cape Verde']);
        Country::firstOrCreate([
            'code' => 'KY',
            'name' => 'Cayman Islands']);
        Country::firstOrCreate([
            'code' => 'CF',
            'name' => 'Central African Republic']);
        Country::firstOrCreate([
            'code' => 'TD',
            'name' => 'Chad']);
        Country::firstOrCreate([
            'code' => 'CL',
            'name' => 'Chile']);
        Country::firstOrCreate([
            'code' => 'CN',
            'name' => 'China']);
        Country::firstOrCreate([
            'code' => 'CX',
            'name' => 'Christmas Island']);
        Country::firstOrCreate([
            'code' => 'CC',
            'name' => 'Cocos (Keeling) Islands']);
        Country::firstOrCreate([
            'code' => 'CO',
            'name' => 'Colombia']);
        Country::firstOrCreate([
            'code' => 'KM',
            'name' => 'Comoros']);
        Country::firstOrCreate([
            'code' => 'CG',
            'name' => 'Congo']);
        Country::firstOrCreate([
            'code' => 'CK',
            'name' => 'Cook Islands']);
        Country::firstOrCreate([
            'code' => 'CR',
            'name' => 'Costa Rica']);
        Country::firstOrCreate([
            'code' => 'HR',
            'name' => 'Croatia (Hrvatska)']);
        Country::firstOrCreate([
            'code' => 'CU',
            'name' => 'Cuba']);
        Country::firstOrCreate([
            'code' => 'CY',
            'name' => 'Cyprus']);
        Country::firstOrCreate([
            'code' => 'CZ',
            'name' => 'Czech Republic']);
        Country::firstOrCreate([
            'code' => 'DK',
            'name' => 'Denmark']);
        Country::firstOrCreate([
            'code' => 'DJ',
            'name' => 'Djibouti']);
        Country::firstOrCreate([
            'code' => 'DM',
            'name' => 'Dominica']);
        Country::firstOrCreate([
            'code' => 'DO',
            'name' => 'Dominican Republic']);
        Country::firstOrCreate([
            'code' => 'TP',
            'name' => 'East Timor']);
        Country::firstOrCreate([
            'code' => 'EC',
            'name' => 'Ecuador']);
        Country::firstOrCreate([
            'code' => 'EG',
            'name' => 'Egypt']);
        Country::firstOrCreate([
            'code' => 'SV',
            'name' => 'El Salvador']);
        Country::firstOrCreate([
            'code' => 'GQ',
            'name' => 'Equatorial Guinea']);
        Country::firstOrCreate([
            'code' => 'ER',
            'name' => 'Eritrea']);
        Country::firstOrCreate([
            'code' => 'EE',
            'name' => 'Estonia']);
        Country::firstOrCreate([
            'code' => 'ET',
            'name' => 'Ethiopia']);
        Country::firstOrCreate([
            'code' => 'FK',
            'name' => 'Falkland Islands (Malvinas)']);
        Country::firstOrCreate([
            'code' => 'FO',
            'name' => 'Faroe Islands']);
        Country::firstOrCreate([
            'code' => 'FJ',
            'name' => 'Fiji']);
        Country::firstOrCreate([
            'code' => 'FI',
            'name' => 'Finland']);
        Country::firstOrCreate([
            'code' => 'FR',
            'name' => 'France']);
        Country::firstOrCreate([
            'code' => 'FX',
            'name' => 'France, Metropolitan']);
        Country::firstOrCreate([
            'code' => 'GF',
            'name' => 'French Guiana']);
        Country::firstOrCreate([
            'code' => 'PF',
            'name' => 'French Polynesia']);
        Country::firstOrCreate([
            'code' => 'TF',
            'name' => 'French Southern Territories']);
        Country::firstOrCreate([
            'code' => 'GA',
            'name' => 'Gabon']);
        Country::firstOrCreate([
            'code' => 'GM',
            'name' => 'Gambia']);
        Country::firstOrCreate([
            'code' => 'GE',
            'name' => 'Georgia']);
        Country::firstOrCreate([
            'code' => 'DE',
            'name' => 'Germany']);
        Country::firstOrCreate([
            'code' => 'GH',
            'name' => 'Ghana']);
        Country::firstOrCreate([
            'code' => 'GI',
            'name' => 'Gibraltar']);
        Country::firstOrCreate([
            'code' => 'GR',
            'name' => 'Greece']);
        Country::firstOrCreate([
            'code' => 'GL',
            'name' => 'Greenland']);
        Country::firstOrCreate([
            'code' => 'GD',
            'name' => 'Grenada']);
        Country::firstOrCreate([
            'code' => 'GP',
            'name' => 'Guadeloupe']);
        Country::firstOrCreate([
            'code' => 'GU',
            'name' => 'Guam']);
        Country::firstOrCreate([
            'code' => 'GT',
            'name' => 'Guatemala']);
        Country::firstOrCreate([
            'code' => 'GN',
            'name' => 'Guinea']);
        Country::firstOrCreate([
            'code' => 'GW',
            'name' => 'Guinea-Bissau']);
        Country::firstOrCreate([
            'code' => 'GY',
            'name' => 'Guyana']);
        Country::firstOrCreate([
            'code' => 'HT',
            'name' => 'Haiti']);
        Country::firstOrCreate([
            'code' => 'HM',
            'name' => 'Heard and Mc Donald Islands']);
        Country::firstOrCreate([
            'code' => 'HN',
            'name' => 'Honduras']);
        Country::firstOrCreate([
            'code' => 'HK',
            'name' => 'Hong Kong']);
        Country::firstOrCreate([
            'code' => 'HU',
            'name' => 'Hungary']);
        Country::firstOrCreate([
            'code' => 'IS',
            'name' => 'Iceland']);
        Country::firstOrCreate([
            'code' => 'IN',
            'name' => 'India']);
        Country::firstOrCreate([
            'code' => 'ID',
            'name' => 'Indonesia']);
        Country::firstOrCreate([
            'code' => 'IR',
            'name' => 'Iran (Islamic Republic of)']);
        Country::firstOrCreate([
            'code' => 'IQ',
            'name' => 'Iraq']);
        Country::firstOrCreate([
            'code' => 'IE',
            'name' => 'Ireland']);
        Country::firstOrCreate([
            'code' => 'IL',
            'name' => 'Israel']);
        Country::firstOrCreate([
            'code' => 'IT',
            'name' => 'Italy']);
        Country::firstOrCreate([
            'code' => 'CI',
            'name' => 'Ivory Coast']);
        Country::firstOrCreate([
            'code' => 'JM',
            'name' => 'Jamaica']);
        Country::firstOrCreate([
            'code' => 'JP',
            'name' => 'Japan']);
        Country::firstOrCreate([
            'code' => 'JO',
            'name' => 'Jordan']);
        Country::firstOrCreate([
            'code' => 'KZ',
            'name' => 'Kazakhstan']);
        Country::firstOrCreate([
            'code' => 'KE',
            'name' => 'Kenya']);
        Country::firstOrCreate([
            'code' => 'KI',
            'name' => 'Kiribati']);
        Country::firstOrCreate([
            'code' => 'KP',
            'name' => 'Korea, Democratic People`s Republic of']);
        Country::firstOrCreate([
            'code' => 'KR',
            'name' => 'Korea, Republic of']);
        Country::firstOrCreate([
            'code' => 'XK',
            'name' => 'Kosovo']);
        Country::firstOrCreate([
            'code' => 'KW',
            'name' => 'Kuwait']);
        Country::firstOrCreate([
            'code' => 'KG',
            'name' => 'Kyrgyzstan']);
        Country::firstOrCreate([
            'code' => 'LA',
            'name' => 'Lao People`s Democratic Republic']);
        Country::firstOrCreate([
            'code' => 'LV',
            'name' => 'Latvia']);
        Country::firstOrCreate([
            'code' => 'LB',
            'name' => 'Lebanon']);
        Country::firstOrCreate([
            'code' => 'LS',
            'name' => 'Lesotho']);
        Country::firstOrCreate([
            'code' => 'LR',
            'name' => 'Liberia']);
        Country::firstOrCreate([
            'code' => 'LY',
            'name' => 'Libyan Arab Jamahiriya']);
        Country::firstOrCreate([
            'code' => 'LI',
            'name' => 'Liechtenstein']);
        Country::firstOrCreate([
            'code' => 'LT',
            'name' => 'Lithuania']);
        Country::firstOrCreate([
            'code' => 'LU',
            'name' => 'Luxembourg']);
        Country::firstOrCreate([
            'code' => 'MO',
            'name' => 'Macau']);
        Country::firstOrCreate([
            'code' => 'MK',
            'name' => 'Macedonia']);
        Country::firstOrCreate([
            'code' => 'MG',
            'name' => 'Madagascar']);
        Country::firstOrCreate([
            'code' => 'MW',
            'name' => 'Malawi']);
        Country::firstOrCreate([
            'code' => 'MY',
            'name' => 'Malaysia']);
        Country::firstOrCreate([
            'code' => 'MV',
            'name' => 'Maldives']);
        Country::firstOrCreate([
            'code' => 'ML',
            'name' => 'Mali']);
        Country::firstOrCreate([
            'code' => 'MT',
            'name' => 'Malta']);
        Country::firstOrCreate([
            'code' => 'MH',
            'name' => 'Marshall Islands']);
        Country::firstOrCreate([
            'code' => 'MQ',
            'name' => 'Martinique']);
        Country::firstOrCreate([
            'code' => 'MR',
            'name' => 'Mauritania']);
        Country::firstOrCreate([
            'code' => 'MU',
            'name' => 'Mauritius']);
        Country::firstOrCreate([
            'code' => 'TY',
            'name' => 'Mayotte']);
        Country::firstOrCreate([
            'code' => 'MX',
            'name' => 'Mexico']);
        Country::firstOrCreate([
            'code' => 'FM',
            'name' => 'Micronesia, Federated States of']);
        Country::firstOrCreate([
            'code' => 'MD',
            'name' => 'Moldova, Republic of']);
        Country::firstOrCreate([
            'code' => 'MC',
            'name' => 'Monaco']);
        Country::firstOrCreate([
            'code' => 'MN',
            'name' => 'Mongolia']);
        Country::firstOrCreate([
            'code' => 'ME',
            'name' => 'Montenegro']);
        Country::firstOrCreate([
            'code' => 'MS',
            'name' => 'Montserrat']);
        Country::firstOrCreate([
            'code' => 'MA',
            'name' => 'Morocco']);
        Country::firstOrCreate([
            'code' => 'MZ',
            'name' => 'Mozambique']);
        Country::firstOrCreate([
            'code' => 'MM',
            'name' => 'Myanmar']);
        Country::firstOrCreate([
            'code' => 'NA',
            'name' => 'Namibia']);
        Country::firstOrCreate([
            'code' => 'NR',
            'name' => 'Nauru']);
        Country::firstOrCreate([
            'code' => 'NP',
            'name' => 'Nepal']);
        Country::firstOrCreate([
            'code' => 'NL',
            'name' => 'Netherlands']);
        Country::firstOrCreate([
            'code' => 'AN',
            'name' => 'Netherlands Antilles']);
        Country::firstOrCreate([
            'code' => 'NC',
            'name' => 'New Caledonia']);
        Country::firstOrCreate([
            'code' => 'NZ',
            'name' => 'New Zealand']);
        Country::firstOrCreate([
            'code' => 'NI',
            'name' => 'Nicaragua']);
        Country::firstOrCreate([
            'code' => 'NE',
            'name' => 'Niger']);
        Country::firstOrCreate([
            'code' => 'NG',
            'name' => 'Nigeria']);
        Country::firstOrCreate([
            'code' => 'NU',
            'name' => 'Niue']);
        Country::firstOrCreate([
            'code' => 'NF',
            'name' => 'Norfork Island']);
        Country::firstOrCreate([
            'code' => 'MP',
            'name' => 'Northern Mariana Islands']);
        Country::firstOrCreate([
            'code' => 'NO',
            'name' => 'Norway']);
        Country::firstOrCreate([
            'code' => 'OM',
            'name' => 'Oman']);
        Country::firstOrCreate([
            'code' => 'PK',
            'name' => 'Pakistan']);
        Country::firstOrCreate([
            'code' => 'PW',
            'name' => 'Palau']);
        Country::firstOrCreate([
            'code' => 'PA',
            'name' => 'Panama']);
        Country::firstOrCreate([
            'code' => 'PG',
            'name' => 'Papua New Guinea']);
        Country::firstOrCreate([
            'code' => 'PY',
            'name' => 'Paraguay']);
        Country::firstOrCreate([
            'code' => 'PE',
            'name' => 'Peru']);
        Country::firstOrCreate([
            'code' => 'PH',
            'name' => 'Philippines']);
        Country::firstOrCreate([
            'code' => 'PN',
            'name' => 'Pitcairn']);
        Country::firstOrCreate([
            'code' => 'PL',
            'name' => 'Poland']);
        Country::firstOrCreate([
            'code' => 'PT',
            'name' => 'Portugal']);
        Country::firstOrCreate([
            'code' => 'PR',
            'name' => 'Puerto Rico']);
        Country::firstOrCreate([
            'code' => 'QA',
            'name' => 'Qatar']);
        Country::firstOrCreate([
            'code' => 'RE',
            'name' => 'Reunion']);
        Country::firstOrCreate([
            'code' => 'RO',
            'name' => 'Romania']);
        Country::firstOrCreate([
            'code' => 'RU',
            'name' => 'Russian Federation']);
        Country::firstOrCreate([
            'code' => 'RW',
            'name' => 'Rwanda']);
        Country::firstOrCreate([
            'code' => 'KN',
            'name' => 'Saint Kitts and Nevis']);
        Country::firstOrCreate([
            'code' => 'LC',
            'name' => 'Saint Lucia']);
        Country::firstOrCreate([
            'code' => 'VC',
            'name' => 'Saint Vincent and the Grenadines']);
        Country::firstOrCreate([
            'code' => 'WS',
            'name' => 'Samoa']);
        Country::firstOrCreate([
            'code' => 'SM',
            'name' => 'San Marino']);
        Country::firstOrCreate([
            'code' => 'ST',
            'name' => 'Sao Tome and Principe']);
        Country::firstOrCreate([
            'code' => 'SA',
            'name' => 'Saudi Arabia']);
        Country::firstOrCreate([
            'code' => 'SN',
            'name' => 'Senegal']);
        Country::firstOrCreate([
            'code' => 'RS',
            'name' => 'Serbia']);
        Country::firstOrCreate([
            'code' => 'SC',
            'name' => 'Seychelles']);
        Country::firstOrCreate([
            'code' => 'SL',
            'name' => 'Sierra Leone']);
        Country::firstOrCreate([
            'code' => 'SG',
            'name' => 'Singapore']);
        Country::firstOrCreate([
            'code' => 'SK',
            'name' => 'Slovakia']);
        Country::firstOrCreate([
            'code' => 'SI',
            'name' => 'Slovenia']);
        Country::firstOrCreate([
            'code' => 'SB',
            'name' => 'Solomon Islands']);
        Country::firstOrCreate([
            'code' => 'SO',
            'name' => 'Somalia']);
        Country::firstOrCreate([
            'code' => 'ZA',
            'name' => 'South Africa']);
        Country::firstOrCreate([
            'code' => 'GS',
            'name' => 'South Georgia South Sandwich Islands']);
        Country::firstOrCreate([
            'code' => 'ES',
            'name' => 'Spain']);
        Country::firstOrCreate([
            'code' => 'LK',
            'name' => 'Sri Lanka']);
        Country::firstOrCreate([
            'code' => 'SH',
            'name' => 'St. Helena']);
        Country::firstOrCreate([
            'code' => 'PM',
            'name' => 'St. Pierre and Miquelon']);
        Country::firstOrCreate([
            'code' => 'SD',
            'name' => 'Sudan']);
        Country::firstOrCreate([
            'code' => 'SR',
            'name' => 'Suriname']);
        Country::firstOrCreate([
            'code' => 'SJ',
            'name' => 'Svalbarn and Jan Mayen Islands']);
        Country::firstOrCreate([
            'code' => 'SZ',
            'name' => 'Swaziland']);
        Country::firstOrCreate([
            'code' => 'SE',
            'name' => 'Sweden']);
        Country::firstOrCreate([
            'code' => 'CH',
            'name' => 'Switzerland']);
        Country::firstOrCreate([
            'code' => 'SY',
            'name' => 'Syrian Arab Republic']);
        Country::firstOrCreate([
            'code' => 'TW',
            'name' => 'Taiwan']);
        Country::firstOrCreate([
            'code' => 'TJ',
            'name' => 'Tajikistan']);
        Country::firstOrCreate([
            'code' => 'TZ',
            'name' => 'Tanzania, United Republic of']);
        Country::firstOrCreate([
            'code' => 'TH',
            'name' => 'Thailand']);
        Country::firstOrCreate([
            'code' => 'TG',
            'name' => 'Togo']);
        Country::firstOrCreate([
            'code' => 'TK',
            'name' => 'Tokelau']);
        Country::firstOrCreate([
            'code' => 'TO',
            'name' => 'Tonga']);
        Country::firstOrCreate([
            'code' => 'TT',
            'name' => 'Trinidad and Tobago']);
        Country::firstOrCreate([
            'code' => 'TN',
            'name' => 'Tunisia']);
        Country::firstOrCreate([
            'code' => 'TR',
            'name' => 'Turkey']);
        Country::firstOrCreate([
            'code' => 'TM',
            'name' => 'Turkmenistan']);
        Country::firstOrCreate([
            'code' => 'TC',
            'name' => 'Turks and Caicos Islands']);
        Country::firstOrCreate([
            'code' => 'TV',
            'name' => 'Tuvalu']);
        Country::firstOrCreate([
            'code' => 'UG',
            'name' => 'Uganda']);
        Country::firstOrCreate([
            'code' => 'UA',
            'name' => 'Ukraine']);
        Country::firstOrCreate([
            'code' => 'AE',
            'name' => 'United Arab Emirates']);
        Country::firstOrCreate([
            'code' => 'GB',
            'name' => 'United Kingdom']);
        Country::firstOrCreate([
            'code' => 'UM',
            'name' => 'United States minor outlying islands']);
        Country::firstOrCreate([
            'code' => 'UY',
            'name' => 'Uruguay']);
        Country::firstOrCreate([
            'code' => 'UZ',
            'name' => 'Uzbekistan']);
        Country::firstOrCreate([
            'code' => 'VU',
            'name' => 'Vanuatu']);
        Country::firstOrCreate([
            'code' => 'VA',
            'name' => 'Vatican City State']);
        Country::firstOrCreate([
            'code' => 'VE',
            'name' => 'Venezuela']);
        Country::firstOrCreate([
            'code' => 'VN',
            'name' => 'Vietnam']);
        Country::firstOrCreate([
            'code' => 'VG',
            'name' => 'Virgin Islands (British)']);
        Country::firstOrCreate([
            'code' => 'VI',
            'name' => 'Virgin Islands (U.S.)']);
        Country::firstOrCreate([
            'code' => 'WF',
            'name' => 'Wallis and Futuna Islands']);
        Country::firstOrCreate([
            'code' => 'EH',
            'name' => 'Western Sahara']);
        Country::firstOrCreate([
            'code' => 'YE',
            'name' => 'Yemen']);
        Country::firstOrCreate([
            'code' => 'YU',
            'name' => 'Yugoslavia']);
        Country::firstOrCreate([
            'code' => 'ZR',
            'name' => 'Zaire']);
        Country::firstOrCreate([
            'code' => 'ZM',
            'name' => 'Zambia']);
        Country::firstOrCreate([
            'code' => 'ZW',
            'name' => 'Zimbabwe']);
    }
}

class AddressTableSeeder extends Seeder
{
    public function run(){
        Address::firstOrCreate([
            'country_id' => '81',
            'city' => 'Stralsund'
        ]);
    }
}

class ShopTableSeeder extends Seeder
{
    public function run(){
        Shop::firstOrCreate([
            'name' => 'Edeka',
            'address_id' => '1'
        ]);

        Shop::firstOrCreate([
            'name' => 'Penny',
            'address_id' => '1'
        ]);
    }
}

class ProductTableSeeder extends Seeder
{
    public function run(){
        $product1 = Product::firstOrCreate([
            'name'  => 'Fanta Orange 1,5l',
            'unit_id'   => '2'
        ]);

        ProductDetails::firstOrCreate([
            'shop_id'   => '1',
            'product_id' => $product1->id,
            'single_price'  => ''
        ]);

        $product2 = Product::firstOrCreate([
            'name'  => 'Coca-Cola 1,25l',
            'unit_id'   => '2'
        ]);
        ProductDetails::firstOrCreate([
            'shop_id'   => '1',
            'product_id' => $product2->id,
            'single_price'  => ''
        ]);

        $product3 = Product::firstOrCreate([
            'name'  => 'Glashäger Vital 1l',
            'unit_id'   => '2'
        ]);
        ProductDetails::firstOrCreate([
            'shop_id'   => '1',
            'product_id' => $product3->id,
            'single_price'  => ''
        ]);

        $product4 = Product::firstOrCreate([
            'name'  => 'G&G Eistee 1,5l',
            'unit_id'   => '2'
        ]);
        ProductDetails::firstOrCreate([
            'shop_id'   => '1',
            'product_id' => $product4->id,
            'single_price'  => ''
        ]);

        $product5 = Product::firstOrCreate([
            'name'  => 'Regina Taschentücher',
            'unit_id'   => '3'
        ]);
        ProductDetails::firstOrCreate([
            'shop_id'   => '1',
            'product_id' => $product5->id,
            'single_price'  => ''
        ]);

        $product6 = Product::firstOrCreate([
            'name'  => 'Dr. Oetker Tradizionale Pizza',
            'unit_id'   => '4'
        ]);
        ProductDetails::firstOrCreate([
            'shop_id'   => '1',
            'product_id' => $product6->id,
            'single_price'  => ''
        ]);

        $product7 = Product::firstOrCreate([
            'name'  => 'Jever Pils 6x0,33l',
            'unit_id'   => '3'
        ]);
        ProductDetails::firstOrCreate([
            'shop_id'   => '1',
            'product_id' => $product7->id,
            'single_price'  => ''
        ]);

        $product8 = Product::firstOrCreate([
            'name'  => 'Fa Duschgel',
            'unit_id'   => '4'
        ]);
        ProductDetails::firstOrCreate([
            'shop_id'   => '1',
            'product_id' => $product8->id,
            'single_price'  => ''
        ]);
    }
}
