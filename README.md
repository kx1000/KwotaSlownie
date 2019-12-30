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


// Inicjalizacja biblioteki
$kwotaSlownie = new KwotaSlownie\KwotaSlownie();  

// Przekształcenie kwoty na słowa  
echo $kwotaSlownie->transformToWords(2.02); // "dwa złote, dwa grosze"
echo $kwotaSlownie->transformToWords(2.02, false); // "dwa złote dwa grosze" (bez przecinka)
echo $kwotaSlownie->transformToWords(202, true, 'GROSZ'); // "dwa złote, dwa grosze" (kwota wyrażona w groszach) 
```
