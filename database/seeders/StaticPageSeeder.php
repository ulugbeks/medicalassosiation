<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaticPage;

class StaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staticPages = [
            [
                'slug' => 'terms-conditions',
                'order' => 1,
                'active' => true,
                'translations' => [
                    'en' => [
                        'title' => 'Terms & Conditions',
                        'content' => "<p>Welcome to our website. These terms and conditions outline the rules and regulations for the use of our website.</p>\n\n<p>By accessing this website, we assume you accept these terms and conditions. Do not continue to use our website if you do not agree to take all of the terms and conditions stated on this page.</p>\n\n<h2>1. DEFINITIONS</h2>\n<p>In these terms and conditions, the following definitions apply:</p>\n<ul>\n<li><strong>Company</strong> refers to our medical association</li>\n<li><strong>User</strong> refers to any person accessing our website</li>\n<li><strong>Services</strong> refers to all services provided through our website</li>\n</ul>\n\n<h2>2. USE OF WEBSITE</h2>\n<p>You may use our website for lawful purposes only. You agree not to use the website:</p>\n<ul>\n<li>In any way that violates any applicable federal, state, local, or international law or regulation</li>\n<li>To transmit, or procure the sending of, any advertising or promotional material without our prior written consent</li>\n<li>To impersonate or attempt to impersonate the Company, a Company employee, another user, or any other person or entity</li>\n</ul>\n\n<h2>3. PRIVACY POLICY</h2>\n<p>Your privacy is important to us. Please review our Privacy Policy, which also governs your use of the website.</p>\n\n<h2>4. DISCLAIMER</h2>\n<p>The information on this website is provided on an <em>\"as is\"</em> basis. To the fullest extent permitted by law, this Company excludes all representations, warranties, conditions and terms.</p>\n\n<h2>5. LIMITATION OF LIABILITY</h2>\n<p>In no event shall the Company be liable for any indirect, incidental, special, consequential, or punitive damages.</p>\n\n<h2>6. GOVERNING LAW</h2>\n<p>These terms and conditions are governed by and construed in accordance with the laws of our jurisdiction.</p>\n\n<h2>7. CONTACT INFORMATION</h2>\n<p>If you have any questions about these Terms and Conditions, please contact us.</p>",
                        'seo_title' => 'Terms & Conditions - Medical Association',
                        'seo_description' => 'Read our terms and conditions for using our medical association website and services.'
                    ],
                    'lv' => [
                        'title' => 'Noteikumi un Nosacījumi',
                        'content' => "<p>Laipni lūdzam mūsu vietnē. Šie noteikumi un nosacījumi nosaka mūsu vietnes izmantošanas noteikumus un nosacījumus.</p>\n\n<p>Piekļūstot šai vietnei, mēs pieņemam, ka jūs piekrītat šiem noteikumiem un nosacījumiem. Neturpiniet izmantot mūsu vietni, ja nepiekrītat visiem šajā lapā norādītajiem noteikumiem un nosacījumiem.</p>\n\n<h2>1. DEFINĪCIJAS</h2>\n<p>Šajos noteikumos un nosacījumos tiek izmantotas šādas definīcijas:</p>\n<ul>\n<li><strong>Uzņēmums</strong> attiecas uz mūsu medicīnas asociāciju</li>\n<li><strong>Lietotājs</strong> attiecas uz jebkuru personu, kas piekļūst mūsu vietnei</li>\n<li><strong>Pakalpojumi</strong> attiecas uz visiem pakalpojumiem, kas tiek sniegti caur mūsu vietni</li>\n</ul>\n\n<h2>2. VIETNES IZMANTOŠANA</h2>\n<p>Jūs varat izmantot mūsu vietni tikai likumīgiem mērķiem. Jūs piekrītat neizmantot vietni:</p>\n<ul>\n<li>Jebkādā veidā, kas pārkāpj jebkurus piemērojamos federālos, valsts, vietējos vai starptautiskos likumus vai noteikumus</li>\n<li>Lai nosūtītu vai nodrošinātu jebkādu reklāmas vai promocijas materiālu bez mūsu iepriekšējas rakstiskas piekrišanas</li>\n<li>Lai izliktos par Uzņēmumu, Uzņēmuma darbinieku, citu lietotāju vai jebkuru citu personu vai vienību</li>\n</ul>\n\n<h2>3. PRIVĀTUMA POLITIKA</h2>\n<p>Jūsu privātums mums ir svarīgs. Lūdzu, iepazīstieties ar mūsu Privātuma politiku, kas arī nosaka jūsu vietnes izmantošanu.</p>\n\n<h2>4. ATRUNA</h2>\n<p>Informācija šajā vietnē tiek sniegta <em>\"kā ir\"</em> principā. Pilnā likuma atļautajā mērā šis Uzņēmums izslēdz visus apgalvojumus, garantijas, nosacījumus un noteikumus.</p>\n\n<h2>5. ATBILDĪBAS IEROBEŽOJUMS</h2>\n<p>Nekādā gadījumā Uzņēmums nebūs atbildīgs par jebkādiem netiešiem, nejaušiem, īpašiem, sekojošiem vai sodošiem zaudējumiem.</p>\n\n<h2>6. PIEMĒROJAMIE LIKUMI</h2>\n<p>Šie noteikumi un nosacījumi tiek regulēti un interpretēti saskaņā ar mūsu jurisdikcijas likumiem.</p>\n\n<h2>7. KONTAKTINFORMĀCIJA</h2>\n<p>Ja jums ir jautājumi par šiem Noteikumiem un nosacījumiem, lūdzu, sazinieties ar mums.</p>",
                        'seo_title' => 'Noteikumi un Nosacījumi - Medicīnas Asociācija',
                        'seo_description' => 'Izlasiet mūsu noteikumus un nosacījumus medicīnas asociācijas vietnes un pakalpojumu izmantošanai.'
                    ]
                ]
            ],
            [
                'slug' => 'privacy-policy',
                'order' => 2,
                'active' => true,
                'translations' => [
                    'en' => [
                        'title' => 'Privacy Policy',
                        'content' => "This Privacy Policy describes how we collect, use, and protect your personal information when you visit our website or use our services.\n\n1. INFORMATION WE COLLECT\nWe may collect the following types of information:\n- Personal information (name, email address, phone number)\n- Medical information (when you use our services)\n- Usage data (how you interact with our website)\n- Device information (IP address, browser type, operating system)\n\n2. HOW WE USE YOUR INFORMATION\nWe use your information to:\n- Provide and maintain our services\n- Process appointments and medical consultations\n- Communicate with you about our services\n- Improve our website and services\n- Comply with legal obligations\n\n3. INFORMATION SHARING\nWe do not sell, trade, or otherwise transfer your personal information to third parties except:\n- With your explicit consent\n- To comply with legal requirements\n- To protect our rights and safety\n- With trusted service providers who assist us in operating our website\n\n4. DATA SECURITY\nWe implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.\n\n5. YOUR RIGHTS\nYou have the right to:\n- Access your personal information\n- Correct inaccurate information\n- Request deletion of your information\n- Opt-out of marketing communications\n\n6. COOKIES\nOur website uses cookies to enhance your browsing experience. You can control cookie settings through your browser.\n\n7. CHANGES TO THIS POLICY\nWe may update this Privacy Policy from time to time. We will notify you of any significant changes.\n\n8. CONTACT US\nIf you have questions about this Privacy Policy, please contact us.",
                        'seo_title' => 'Privacy Policy - Medical Association',
                        'seo_description' => 'Learn how we collect, use, and protect your personal information in our privacy policy.'
                    ],
                    'lv' => [
                        'title' => 'Privātuma Politika',
                        'content' => "Šī Privātuma politika apraksta, kā mēs vācam, izmantojam un aizsargājam jūsu personisko informāciju, kad apmeklējat mūsu vietni vai izmantojat mūsu pakalpojumus.\n\n1. INFORMĀCIJA, KO MĒS VĀCAM\nMēs varam vākt šāda veida informāciju:\n- Personiskā informācija (vārds, e-pasta adrese, tālruņa numurs)\n- Medicīniskā informācija (kad izmantojat mūsu pakalpojumus)\n- Lietošanas dati (kā mijiedarbojaties ar mūsu vietni)\n- Ierīces informācija (IP adrese, pārlūkprogrammas tips, operētājsistēma)\n\n2. KĀ MĒS IZMANTOJAM JŪSU INFORMĀCIJU\nMēs izmantojam jūsu informāciju, lai:\n- Sniegtu un uzturētu mūsu pakalpojumus\n- Apstrādātu pierakstus un medicīniskās konsultācijas\n- Sazinātos ar jums par mūsu pakalpojumiem\n- Uzlabotu mūsu vietni un pakalpojumus\n- Izpildītu juridiskās saistības\n\n3. INFORMĀCIJAS KOPĪGOŠANA\nMēs nepārdodam, netirgoam un citādi nenododam jūsu personisko informāciju trešajām personām, izņemot:\n- Ar jūsu skaidru piekrišanu\n- Lai izpildītu juridiskās prasības\n- Lai aizsargātu mūsu tiesības un drošību\n- Ar uzticamiem pakalpojumu sniedzējiem, kas palīdz mums darbināt mūsu vietni\n\n4. DATU DROŠĪBA\nMēs īstenojam atbilstošus drošības pasākumus, lai aizsargātu jūsu personisko informāciju pret neatļautu piekļuvi, grozīšanu, izpaušanu vai iznīcināšanu.\n\n5. JŪSU TIESĪBAS\nJums ir tiesības:\n- Piekļūt savai personiskajai informācijai\n- Labot nepareizu informāciju\n- Pieprasīt savas informācijas dzēšanu\n- Atteikties no mārketinga ziņojumiem\n\n6. SĪKDATNES\nMūsu vietne izmanto sīkdatnes, lai uzlabotu jūsu pārlūkošanas pieredzi. Jūs varat kontrolēt sīkdatņu iestatījumus caur savu pārlūkprogrammu.\n\n7. IZMAIŅAS ŠĀ POLITIKĀ\nMēs varam laiku pa laikam atjaunināt šo Privātuma politiku. Mēs paziņosim jums par jebkādām būtiskām izmaiņām.\n\n8. SAZINIETIES AR MUMS\nJa jums ir jautājumi par šo Privātuma politiku, lūdzu, sazinieties ar mums.",
                        'seo_title' => 'Privātuma Politika - Medicīnas Asociācija',
                        'seo_description' => 'Uzziniet, kā mēs vācam, izmantojam un aizsargājam jūsu personisko informāciju mūsu privātuma politikā.'
                    ]
                ]
            ],
            [
                'slug' => 'cookies',
                'order' => 3,
                'active' => true,
                'translations' => [
                    'en' => [
                        'title' => 'Cookie Policy',
                        'content' => "This Cookie Policy explains how we use cookies and similar technologies on our website.\n\n1. WHAT ARE COOKIES?\nCookies are small text files that are stored on your device when you visit our website. They help us provide you with a better browsing experience.\n\n2. TYPES OF COOKIES WE USE\n\nEssential Cookies:\n- These cookies are necessary for the website to function properly\n- They enable basic functions like page navigation and access to secure areas\n- The website cannot function properly without these cookies\n\nAnalytical/Performance Cookies:\n- These cookies help us understand how visitors interact with our website\n- They provide information about the number of visitors, bounce rate, traffic source, etc.\n- This information helps us improve our website\n\nFunctionality Cookies:\n- These cookies enable the website to remember choices you make\n- They may include your preferred language or region\n- They provide enhanced, more personal features\n\nTargeting/Advertising Cookies:\n- These cookies may be set by our advertising partners\n- They may be used to build a profile of your interests\n- They are used to show you relevant advertisements on other websites\n\n3. THIRD-PARTY COOKIES\nWe may allow third-party companies to place cookies on our website for analytics and advertising purposes.\n\n4. HOW TO CONTROL COOKIES\nYou can control and/or delete cookies as you wish. You can:\n- Delete all cookies that are already on your computer\n- Set your browser to prevent cookies from being placed\n- Accept cookies from specific websites only\n\nBrowser Settings:\n- Chrome: Settings > Privacy and security > Cookies and other site data\n- Firefox: Options > Privacy & Security > Cookies and Site Data\n- Safari: Preferences > Privacy > Cookies and website data\n- Edge: Settings > Cookies and site permissions\n\n5. CONSEQUENCES OF DISABLING COOKIES\nIf you disable cookies, some features of our website may not function properly.\n\n6. UPDATES TO THIS POLICY\nWe may update this Cookie Policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons.\n\n7. CONTACT US\nIf you have any questions about our use of cookies, please contact us.",
                        'seo_title' => 'Cookie Policy - Medical Association',
                        'seo_description' => 'Learn about how we use cookies and similar technologies on our website.'
                    ],
                    'lv' => [
                        'title' => 'Sīkdatņu Politika',
                        'content' => "Šī Sīkdatņu politika paskaidro, kā mēs izmantojam sīkdatnes un līdzīgas tehnoloģijas mūsu vietnē.\n\n1. KAS IR SĪKDATNES?\nSīkdatnes ir mazi teksta faili, kas tiek saglabāti jūsu ierīcē, kad apmeklējat mūsu vietni. Tie palīdz mums nodrošināt jums labāku pārlūkošanas pieredzi.\n\n2. SĪKDATŅU VEIDI, KO MĒS IZMANTOJAM\n\nBūtiskās Sīkdatnes:\n- Šīs sīkdatnes ir nepieciešamas, lai vietne darbotos pareizi\n- Tās iespējo pamata funkcijas, piemēram, lapas navigāciju un piekļuvi drošajām zonām\n- Vietne nevar darboties pareizi bez šīm sīkdatnēm\n\nAnalītiskās/Veiktspējas Sīkdatnes:\n- Šīs sīkdatnes palīdz mums saprast, kā apmeklētāji mijiedarbojas ar mūsu vietni\n- Tās sniedz informāciju par apmeklētāju skaitu, atteices līmeni, trafika avotu utt.\n- Šī informācija palīdz mums uzlabot mūsu vietni\n\nFunkcionalitātes Sīkdatnes:\n- Šīs sīkdatnes ļauj vietnei atcerēties jūsu izvēles\n- Tās var ietvert jūsu vēlamo valodu vai reģionu\n- Tās nodrošina uzlabotas, personīgākas funkcijas\n\nMērķēšanas/Reklāmas Sīkdatnes:\n- Šīs sīkdatnes var iestatīt mūsu reklāmas partneri\n- Tās var tikt izmantotas, lai izveidotu jūsu interešu profilu\n- Tās tiek izmantotas, lai rādītu jums atbilstošas reklāmas citās vietnēs\n\n3. TREŠO PUŠU SĪKDATNES\nMēs varam atļaut trešo pušu uzņēmumiem ievietot sīkdatnes mūsu vietnē analītikas un reklāmas nolūkos.\n\n4. KĀ KONTROLĒT SĪKDATNES\nJūs varat kontrolēt un/vai dzēst sīkdatnes pēc vēlēšanās. Jūs varat:\n- Dzēst visas sīkdatnes, kas jau atrodas jūsu datorā\n- Iestatīt savu pārlūkprogrammu, lai novērstu sīkdatņu ievietošanu\n- Pieņemt sīkdatnes tikai no konkrētām vietnēm\n\nPārlūkprogrammas iestatījumi:\n- Chrome: Iestatījumi > Privātums un drošība > Sīkdatnes un citi vietnes dati\n- Firefox: Iespējas > Privātums un drošība > Sīkdatnes un vietnes dati\n- Safari: Preferences > Privātums > Sīkdatnes un vietnes dati\n- Edge: Iestatījumi > Sīkdatnes un vietnes atļaujas\n\n5. SĪKDATŅU ATSPĒJOŠANAS SEKAS\nJa atspējosiet sīkdatnes, dažas mūsu vietnes funkcijas var nedarboties pareizi.\n\n6. ATJAUNINĀJUMI ŠĀ POLITIKĀ\nMēs varam laiku pa laikam atjaunināt šo Sīkdatņu politiku, lai atspoguļotu izmaiņas mūsu praksē vai citu darbības, juridisko vai regulatīvo iemeslu dēļ.\n\n7. SAZINIETIES AR MUMS\nJa jums ir jautājumi par mūsu sīkdatņu izmantošanu, lūdzu, sazinieties ar mums.",
                        'seo_title' => 'Sīkdatņu Politika - Medicīnas Asociācija',
                        'seo_description' => 'Uzziniet par to, kā mēs izmantojam sīkdatnes un līdzīgas tehnoloģijas mūsu vietnē.'
                    ]
                ]
            ]
        ];

        foreach ($staticPages as $pageData) {
            $page = new StaticPage();
            $page->slug = $pageData['slug'];
            $page->active = $pageData['active'];
            $page->order = $pageData['order'];

            // Set translations
            foreach ($pageData['translations'] as $locale => $translation) {
                $page->setTranslation('title', $locale, $translation['title']);
                $page->setTranslation('content', $locale, $translation['content']);
                $page->setTranslation('seo_title', $locale, $translation['seo_title']);
                $page->setTranslation('seo_description', $locale, $translation['seo_description']);
            }

            $page->save();
        }
    }
}