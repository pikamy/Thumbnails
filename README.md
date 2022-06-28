# Thumbnails

Aplikacja konsolowa do konwertowania obrazków na miniaturki i zapisywania ich na komputerze lub w chmurze.
Do konwersji obrazka na miniaturkę zostało wykorzystanie rozszerzenie GD.
Do zapisu do chmury AWS została wykorzystana biblioteka aws/aws-sdk-php.

## Instalacja

1. Pobrać kod repozytorium
2. Zainstalować zależności poleceniem `composer install`
3. Dodać plik konfiguracyjny **cloud_storage.php** w katalogu `/config` bazując na przykładzie z `/config/cloud_storage.example.php`

## Instrukcja

Polecenia uruchamiamy z poziomu głównego katalogu projektu: `php bin/console.php {polecenie} {argument1} ... {argumentX}`
Obecnie obrazek można przekonwertować następującymi poleceniami:

1. `app:hard_disk:convert_to_thumbnail {imagePath} {height} {width} {thumbnailPath}` - umożliwia zapis stworzonej miniaturki do wskazanej ścieżki na dysku twardym
2. `app:aws:convert_to_thumbnail {imagePath} {height} {width} {bucket}` - umożliwia zapis stworzonej miniaturki do chmury AWS we wskazanym buckecie

## Dodanie nowego sposobu zapisu do chmury

1. Dodanie nowej stałej konfiguracyjnej w pliku `/config/cloud_storage` odnoszącej się do nowego dysku w chmurze
2. Dodanie nowej implementacji interfejsu `Thumbnails\ImagesManagement\Infrastructure\CloudStorages\CloudStorage`
3. Uwzględnienie nowej implementacji w faktorce `Thumbnails\ImagesManagement\Infrastructure\CloudStorages\CloudStorageFactory`
4. Dodanie nowego polecenia w pliku `/bin/console.php`
