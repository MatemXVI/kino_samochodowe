System do zarządzania kinem samochodowym. 
System został stworzony w formie aplikacji webowej. 

Administrator może zarządzać filmami, seansami oraz miejscami seansu. Posiada również wgląd na bilety, miejsca parkingowe i użytkowników. Główny administrator może też zarządzać innymi administratorami.  

Użytkownik może na stronie zobaczyć informacje o filmach, miejscach seansu i seansach. Ma też możliwość wyboru miejsca parkingowego, zakupu biletu, a także rezygnacji z biletu ze zwrotem pieniędzy. Zakupu będzie można dokonać wyłącznie będąc zalogowanym, natomiast płatność będzie mogła być realizowana wyłącznie elektronicznie. Płatność nie jest zrealizowana, jedynie jest okno ją symulujące.

Bilety posiadają kod QR, przechowujący informacje identyfikujące użytkownika. 

W pracy dyplomowej wykorzystałem głównie język PHP, ale też jest JavaScript i jQuery. Do wyglądu stron wykorzystano język znaczników HTML i CSS, głównie frontend ma na celu pokazanie układów strony i przycisków. Baza danych jest oparta na MySQL, a sam system działał na serwerze Apache. 

<b>Projekt stworzony bez frameworków – ręczne zarządzanie sesjami, bazą danych i strukturą MVC. Pokazuje, że rozumiem fundamenty działania aplikacji webowej bez wykorzystywania frameworków</b>
https://github.com/MatemXVI/kino_samochodowe/blob/main/Interfejs%20graficzny.docx - opis interfejsu graficznego

Jest to moja pierwsza wersja systemu która była jednocześnie projektem dyplomowym. Obecnie zakończyłem pracę nad stworzeniem identycznego systemu we frameworku Laravel. Wersja 2.0 - https://github.com/MatemXVI/kino-samochodowe-laravel

Planuję również przerobienie pracy do frameworków Spring Boot i Django
