<?php

// Format Currency
if (! function_exists('formatCurrency')) {
    function formatCurrency($amount, $currency = 'INR', $locale = 'en_IN')
    {
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, $currency);
    }
}

// get last year input
function generateYearArray($input)
{
    $currentYear = date('Y');
    $years = [];

    // Generate last (input + 1) years starting from current year
    for ($i = 0; $i <= $input; $i++) {
        $year = $currentYear - $i;
        $years[$year] = "Year $year";
    }

    return $years;
}
