shariff-social-share
====================
Das Shariff-Social-Share WordPress-Plugin basiert auf dem Open-Source-Projekt [ct shariff](https://github.com/heiseonline/shariff) von [ct und heise online](http://www.heise.de/ct/artikel/Shariff-Social-Media-Buttons-mit-Datenschutz-2467514.html).

## Installation
1. Lade dieses Repo herunter [https://github.com/JG-Bits/shariff-social-share/archive/master.zip](https://github.com/JG-Bits/shariff-social-share/archive/master.zip)
2. Entpacke das heruntergeladene Zip-Archiv. Enthält der Ordnername nach dem Entpacken folgendes "-master" entferne diese bzw. benenne den Ordner um.
3. Trage deine Domain ein in der Datei backend/index.php in Zeile 22 und deine facebook app-id und secret in Zeile 36-37. Falls du Hilfe benötigst, wie du deine Facebook-App-ID erstellst, findest du hier mehr Informationen: [https://developers.facebook.com/docs/apps/register](https://developers.facebook.com/docs/apps/register)
4. Lade den Ordner des Plugins hoch zu deiner Website per FTP oder im WordPress Backend unter Plugins.
5. Aktiviere das Plugin
6. Konfiguriere es nach deinen Wünschen unter Einstellungen --> Shariff-Social-Share
7. Viel Spaß :-)

## Verwendung des Shortcodes
Mithilfe des Shortcodes können Sie die Social-Share-Buttons an einer beliebigen Stelle im Editor einfügen. Eine direkte Einbindung in ein Template-File ist meist ebenfalls möglich.   

Einfach:

    [shariff-social-share]
    
Mit Attributen für Shortcode bezogene Einstellungen:

    [shariff-social-share atts="Wert"]
    
| atts (Attribut) | 		  Wert			 |
| :-------------- | :------------------: |
| color           | colored, white, grey |
| orientation     | horizontal, vertical |
| class           | html class attribute |
| styles          | CSS-Styles			 |

## CSS & JS Import-Modi
Für die Einbindung von CSS und Javascript gibt es folgende Modi:

* automatisch
* manuell

### automatisch
Automatisch lädt die CSS- und JS-Datei in Abhängigkeit zur:

* Einstellung zur Einbundung auf Seiten/Beiträgen
* seiten-/beitragsbasierenden deaktivierung

#### manuell
Manuell lädt die CSS- und JS-Datei nur bei Vorkommen des Shortcodes auf einer Seite oder Beitrag.

## Screenshot
![Shariff-Social-Share Screenshot](https://www.jg-bits.de/wp-content/uploads/2015/07/shariff-social-share-wp-plugin-v1.1.0-e1436651371658.png)

## Datenbank-Prefix

Alle Einstellungen des Plugins werden mittels der WordPress-Settings-API in der Datenbank mit folgendem Prefix gespeichert:

    shariff_social_share_
