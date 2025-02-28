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

    'accepted' => "L'attributo: deve essere accettato",
    'active_url' => "L'attributo: non è un URL valido",
    'after' => "L'attributo: deve essere una data successiva a: date",
    'after_or_equal' => "L'attributo: deve essere una data successiva o uguale a: date",
    'alpha' => "L'attributo: può contenere solo lettere",
    'alpha_dash' => "L'attributo: può contenere solo lettere, numeri, trattini e trattini bassi",
    'alpha_num' => "L'attributo: può contenere solo lettere e numeri",
    'array' => "L'attributo: deve essere un array",
    'before' => "L'attributo: deve essere una data precedente a: date",
    'before_or_equal' => "L'attributo: deve essere una data precedente o uguale a: date",
    'between' => [
        'numeric' => "L'attributo: deve essere compreso tra: min e: max",
        'file' => "L'attributo: deve essere compreso tra: min e: max kilobyte",
        'string' => "L'attributo: deve essere compreso tra: min e: max caratteri",
        'array' => "L'attributo: deve avere tra: min e: max elementi",
    ],
    'boolean' => "Il campo: attributo deve essere vero o falso",
    'confirmed' => 'La conferma: attributo non corrisponde.',
    'date' => "L'attributo: non è una data valida",
    'date_equals' => "L'attributo: deve essere una data uguale a: date",
    'date_format' => "L'attributo: non corrisponde al formato: formato.",
    'different' => "L'attributo: e: altro devono essere diversi",
    'digits' => "L'attributo: deve essere: cifre cifre",
    'digits_between' => "L'attributo: deve essere compreso tra: min e: max cifre",
    'dimensions' => "L'attributo: ha dimensioni dell'immagine non valide.",
    'distinct' => 'Il campo: attributo ha un valore duplicato.',
    'email' => "L'attributo: deve essere un indirizzo email valido.",
    'ends_with' => "L'attributo: deve terminare con uno dei seguenti:: valori",
    'exists' => "L'attributo selezionato: non è valido.",
    'file' => "L'attributo: deve essere un file.",
    'filled' => "Il campo: attributo deve avere un valore.",
    'gt' => [
        'numeric' => "L'attributo: deve essere maggiore di: valore.",
        'file' => "L'attributo: deve essere maggiore di: value kilobyte.",
        'string' => "L'attributo: deve essere maggiore di: value caratteri.",
        'array' => "L'attributo: deve contenere più di: elementi di valore.",
    ],
    'gte' => [
        'numeric' => "L'attributo: deve essere maggiore o uguale a: valore.",
        'file' => "L'attributo: deve essere maggiore o uguale a: valore kilobyte",
        'string' => "L'attributo: deve essere maggiore o uguale a: caratteri di valore.",
        'array' => "L'attributo: deve avere: elementi di valore o più.",
    ],
    'image' => "L'attributo: deve essere un'immagine.",
    'in' => "L'attributo selezionato: non è valido.",
    'in_array' => "Il campo: attributo non esiste in: altro.",
    'integer' => "L'attributo: deve essere un numero intero.",
    'ip' => "L'attributo: deve essere un indirizzo IP valido",
    'ipv4' => "L'attributo: deve essere un indirizzo IPv4 valido.",
    'ipv6' => "L'attributo: deve essere un indirizzo IPv6 valido.",
    'json' => "L'attributo: deve essere una stringa JSON valida.",
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => "L'attributo: deve essere: caratteri di dimensione.",
        'array' => "L'attributo: deve contenere: articoli di taglia.",
    ],
    'starts_with' => "L'attributo: deve iniziare con uno dei seguenti:: valori.",
    'string' => "L'attributo: deve essere una stringa",
    'timezone' => "L'attributo: deve essere una zona valida.",
    'unique' => "L'attributo: è già stato preso.",
    'uploaded' => "Caricamento dell'attributo: non riuscito.",
    'url' => "Il formato: attributo non è valido.",
    'uuid' => "L'attributo: deve essere un UUID valido.",

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
            'rule-name' => 'messaggio personalizzato',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
