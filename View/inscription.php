<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Créer un compte - Khedema+pay</title>
</head>
<body class="bg-white font-sans antialiased">

    <div class="flex min-h-screen">
        
        <div class="hidden lg:block lg:w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1000" 
                 alt="Bricoleur" 
                 class="absolute inset-0 h-full w-full object-cover">
        </div>

        <div class="w-full lg:w-1/2 flex flex-col p-6 lg:p-10 overflow-y-auto">
            
            <div class="flex justify-start items-center mb-6">
                <a href="index.php" class="flex items-center text-sm font-medium text-gray-700 hover:text-blue-700 transition cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Retour à la page d'accueil
                </a>
            </div>

            <div class="max-w-md mx-auto w-full">
                <div class="text-center mb-8">
                    <span class="text-3xl font-bold tracking-tighter text-blue-700 uppercase">Khedema+pay</span>
                    <h1 class="text-2xl font-bold text-gray-900 mt-4">Créer un compte</h1>
                    <p class="text-gray-500 text-sm mt-2">Inscrivez-vous pour accéder à nos services.</p>
                </div>

                <form class="space-y-5" action="../model/inscription.php" method="POST">
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Nom</label>
                            <input type="text" name="nom" required placeholder="Ex: Ben" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 outline-none transition">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Prénom</label>
                            <input type="text" name="prenom" required placeholder="Ex: Ahmed" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 outline-none transition">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-semibold text-gray-700">Numéro de téléphone</label>
                        <div class="flex">
                            <input type="tel" name="telephone" required placeholder="550 00 00 00"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-r-md focus:ring-2 focus:ring-orange-500 outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Wilaya</label>
                            <select name="wilaya" required class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 outline-none transition bg-white cursor-pointer text-sm">
                                <option value="">Sélectionner</option>
                                <option value="01">01 - Adrar</option>
                                <option value="02">02 - Chlef</option>
                                <option value="03">03 - Laghouat</option>
                                <option value="04">04 - Oum El Bouaghi</option>
                                <option value="05">05 - Batna</option>
                                <option value="06">06 - Béjaïa</option>
                                <option value="07">07 - Biskra</option>
                                <option value="08">08 - Béchar</option>
                                <option value="09">09 - Blida</option>
                                <option value="10">10 - Bouira</option>
                                <option value="11">11 - Tamanrasset</option>
                                <option value="12">12 - Tébessa</option>
                                <option value="13">13 - Tlemcen</option>
                                <option value="14">14 - Tiaret</option>
                                <option value="15">15 - Tizi Ouzou</option>
                                <option value="16">16 - Alger</option>
                                <option value="17">17 - Djelfa</option>
                                <option value="18">18 - Jijel</option>
                                <option value="19">19 - Sétif</option>
                                <option value="20">20 - Saïda</option>
                                <option value="21">21 - Skikda</option>
                                <option value="22">22 - Sidi Bel Abbès</option>
                                <option value="23">23 - Annaba</option>
                                <option value="24">24 - Guelma</option>
                                <option value="25">25 - Constantine</option>
                                <option value="26">26 - Médéa</option>
                                <option value="27">27 - Mostaganem</option>
                                <option value="28">28 - M'Sila</option>
                                <option value="29">29 - Mascara</option>
                                <option value="30">30 - Ouargla</option>
                                <option value="31">31 - Oran</option>
                                <option value="32">32 - El Bayadh</option>
                                <option value="33">33 - Illizi</option>
                                <option value="34">34 - Bordj Bou Arreridj</option>
                                <option value="35">35 - Boumerdès</option>
                                <option value="36">36 - El Tarf</option>
                                <option value="37">37 - Tindouf</option>
                                <option value="38">38 - Tissemsilt</option>
                                <option value="39">39 - El Oued</option>
                                <option value="40">40 - Khenchela</option>
                                <option value="41">41 - Souk Ahras</option>
                                <option value="42">42 - Tipaza</option>
                                <option value="43">43 - Mila</option>
                                <option value="44">44 - Aïn Defla</option>
                                <option value="45">45 - Naâma</option>
                                <option value="46">46 - Aïn Témouchent</option>
                                <option value="47">47 - Ghardaïa</option>
                                <option value="48">48 - Relizane</option>
                                <option value="49">49 - El M'Ghair</option>
                                <option value="50">50 - El Meniaa</option>
                                <option value="51">51 - Ouled Djellal</option>
                                <option value="52">52 - Bordj Baji Mokhtar</option>
                                <option value="53">53 - Béni Abbès</option>
                                <option value="54">54 - Timimoun</option>
                                <option value="55">55 - Touggourt</option>
                                <option value="56">56 - Djanet</option>
                                <option value="57">57 - In Salah</option>
                                <option value="58">58 - In Guezzam</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Adresse</label>
                            <input type="text" name="adresse" required placeholder="Cité, N° porte" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 outline-none transition">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-semibold text-gray-700">Mot de passe</label>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 outline-none transition">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-semibold text-gray-700">Je suis un</label>
                        <select name="role" required class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 outline-none transition bg-white cursor-pointer text-sm">
                            <option value="">Sélectionner votre profil</option>
                            <option value="client">Client (Je cherche un service)</option>
                            <option value="Prestataire">Prestataire (Je propose mes services)</option>
                        </select>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-md transition duration-200 shadow-md transform active:scale-[0.98]">
                        S'inscrire
                    </button>
                </form>

                <div class="mt-8 text-center border-t border-gray-100 pt-6">
                    <p class="text-sm text-gray-600">
                        Vous avez déjà un compte ? 
                        <a href="login.php" class="font-bold text-blue-700 hover:text-blue-800 hover:underline transition">
                            Connectez-vous
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>