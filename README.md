System do zarządzania kinem samochodowym. Był to mój projekt dyplomowy, napisany w czystym PHP.
Funkcjonalności:
- Administrator
  - Zarządzanie filmami, seansami i miejscami seansu.
  - Podgląd i zarządzanie biletami, miejscami parkingowymi i użytkownikami.
  - Główny administrator ma dodatkowo możliwość zarządzania innymi administratorami.
- Użytkownik
  - Przegląd filmów, seansów i miejsc seansu.
  - Wybór miejsca parkingowego i zakup biletu.
  - Rezygnacja z biletu ze zwrotem pieniędzy.
  - Zakup biletów wyłącznie po zalogowaniu.
  - Symulacja płatności elektronicznej (okno płatności, brak realnej integracji).
  - Bilety generowane są z kodem QR zawierającym dane identyfikacyjne użytkownika.
 
Technologie:
- Backend: PHP, JavaScript, jQuery
- Frontend: HTML, CSS (prosty układ stron i przyciski)
- Baza danych: MySQL
- Inne: PHPQRCode

<b>Projekt stworzony bez frameworków – ręczne zarządzanie sesjami, bazą danych i strukturą MVC. Pokazuje, że rozumiem fundamenty działania aplikacji webowej bez wykorzystywania frameworków</b>

Obecnie zakończyłem pracę nad wersji 2.0 aplikacji stworzonej we frameworku Laravel. Wersja 2.0 - https://github.com/MatemXVI/kino-samochodowe-laravel

Opis interfejsu graficznego: https://github.com/MatemXVI/kino_samochodowe/blob/main/Interfejs%20graficzny.docx

Planuję również przerobienie pracy do frameworków Spring Boot i Django.
