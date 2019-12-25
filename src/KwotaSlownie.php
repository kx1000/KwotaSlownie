<?php
namespace KwotaSlownie;

class KwotaSlownie {

    const MODE_ZLOTY = 'ZLOTY';
    const MODE_GROSZ = 'GROSZ';

    const ONE_ZLOTY = 'złoty';
    const TWO_ZLOTYS = 'złote';
    const FIVE_ZLOTYS = 'złotych';

    const ONE_GROSZ = 'grosz';
    const TWO_GROSZES = 'grosze';
    const FIVE_GROSZES = 'groszy';

    /**
     * Zwraca prawidłowo odmieniony wyraz
     *
     * @param $wordsArray ['równo jeden','dwa lub więcej','pięć lub więcej']
     * @param $amountInt
     * @return string
     */
    private function getWordVariety($wordsArray, $amountInt)
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

    /**
     * Zwraca podaną kwotę w formie słownej
     *
     * @param $amount
     * @param bool $isComma (czy ma się pojawić przecinek między złotówkami i groszami, np dwa złote, 2 grosze)
     * @param string $mode ('ZLOTY' np. 2.02 lub 'GROSZ' np. 202)
     * @return string
     */
    public function getAmountInWords($amount, $isComma = true, $mode = self::MODE_ZLOTY)
    {
        if (self::MODE_GROSZ === $mode) {
            $amount = $amount / 100;
        }

        $numberFormatter = new \NumberFormatter("pl", \NumberFormatter::SPELLOUT);
        $amountString = (string) round($amount, 2);
        $numbers = explode('.', $amountString);
        $zlotys = $numbers[0];
        $groszes = strlen($numbers[1]) === 1 ? $numbers[1] * 10 : $numbers[1]; // naprawia błąd w przypadku kwoty 2.2 (jako 2 grosze, a nie 20)

        $output = "{$numberFormatter->format($zlotys)} {$this->getWordVariety([self::ONE_ZLOTY, self::TWO_ZLOTYS, self::FIVE_ZLOTYS], $zlotys)}";
        $output .= $isComma ? ", " : " ";
        $output .= "{$numberFormatter->format($groszes)} {$this->getWordVariety([self::ONE_GROSZ, self::TWO_GROSZES, self::FIVE_GROSZES], $groszes)}";
        return  $output;
    }
}

