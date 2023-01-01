[![Latest Stable Version](https://poser.pugx.org/kx1000/kwota-slownie/v)](//packagist.org/packages/kx1000/kwota-slownie) 
[![License](https://poser.pugx.org/kx1000/kwota-slownie/license)](//packagist.org/packages/kx1000/kwota-slownie)
[![Total Downloads](http://poser.pugx.org/kx1000/kwota-slownie/downloads)](https://packagist.org/packages/kx1000/kwota-slownie)
[![Monthly Downloads](http://poser.pugx.org/kx1000/kwota-slownie/d/monthly)](https://packagist.org/packages/kx1000/kwota-slownie)

# KwotaSlownie
**Bilbioteka PHP służąca do przekształcania liczb zmiennoprzecinkowych na kwoty słownie wyrażone w polskich złotówkach.**

## Instalacja
Instalacja z composerem.

`composer require kx1000/kwota-slownie`

Upewnij się, że autoload jest dodany.

`require __DIR__ . '/vendor/autoload.php';`

## Użycie
```
use KwotaSlownie\KwotaSlownie;

// Przekształcenie kwoty na słowa  
echo new KwotaSlownie(2.02); // "dwa złote, dwa grosze"
echo new KwotaSlownie(2.02, false); // "dwa złote dwa grosze" (bez przecinka)
echo new KwotaSlownie(202, true, 'GROSZ'); // "dwa złote, dwa grosze" (kwota wyrażona w groszach)
```
