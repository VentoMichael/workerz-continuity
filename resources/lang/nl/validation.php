<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Het :attribute moet geaccepteerd worden.',
    'active_url' => 'Het :attribute is geen geldige URL.',
    'after' => 'Het :attribute moet een datum na de :date.',
    'after_or_equal' => 'Het :attribute moet een datum zijn na of gelijk aan :date.',
    'alpha' => 'Het :attribute mag alleen letters bevatten.',
    'alpha_dash' => 'Het :attribute mag alleen letters, cijfers, streepjes en underscores bevatten.',
    'alpha_num' => 'Het :attribute mag alleen letters en cijfers bevatten.',
    'array' => 'Het :attribute moet een matrix zijn.',
    'before' => 'Het :attribute moet een datum vóór de :date.',
    'before_or_equal' => 'Het :attribute moet een datum voor of gelijk aan :date.',
    'between' => [
        'numeric' => 'Het :attribute moet liggen tussen :min en :max.',
        'file' => 'Het :attribute moet liggen tussen :min en :max kilobytes.',
        'string' => 'Het :attribute moet liggen tussen :min en :max karakters.',
        'array' => 'Het :attribute moet tussen :min en :max items bevatten.',
    ],
    'boolean' => 'Het :attribute veld moet waar of onwaar zijn.',
    'confirmed' => 'De :attribute bevestiging komt niet overeen.',
    'date' => 'Het :attribute is geen geldige datum.',
    'date_equals' => 'Het :attribute moet een datum zijn die gelijk is aan :date.',
    'date_format' => 'Het :attribute komt niet overeen met het formaat :format.',
    'different' => 'Het :attribute en :other moeten verschillend zijn.',
    'digits' => 'Het :attribute moet uit :digits cijfers bestaan.',
    'digits_between' => 'Het :attribute moet tussen :min en :max cijfers liggen.',
    'dimensions' => 'Het :attribute heeft ongeldige beeldafmetingen.',
    'distinct' => 'Het :attribute veld heeft een dubbele waarde.',
    'email' => 'Het :attribute moet een geldig e-mail adres zijn.',
    'ends_with' => 'Het :attribute moet eindigen met een van de volgende: :values.',
    'exists' => 'Het geselecteerde :attribute is ongeldig.',
    'file' => 'Het :attribute moet een bestand zijn.',
    'filled' => 'Het :attribute veld moet een waarde hebben.',
    'gt' => [
        'numeric' => 'Het :attribute moet groter zijn dan :value.',
        'file' => 'Het :attribute moet groter zijn dan :value kilobytes.',
        'string' => 'Het :attribute moet groter zijn dan de :value karakters.',
        'array' => 'Het :attribute moet meer dan :value items bevatten.',
    ],
    'gte' => [
        'numeric' => 'Het :attribute moet groter zijn dan of gelijk zijn aan :value.',
        'file' => 'Het :attribute moet groter zijn dan of gelijk zijn aan :value kilobytes.',
        'string' => 'Het :attribute moet groter zijn dan of gelijk zijn aan :value karakters.',
        'array' => 'Het :attribute moet :value items of meer hebben.',
    ],
    'image' => 'Het :attribute moet een afbeelding zijn.',
    'in' => 'Het geselecteerde :attribute is ongeldig.',
    'in_array' => 'Het veld :attribute bestaat niet in :overig.',
    'integer' => 'Het :attribute moet een geheel getal zijn.',
    'ip' => 'Het :attribute moet een geldig IP-adres zijn.',
    'ipv4' => 'Het :attribute moet een geldig IPv4 adres zijn.',
    'ipv6' => 'Het :attribute moet een geldig IPv6 adres zijn.',
    'json' => 'Het :attribute moet een geldige JSON string zijn.',
    'lt' => [
        'numeric' => 'Het :attribute moet kleiner zijn dan de :value.',
        'file' => 'Het :attribute moet kleiner zijn dan de :value kilobytes.',
        'string' => 'Het :attribute moet uit minder dan :value karakters bestaan.',
        'array' => 'Het :attribute moet uit minder dan :value items bestaan.',
    ],
    'lte' => [
        'numeric' => 'Het :attribute moet kleiner zijn dan of gelijk zijn aan :value.',
        'file' => 'Het :attribute moet kleiner zijn dan of gelijk zijn aan :value kilobytes.',
        'string' => 'Het :attribute mag niet groter zijn dan de :value karakters.',
        'array' => 'Het :attribute mag niet meer dan :value items hebben.',
    ],
    'max' => [
        'numeric' => 'Het :attribute mag niet groter zijn dan :max.',
        'file' => 'Het :attribute mag niet groter zijn dan :max kilobytes.',
        'string' => 'Het :attribute mag niet groter zijn dan :max karakters.',
        'array' => 'Het :attribute mag niet meer dan :max items bevatten.',
    ],
    'mimes' => 'Het :attribute moet een bestand zijn van het type: :values.',
    'mimetypes' => 'Het :attribute moet een bestand zijn van het type: :values.',
    'min' => [
        'numeric' => 'Het :attribute moet minstens :min. zijn.',
        'file' => 'Het :attribute moet minstens :min kilobytes zijn.',
        'string' => 'Het :attribute moet uit minstens :min tekens bestaan.',
        'array' => 'Het :attribute moet minstens :min items hebben.',
    ],
    'multiple_of' => 'Het :attribute moet een veelvoud van :value zijn.',
    'not_in' => 'Het geselecteerde :attribute is ongeldig.',
    'not_regex' => 'Het formaat van het :attribute is ongeldig.',
    'numeric' => 'Het :attribute moet een getal zijn.',
    'password' => 'Het wachtwoord is onjuist.',
    'present' => 'Het :attribute veld moet aanwezig zijn.',
    'regex' => 'De opmaak van het :attribute is ongeldig.',
    'required' => 'Het :attribute veld is verplicht.',
    'required_if' => 'Het :attribute veld is verplicht als :other :value is.',
    'required_unless' => 'Het :attribute veld is verplicht tenzij :other in :values staat.',
    'required_with' => 'Het veld :attribute is verplicht als :values aanwezig is.',
    'required_with_all' => 'Het veld :attribute is verplicht wanneer :values aanwezig is.',
    'required_without' => 'Het veld :attribute is vereist wanneer :values niet aanwezig is.',
    'required_without_all' => 'Het veld :attribute is vereist als geen van de :values aanwezig is.',
    'same' => 'Het :attribute en :other moeten overeenkomen.',
    'size' => [
        'numeric' => 'Het :attribute moet :size zijn.',
        'file' => 'Het :attribute moet :size kilobytes zijn.',
        'string' => 'Het :attribute moet :size karakters zijn.',
        'array' => 'Het :attribute moet :size items bevatten.',
    ],
    'starts_with' => 'Het :attribute moet beginnen met een van de volgende: :values.',
    'string' => 'Het :attribute moet een string zijn.',
    'timezone' => 'Het :attribute moet een geldige zone zijn.',
    'unique' => 'Het :attribute is al gebruikt.',
    'uploaded' => 'Het uploaden van het :attribute is mislukt.',
    'url' => 'Het formaat van het :attribute is ongeldig.',
    'uuid' => 'Het :attribute moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'conditions.required' => 'Je moet akkoord gaan met de voorwaarden',
        'pricemax.max' => 'Een te hoge prijs zal geen klanten aantrekken',
        'number.required' => 'Telefoonnummer is vereist',
        'number.max' => 'Het telefoonnummer mag niet langer zijn dan 12 tekens',
        'number.min' => 'Het telefoonnummer moet ten minste 10 tekens lang zijn',
        'newsletter.email' => 'Het e-mailadres is onjuist',
    ],
    'attributes' => [
        'title' => 'titel',
        'picture' => 'afbeelding',
        'pricemax' => 'uurtarief',
        'location' => 'plaats',
        'job' => 'handel',
        'category-job' => 'handelscategorie(ën)',
        'name' => 'naam',
        'subject' => 'onderwerp',
        'surname' => 'voornaam',
        'disponibility' => 'beschikbaarheid',
        'adress' => 'adres',
        'password' => 'wachtwoord',
        'categoryUser' => 'functiecategorie',
        'number' => 'telefoon',
        'categoryAds' => 'handelscategorie',
        'startmonth' => 'startmaand',
        'websitetwo' => '2e website',
        'websitethree' => '3e website',
        'locationtwo' => '2e locatie',
        'locationthree' => '3e locatie',
    ],
];
