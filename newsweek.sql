CREATE DATABASE IF NOT EXISTS newsweek CHARACTER SET utf8 COLLATE utf8_croatian_ci;
USE newsweek;

CREATE TABLE vijesti (
    id INT(11) NOT NULL AUTO_INCREMENT,
    datum VARCHAR(32) COLLATE utf8_croatian_ci NOT NULL,
    naslov VARCHAR(150) COLLATE utf8_croatian_ci NOT NULL,
    sazetak TEXT COLLATE utf8_croatian_ci NOT NULL,
    tekst TEXT COLLATE utf8_croatian_ci NOT NULL,
    slika VARCHAR(150) COLLATE utf8_croatian_ci NOT NULL,
    kategorija VARCHAR(64) COLLATE utf8_croatian_ci NOT NULL,
    arhiva TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

CREATE TABLE korisnik (
    id INT(11) NOT NULL AUTO_INCREMENT,
    ime VARCHAR(64) COLLATE utf8_croatian_ci NOT NULL,
    prezime VARCHAR(64) COLLATE utf8_croatian_ci NOT NULL,
    korisnicko_ime VARCHAR(64) COLLATE utf8_croatian_ci NOT NULL,
    lozinka VARCHAR(255) COLLATE utf8_croatian_ci NOT NULL,
    razina TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    UNIQUE KEY korisnicko_ime (korisnicko_ime)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES
('21.6.2026.', 'Novo istraživanje pokazalo da biljke u uredu poboljšavaju koncentraciju za 15%',
'Studija provedena u nekoliko ureda pokazala je mjerljiv učinak zelenila na produktivnost zaposlenika.',
'Istraživački tim sa Sveučilišta u Readingu proveo je tromjesečno praćenje 12 uredskih prostora kako bi utvrdio utjecaj biljaka na koncentraciju i produktivnost zaposlenika. Polovica ureda dobila je dodatno zelenilo u obliku stolnih i podnih biljaka, dok je druga polovica ostala bez izmjena kao kontrolna skupina.\r\n\r\nRezultati su pokazali da su zaposlenici u ozelenjenim uredima u prosjeku postizali 15% bolje rezultate na standardiziranim testovima koncentracije, te su prijavljivali manju razinu stresa tijekom radnog dana.\r\n\r\nIstraživači navode da efekt nije isključivo posljedica kvalitete zraka, već i psihološke komponente - prisutnost zelenila smanjuje vizualni umor i djeluje smirujuće.',
'fot1.jpeg', 'priroda', 0),

('21.6.2026.', 'Pčele u urbanim sredinama proizvode med s neobičnim okusom začina',
'Istraživači su otkrili da gradski med sadrži arome korijandera, kima i čilija.',
'Istraživački tim sa Sveučilišta u Utrechtu proveo je dvogodišnju analizu uzoraka meda prikupljenih iz 64 gradske košnice u dvanaest europskih gradova te ih usporedio s medom iz ruralnih pčelinjaka. Rezultati, objavljeni u časopisu Urban Apiculture Review, pokazali su da čak 38% urbanih uzoraka sadrži prepoznatljive aromatske spojeve karakteristične za začinsko bilje, u odnosu na samo 6% uzoraka iz ruralnih sredina.\r\n\r\nKemijskom analizom pomoću plinske kromatografije znanstvenici su u gradskom medu identificirali povišene razine spojeva linaloola i karvona, tipičnih za korijander i kim, a u nekoliko uzoraka iz Barcelone i Lyona pronašli su i tragove kapsaicinoidnih spojeva, što upućuje na to da su pčele posjećivale cvjetove feferona i čili paprika na balkonima stanovnika.\r\n\r\nProsječna udaljenost koju su gradske pčele preletjele do izvora nektara iznosila je, prema GPS praćenju 40 označenih pčela, samo 850 metara, dok se kod ruralnih pčela ta udaljenost penjala i do 4,2 kilometra. Istraživači smatraju da gušća koncentracija raznovrsnih malih vrtova i balkonskih sadnica u gradovima pčelama omogućuje da unutar manjeg radijusa pronađu veći broj različitih biljnih vrsta.\r\n\r\nAnaliza je također pokazala da je urbani med u prosjeku sadržavao 23 različite biljne vrste polena po uzorku, u odnosu na 9 vrsta zabilježenih u ruralnim uzorcima. Vodeća autorica studije, dr. Lotte Bakker, izjavila je da je takva pelodna raznolikost neobična za ovako male prostorne cjeline i da urbana sredina, suprotno očekivanjima, nudi pčelama iznimno bogat i raznolik švedski stol.\r\n\r\nRazlog tolike raznolikosti, dodaju istraživači, leži u samoj prirodi ponašanja pčela: one ne biraju izvore nektara po njegovoj namjeni, već prema dostupnosti i blizini. Pčela neće zaobići cvijet korijandera samo zato što je posađen radi kuhinje, baš kao što neće preskočiti ni cvjetove bosiljka, kopra ili čilija ako su joj nadohvat krila.\r\n\r\nNeki pčelari su to zapazili i prije znanstvene potvrde, te su počeli namjerno postavljati košnice u blizini vrtova s određenim začinskim biljem kako bi dobili specifičan, traženiji profil okusa.\r\n\r\nIstraživači planiraju u narednoj fazi projekta ispitati hoće li ta razlika u sastavu utjecati i na nutritivnu vrijednost meda, budući da preliminarni podaci već pokazuju blago povišenu razinu antioksidansa u uzorcima iz gradskih sredina.',
'fot2.jpeg', 'priroda', 0),

('21.6.2026.', 'Rijeka u Južnoj Americi mijenja boju ovisno o dobu godine, otkriva lokalni vodič',
'Fenomen privlači sve veći broj posjetitelja koji žele vidjeti rijetku prirodnu pojavu.',
'Duboko u unutrašnjosti Južne Amerike, lokalni vodiči već godinama upozoravaju posjetitelje na neobičan prirodni fenomen - rijeku čija se boja mijenja tijekom godine, od bistro plave do intenzivno crvenkasto-narančaste.\r\n\r\nPrema riječima lokalnih vodiča, promjena boje najizraženija je u prijelaznim mjesecima između sušnog i kišnog razdoblja, kada se mijenja sastav sedimenta koji rijeka nosi s okolnih planinskih obronaka.\r\n\r\nOsim sezonskih promjena, na izgled vode utječe i podzemna geotermalna aktivnost u pojedinim dijelovima toka, što stvara dodatne nijanse.\r\n\r\nLokalna zajednica rijeku odavno smatra svetim mjestom te organizira manje, kontrolirane obilaske kako bi se očuvala netaknutost okoliša.',
'fot3.jpeg', 'priroda', 0),

('21.6.2026.', 'Otkriven izgubljeni grad ispod pustinjskog pijeska, star više od tisuću godina',
'Arheolozi vjeruju da je riječ o jednom od najvažnijih nalaza posljednjeg desetljeća.',
'Tim arheologa otkrio je ostatke gotovo u potpunosti zatrpanog grada ispod slojeva pustinjskog pijeska, za koji procjenjuju da je star više od tisuću godina. Nalazište je otkriveno slučajno, tijekom geofizičkog snimanja terena namijenjenog sasvim drugom istraživačkom projektu.\r\n\r\nPrva iskapanja otkrila su ostatke gradskih zidina, dijelove kamenih građevina te tragove uređenog vodoopskrbnog sustava, što upućuje na to da je naselje u svoje vrijeme bilo iznenađujuće razvijeno.\r\n\r\nPrema riječima voditelja iskapanja, raspored ulica i veličina pojedinih građevina ukazuju na to da je grad u svom vrhuncu mogao imati nekoliko tisuća stanovnika.\r\n\r\nIskapanja će se nastaviti u idućim sezonama, a tim se nada da će uspjeti rekonstruirati barem dio svakodnevnog života stanovnika.',
'fot4.jpeg', 'povijest', 0),

('21.6.2026.', 'Stari zanat tkanja čipke vraća se u modu zahvaljujući mladim entuzijastima',
'Radionice tkanja čipke ponovno privlače mlade generacije diljem Europe.',
'Zanat tkanja čipke, koji je desetljećima bio na rubu izumiranja, doživljava neočekivani preporod zahvaljujući sve većem broju mladih ljudi koji se okreću tradicionalnim ručnim vještinama. Radionice koje uče tehnike čipkarstva diljem Europe bilježe porast broja polaznika, od kojih su mnogi tek u dvadesetima.\r\n\r\nVoditeljice radionica navode da je interes posebno porastao posljednjih nekoliko godina, dijelom zahvaljujući društvenim mrežama na kojima mladi umjetnici dijele svoje radove.\r\n\r\nNeke od mladih čipkarica svoje radove već prodaju kao modne dodatke ili dekorativne predmete, spajajući stoljetnu tradiciju s aktualnim modnim trendovima.',
'fot5.jpeg', 'povijest', 0),

('21.6.2026.', 'Selo u Alpama svake godine oživi srednjovjekovni sajam s izvornim receptima i alatima',
'Manifestacija svake godine privuče tisuće posjetitelja željnih autentičnog doživljaja.',
'Malo alpsko selo svake godine tijekom ljetnih mjeseci organizira manifestaciju koja posjetitelje vraća stoljećima unatrag - srednjovjekovni sajam na kojem se koriste isključivo izvorni recepti, alati i tehnike izrade karakteristične za to razdoblje.\r\n\r\nOrganizatori, uglavnom članovi lokalnih udruga za očuvanje kulturne baštine, mjesecima unaprijed pripremaju jela prema receptima pronađenim u starim rukopisima i obiteljskim bilježnicama.\r\n\r\nOsim gastronomije, sajam uključuje i demonstracije starih obrta - kovačnice s ručnim mijehom, izradu drvenih posuda bez električnih alata te tkanje tkanina na tradicionalnim razbojima.\r\n\r\nLokalne vlasti ističu da manifestacija ima i važnu ulogu u očuvanju identiteta zajednice.',
'fot6.jpeg', 'povijest', 0);
