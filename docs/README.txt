-------------------------------
== QSF Portal v2.0.0 ==
-------------------------------

=== Installation ===
 1. Upload all files, overwriting any existing files

 2. If your server allows it, CHMOD the following files and directories to 755
    or, if you have problems, 777.

    ./attachments/
    ./avatars/uploaded/
    ./downloads/
    ./emoticons/
    ./packages/
    ./settings.php
    ./updates/

 3. Go to the install directory in your browser
 4. Follow the instructions
 5. Delete the install directory

=== Upgrading ===
 Upgrading is done in the same way as installing. Make sure you select the
 "upgrade" option. Before upgrading, make a note of your current MercuryBoard,
 Quicksilver Forums, or QSF Portal installation version: you will need it to correctly
 upgrade.

 It is recommended you keep old settings.php. Do not overwrite it as you do
 with  other files

 Please note on upgrading the upgrade script will set the skin to default
 (previously known as Candy Corn) for all administrators. This is so you can
 still login and access Admin CP. Many templates have been added so any
 skins for Mercuryboard 1.1.4 or older will need significant changes.
 See https://github.com/Arthmoor/QSF-Portal for more information

=== Requirements ===
 QSF Portal works with PHP 7.0.0 or higher. MySQL 5.7 or higher is required.
 QSF Portal works on any operating system and web server combination.

 If you experience a problem and you meet these requirements, please report it
 as a bug. The latest versions of PHP and MySQL are recommended to keep
 QSF Portal running its fastest and safest.

=== License ===
 This software is released under the GNU General Public License (GPL). For the
 terms of the license, see the file docs/license.txt included in this
 distribution. The license is also available in many languages at
 https://www.gnu.org

=== How You Can Help ===
 If you know PHP and MySQL, and would like to help develop QSF Portal,
 then feel free to modify the code and join the discussion at 
 https://github.com/Arthmoor/QSF-Portal .
 If you know a language in addition to English and would like to translate,
 your help is also welcome.

 Feature requests and bug reports are also very important to us.

=== Support ===
 If you're sure you've read the above information, and it simply will not work,
 visit https://github.com/Arthmoor/QSF-Portal for support
