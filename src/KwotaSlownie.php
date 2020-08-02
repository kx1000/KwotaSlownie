<?php

namespace KwotaSlownie;

/**
 * Class KwotaSlownie
 * @package KwotaSlownie
 */
class KwotaSlownie {

    const MODE_ZLOTY = 'ZLOTY';
    const MODE_GROSZ = 'GROSZ';

    const ONE_ZLOTY = 'złoty';
    const TWO_ZLOTYS = 'złote';
    const FIVE_ZLOTYS = 'złotych';

    const ONE_GROSZ = 'grosz';
    const TWO_GROSZES = 'grosze';
    const FIVE_GROSZES = 'groszy';

    private $amountInWords;

    /**
     * Zwraca podaną kwotę w formie słownej
     *
     * @param $amount
     * @param bool $isComma (czy ma się pojawić przecinek między złotówkami i groszami, np dwa złote, 2 grosze)
     * @param string $mode ('ZLOTY' np. 2.02 lub 'GROSZ' np. 202)
     */
    public function __construct($amount, $isComma = true, $mode = self::MODE_ZLOTY)
    {
        $this->amountInWords = $this->transformToWords($amount, $isComma, $mode);
    }

    public function __toString()
    {
        return $this->amountInWords;
    }

    /**
     * Zwraca podaną kwotę w formie słownej
     *
     * @param $amount
     * @param bool $isComma (czy ma się pojawić przecinek między złotówkami i groszami, np dwa złote, 2 grosze)
     * @param string $mode ('ZLOTY' np. 2.02 lub 'GROSZ' np. 202)
     * @return string
     */
    private function transformToWords($amount, $isComma, $mode)
    {
        if (self::MODE_GROSZ === $mode) {
            $amount = $amount / 100;
        }

        $numberFormatter = new \NumberFormatter("pl", \NumberFormatter::SPELLOUT);
        $amountString = (string) round($amount, 2);
        $numbers = explode('.', $amountString);
        $zlotys = $numbers[0];
        $groszes = 0;

        if (isset($numbers[1])) {
            $groszes = strlen($numbers[1]) === 1 ? $numbers[1] * 10 : $numbers[1]; // naprawia błąd w przypadku kwoty 2.2 (jako 2 grosze, a nie 20)
        }

        $output = "{$numberFormatter->format($zlotys)} {$this->selectWordVariety([self::ONE_ZLOTY, self::TWO_ZLOTYS, self::FIVE_ZLOTYS], $zlotys)}";
        $output .= $isComma ? ", " : " ";
        $output .= "{$numberFormatter->format($groszes)} {$this->selectWordVariety([self::ONE_GROSZ, self::TWO_GROSZES, self::FIVE_GROSZES], $groszes)}";
        return  $output;
    }

    /**
     * Zwraca prawidłowo odmieniony wyraz
     *
     * @param $wordsArray ['równo jeden','dwa lub więcej','pięć lub więcej']
     * @param $amountInt
     * @return string
     */
    private function selectWordVariety($wordsArray, $amountInt)
    {
        $unity = (int) substr($amountInt,-1); // jedności
        $rest = $amountInt % 100;

        if ($amountInt == 1) {
            $output = $wordsArray[0];
        } elseif(($unity > 1 && $unity < 5) &! ($rest > 10 && $rest < 20)) {
            $output = $wordsArray[1];
        } else {
            $output = $wordsArray[2]; // wartość domyślna
        }

        return $output;
    }
}

