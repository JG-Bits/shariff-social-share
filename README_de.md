shariff-social-share
====================
Das Shariff-Social-Share WordPress-Plugin basiert auf dem Open-Source-Projekt [ct shariff](https://github.com/heiseonline/shariff) von [ct und heise online](http://www.heise.de/ct/artikel/Shariff-Social-Media-Buttons-mit-Datenschutz-2467514.html).

##Verwendung des Shortcodes
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

##CSS & JS Import-Modi
Für die Einbindung von CSS und Javascript gibt es folgende Modi:

* automatisch
* manuell

###automatisch
Automatisch lädt die CSS- und JS-Datei in Abhängigkeit zur:

* Einstellung zur Einbundung auf Seiten/Beiträgen
* seiten-/beitragsbasierenden deaktivierung

####manuell
Manuell lädt die CSS- und JS-Datei nur bei Vorkommen des Shortcodes auf einer Seite oder Beitrag.

##Screenshot
![Shariff-Social-Share Screenshot](https://www.jg-bits.de/wp-content/uploads/2014/12/JG-Bits-Shariff-Social-Share-WordPress-Plugin.png)

##Datenbank-Prefix

Alle Einstellungen des Plugins werden mittels der WordPress-Settings-API in der Datenbank mit folgendem Prefix gespeichert:

    shariff_social_share_
