<?php

use App\Constants\HasLookupType\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $models = array(

            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::JORDANIAN_DINAR['code'],
                'key' => Currency::JORDANIAN_DINAR['key'],
                'prefix' => Currency::JORDANIAN_DINAR['prefix'],
                'name' => Currency::JORDANIAN_DINAR['name'],
                'name_ar' => Currency::JORDANIAN_DINAR['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::SAUDI_RIYAL['code'],
                'key' => Currency::SAUDI_RIYAL['key'],
                'prefix' => Currency::SAUDI_RIYAL['prefix'],
                'name' => Currency::SAUDI_RIYAL['name'],
                'name_ar' => Currency::SAUDI_RIYAL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::EGYPTIAN_POUND['code'],
                'key' => Currency::EGYPTIAN_POUND['key'],
                'prefix' => Currency::EGYPTIAN_POUND['prefix'],
                'name' => Currency::EGYPTIAN_POUND['name'],
                'name_ar' => Currency::EGYPTIAN_POUND['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::AFGHAN_AFGHANI['code'],
                'key' => Currency::AFGHAN_AFGHANI['key'],
                'prefix' => Currency::AFGHAN_AFGHANI['prefix'],
                'name' => Currency::AFGHAN_AFGHANI['name'],
                'name_ar' => Currency::AFGHAN_AFGHANI['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::ALGERIAN_DINAR['code'],
                'key' => Currency::ALGERIAN_DINAR['key'],
                'prefix' => Currency::ALGERIAN_DINAR['prefix'],
                'name' => Currency::ALGERIAN_DINAR['name'],
                'name_ar' => Currency::ALGERIAN_DINAR['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::ARMENIAN_DRAM['code'],
                'key' => Currency::ARMENIAN_DRAM['key'],
                'prefix' => Currency::ARMENIAN_DRAM['prefix'],
                'name' => Currency::ARMENIAN_DRAM['name'],
                'name_ar' => Currency::ARMENIAN_DRAM['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::AZERBAIJANI_MANAT['code'],
                'key' => Currency::AZERBAIJANI_MANAT['key'],
                'prefix' => Currency::AZERBAIJANI_MANAT['prefix'],
                'name' => Currency::AZERBAIJANI_MANAT['name'],
                'name_ar' => Currency::AZERBAIJANI_MANAT['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::BAHRAINI_DINAR['code'],
                'key' => Currency::BAHRAINI_DINAR['key'],
                'prefix' => Currency::BAHRAINI_DINAR['prefix'],
                'name' => Currency::BAHRAINI_DINAR['name'],
                'name_ar' => Currency::BAHRAINI_DINAR['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::EURO['code'],
                'key' => Currency::EURO['key'],
                'prefix' => Currency::EURO['prefix'],
                'name' => Currency::EURO['name'],
                'name_ar' => Currency::EURO['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::DJIBOUTIAN_FRANC['code'],
                'key' => Currency::DJIBOUTIAN_FRANC['key'],
                'prefix' => Currency::DJIBOUTIAN_FRANC['prefix'],
                'name' => Currency::DJIBOUTIAN_FRANC['name'],
                'name_ar' => Currency::DJIBOUTIAN_FRANC['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::GEORGIAN_LARI['code'],
                'key' => Currency::GEORGIAN_LARI['key'],
                'prefix' => Currency::GEORGIAN_LARI['prefix'],
                'name' => Currency::GEORGIAN_LARI['name'],
                'name_ar' => Currency::GEORGIAN_LARI['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::IRANIAN_RIAL['code'],
                'key' => Currency::IRANIAN_RIAL['key'],
                'prefix' => Currency::IRANIAN_RIAL['prefix'],
                'name' => Currency::IRANIAN_RIAL['name'],
                'name_ar' => Currency::IRANIAN_RIAL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::IRAQI_DINAR['code'],
                'key' => Currency::IRAQI_DINAR['key'],
                'prefix' => Currency::IRAQI_DINAR['prefix'],
                'name' => Currency::IRAQI_DINAR['name'],
                'name_ar' => Currency::IRAQI_DINAR['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::KUWAITI_DINAR['code'],
                'key' => Currency::KUWAITI_DINAR['key'],
                'prefix' => Currency::KUWAITI_DINAR['prefix'],
                'name' => Currency::KUWAITI_DINAR['name'],
                'name_ar' => Currency::KUWAITI_DINAR['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::LEBANESE_POUND['code'],
                'key' => Currency::LEBANESE_POUND['key'],
                'prefix' => Currency::LEBANESE_POUND['prefix'],
                'name' => Currency::LEBANESE_POUND['name'],
                'name_ar' => Currency::LEBANESE_POUND['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::LIBYAN_DINAR['code'],
                'key' => Currency::LIBYAN_DINAR['key'],
                'prefix' => Currency::LIBYAN_DINAR['prefix'],
                'name' => Currency::LIBYAN_DINAR['name'],
                'name_ar' => Currency::LIBYAN_DINAR['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::MAURITANIAN_OUGUIYA['code'],
                'key' => Currency::MAURITANIAN_OUGUIYA['key'],
                'prefix' => Currency::MAURITANIAN_OUGUIYA['prefix'],
                'name' => Currency::MAURITANIAN_OUGUIYA['name'],
                'name_ar' => Currency::MAURITANIAN_OUGUIYA['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::MOROCCAN_DIRHAM['code'],
                'key' => Currency::MOROCCAN_DIRHAM['key'],
                'prefix' => Currency::MOROCCAN_DIRHAM['prefix'],
                'name' => Currency::MOROCCAN_DIRHAM['name'],
                'name_ar' => Currency::MOROCCAN_DIRHAM['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::OMANI_RIAL['code'],
                'key' => Currency::OMANI_RIAL['key'],
                'prefix' => Currency::OMANI_RIAL['prefix'],
                'name' => Currency::OMANI_RIAL['name'],
                'name_ar' => Currency::OMANI_RIAL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::PALESTINIAN_POUND['code'],
                'key' => Currency::PALESTINIAN_POUND['key'],
                'prefix' => Currency::PALESTINIAN_POUND['prefix'],
                'name' => Currency::PALESTINIAN_POUND['name'],
                'name_ar' => Currency::PALESTINIAN_POUND['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::QATARI_RIYAL['code'],
                'key' => Currency::QATARI_RIYAL['key'],
                'prefix' => Currency::QATARI_RIYAL['prefix'],
                'name' => Currency::QATARI_RIYAL['name'],
                'name_ar' => Currency::QATARI_RIYAL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::SOMALI_SHILLING['code'],
                'key' => Currency::SOMALI_SHILLING['key'],
                'prefix' => Currency::SOMALI_SHILLING['prefix'],
                'name' => Currency::SOMALI_SHILLING['name'],
                'name_ar' => Currency::SOMALI_SHILLING['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::SUDANESE_POUND['code'],
                'key' => Currency::SUDANESE_POUND['key'],
                'prefix' => Currency::SUDANESE_POUND['prefix'],
                'name' => Currency::SUDANESE_POUND['name'],
                'name_ar' => Currency::SUDANESE_POUND['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::SYRIAN_POUND['code'],
                'key' => Currency::SYRIAN_POUND['key'],
                'prefix' => Currency::SYRIAN_POUND['prefix'],
                'name' => Currency::SYRIAN_POUND['name'],
                'name_ar' => Currency::SYRIAN_POUND['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::TUNISIAN_DINAR['code'],
                'key' => Currency::TUNISIAN_DINAR['key'],
                'prefix' => Currency::TUNISIAN_DINAR['prefix'],
                'name' => Currency::TUNISIAN_DINAR['name'],
                'name_ar' => Currency::TUNISIAN_DINAR['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::TURKISH_LIRA['code'],
                'key' => Currency::TURKISH_LIRA['key'],
                'prefix' => Currency::TURKISH_LIRA['prefix'],
                'name' => Currency::TURKISH_LIRA['name'],
                'name_ar' => Currency::TURKISH_LIRA['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::UNITED_ARAB_EMIRATES_DIRHAM['code'],
                'key' => Currency::UNITED_ARAB_EMIRATES_DIRHAM['key'],
                'prefix' => Currency::UNITED_ARAB_EMIRATES_DIRHAM['prefix'],
                'name' => Currency::UNITED_ARAB_EMIRATES_DIRHAM['name'],
                'name_ar' => Currency::UNITED_ARAB_EMIRATES_DIRHAM['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::SAHRAWI_PESETA['code'],
                'key' => Currency::SAHRAWI_PESETA['key'],
                'prefix' => Currency::SAHRAWI_PESETA['prefix'],
                'name' => Currency::SAHRAWI_PESETA['name'],
                'name_ar' => Currency::SAHRAWI_PESETA['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::YEMENI_RIAL['code'],
                'key' => Currency::YEMENI_RIAL['key'],
                'prefix' => Currency::YEMENI_RIAL['prefix'],
                'name' => Currency::YEMENI_RIAL['name'],
                'name_ar' => Currency::YEMENI_RIAL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => Currency::LOOKUP_TYPE,
                'code' => Currency::UNITED_STATES_DOLLAR['code'],
                'key' => Currency::UNITED_STATES_DOLLAR['key'],
                'prefix' => Currency::UNITED_STATES_DOLLAR['prefix'],
                'name' => Currency::UNITED_STATES_DOLLAR['name'],
                'name_ar' => Currency::UNITED_STATES_DOLLAR['name_ar'],
            ],

        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('system_lookups')->where('type', Currency::LOOKUP_TYPE)->delete();
    }
};
